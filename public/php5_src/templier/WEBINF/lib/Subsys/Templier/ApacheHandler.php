<?php ## Интерфейс шаблонизатора с обработчиками Apache.
// Save loading time.
define("Subsys_Templier_ApacheHandler_START_TIME", microtime());

require_once "Cache/Site.php";
require_once "Apache/Rewriter.php";
require_once "Debug/BacktraceDumper.php";

/**
 * Class to handle Apache requests to Templier pages.
 *
 * @version 1.12
 */
class Subsys_Templier_ApacheHandler
{
  var $VERSION = "1.04";

  var $useHook = true;
  var $useFormPersister = true;
  var $useCookieStat = true;
  var $useGzip = 9;
  var $useRecoder = false;
  var $useLogging = "Subsys_Templier_ApacheHandler.log";
  var $templierClass = false;
  var $cache = null;

  // Constructor.
  function Subsys_Templier_ApacheHandler($templierClass, $tmp="/tmp") {
    $this->templierClass = $templierClass;
    if (!@is_dir($tmp)) $tmp = "./tmp";
    $this->cache = new Cache_Site($tmp);
  }

  // Process current Apache request.
  function processRequest() {
    // Get real REQUEST_URI.
    $request = Apache_Rewriter::getOriginalUri($error);
    if (!$request) {
      $this->logError($error . ": " . $_SERVER['REQUEST_URI']);
      Apache_Rewriter::doErrorDocument("403");
    }

    // Correct environment & GET variables according to request URI.
    Apache_Rewriter::doPseudoRedirect($request, true);

    // Set OB handlers conveyer.
    if ($this->useHook && !headers_sent($file, $line)) {
      ob_start(array(&$this, "ob_gzipAndStat"));
      if ($this->useFormPersister) {
        require_once "HTML/FormPersister.php";
        require_once "HTML/ImgSizer.php";
        $parser = new HTML_FormPersister;
        $parser->addObject(new HTML_ImgSizer());
        ob_start(array(&$parser, "process"));
      }
    } else {
      $trace = new Debug_BacktraceDumper();
      $trace->prepare(E_WARNING, "Headers already sent, before Templier start. Output hooks will be disabled", $file, $line, 0);
      $trace->show();
    }

    // Run template engine.
    $class = $this->templierClass;
    $tm = new $class("/", $this->cache);
    $result = $tm->runUri($_SERVER['REQUEST_URI']);
    if ($result === null) {
      Apache_Rewriter::doErrorDocument("404");
      return;
    }

    if ($this->useRecoder !== false && $this->useHook) {
      include_once "HTML/Recoder.php";
      $rec = new HTML_Recoder($this->useRecoder);
      $result = $rec->process($result);
    }

    echo $result;
  }

  // Called on hacking attempt.
  function logError($msg) {
    if (!$this->useLogging) return;
    // Logging user info.
    $line = $this->fetchip()." - $msg";
    error_log($line);
  }

  function ob_gzipAndStat($text) {
    if ($this->useCookieStat) {
      setcookie("page_size_before", strlen($text), time()+3600, '/');
    }
    if ($this->useGzip) $text = ob_gzhandler($text, $this->useGzip);
    if ($this->useCookieStat) {
      $tS = explode(" ", Subsys_Templier_ApacheHandler_START_TIME); 
      $tS = $tS[0]+$tS[1];
      $tE = explode(" ", microtime()); 
      $tE = $tE[0]+$tE[1];
      @setcookie("page_size_after", strlen($text), time()+3600, '/');
      @setcookie("page_gentime", $tE - $tS, time()+3600, '/');
    }
    return $text;
  }

  // Fetches "real" user IP.
  function fetchip() {
    // get useful vars:
    $client_ip = isset($_SERVER['HTTP_CLIENT_IP']) ? 
      $_SERVER['HTTP_CLIENT_IP'] : "";
    $x_forwarded_for = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
      $_SERVER['HTTP_X_FORWARDED_FOR'] : "";
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    // then the script itself
    if (!empty ($client_ip) ) {
      $ip_expl = explode('.',$client_ip);
      $referer = explode('.',$remote_addr);
      if ($referer[0] != $ip_expl[0]) { 
        $ip = array_reverse($ip_expl); 
        $ret = implode('.',$ip); 
      } 
      else { $ret = $client_ip; };
    } elseif (!empty($x_forwarded_for)) {
      if (strstr($x_forwarded_for,',')) { 
        $ip_expl = explode(',',$x_forwarded_for); 
        $ret = end($ip_expl); 
      } 
      else { 
        $ret = $x_forwarded_for; 
      }
    } else { 
      $ret = $remote_addr; 
    }
    return $ret;
  }
}
?>