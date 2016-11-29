<?php
/**
 * Debug_BacktraceDumper: beautify backtraces for non-zero error_reporting.
 * (C) 2005 Dmitry Koterov, http://forum.dklab.ru/users/DmitryKoterov/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * See http://www.gnu.org/copyleft/lesser.html
 *
 * Work fine with both display_error and log_error.
 * Used to create and then dump pretty stacktraces while debugging.
 */

class Debug_BacktraceDumper 
{
    var $VERSION = "0.56";

    var $_bd_aliases = array();
    var $_bd_trace = array();
    var $_bd_grayFuncs = array();

    var $_db_stdTracer = "debug_backtrace";


    // constructor()
    // Create new tracer.
    function Debug_BacktraceDumper() 
    {
        if (isset($_SERVER['DOCUMENT_ROOT']))
            $this->addAlias(realpath($_SERVER['DOCUMENT_ROOT']), "~");
        $this->addAlias("", array(&$this, '__callbackGetSmartyTplName'), true);
    }
    
    
    // void addGray($callback)
    // Register predicate function which checks if some element in the trace
    // must be grayed or not. Argument passed to function is filename.
    function addGray($func)
    {
        $this->_bd_grayFuncs[] = $func;
    }
    

    // void setTracer($callback)
    // Set custom function instead of standard PHP debug_backtrace().
    function setTracer($callback)
    {
        $this->_db_stdTracer = $callback;
    }
    

    // void addAlias(string $root, string $replacement, bool $isCallback=false)
    // Add new path alias.
    function addAlias($root, $repl, $isCallback=false) 
    {
        $this->_bd_aliases[] = array(
            "root" => str_replace('\\', '/', $root),
            "repl" => $repl,
            "isCallback" => $isCallback
        );
    }


    // void prepare($errno, $errstr, $errfile, $errline, $stack=0)
    // Fill the information about backtrace.
    function prepare($errno, $errstr, $errfile, $errline, $stack=0) 
    {
        if (is_numeric($stack)) {
            $trace = call_user_func($this->_db_stdTracer);
            $stack = array_splice($trace, $stack+1);
        }

        if (preg_match('/^(.*) \s+ at \s+ (\S+) (?:\s+ line \s+ (\d+))?$/sx', $errstr, $p=null)) {
            $errstr = $p[1];
            $errfile = $p[2];
            $errline = @$p[3];
        }

        // Prepare error context.
        $types = array(
            "E_ERROR", "E_WARNING", "E_PARSE", "E_NOTICE", "E_CORE_ERROR",
            "E_CORE_WARNING", "E_COMPILE_ERROR", "E_COMPILE_WARNING", 
            "E_USER_ERROR", "E_USER_WARNING", "E_USER_NOTICE", "E_STRICT",
        );
        // Textual error type.
        $type = array();
        foreach ($types as $t) {
            $e = defined($t)? constant($t) : 0;
            if ($errno & $e) $type[] = $t;
        }
        $type = join(",", $type);
        // Prepare stack.
        array_unshift($stack, array(
            "file" => $errfile,
            "line" => $errline,
        ));
        foreach ($stack as $i=>$s) {
            $stack[$i]['name'] = $this->_getDebugFileName(isset($s['file'])? $s['file'] : __FILE__);
        }
        // Remove hidden stack elements.
        for ($i=0; $i<count($stack); $i++) {
            if (preg_match('/^eval$/s', @$stack[$i]['function'])) {
                array_splice($stack, $i, 1);
                $i--;
            }
        }
        // Gray stack.
        foreach ($stack as $i=>$s) {
            foreach ($this->_bd_grayFuncs as $func) {
                $grayed = false;
                if (is_array($func)) {
                    $grayed = preg_match('/^'.$func[0].'$/si', @$s['class']) && preg_match('/^'.$func[1].'$/si', @$s['function']);
                } else {
                    $grayed = strval(@$s['class']) === "" && preg_match('/^'.$func.'$/si', @$s['function']);
                }
                $stack[$i]['grayed'] = !empty($stack[$i]['grayed']) || $grayed;
            }
        }
        // In croak mode we need to skip some stack elements.
        $first = $stack[0];
        $p = null;
        if (preg_match('/(\s+|^) croak \s* ([([] (\d+) [)\]])? \s*:\s*/isx', $errstr, $p) && @$stack[1]) {
            $errstr = str_replace($p[0], '', $errstr);
            // Find latest trigger_error() if present.
            $pos = 0;
            foreach ($stack as $i=>$s) {
                if (isset($s['function']) && !strcasecmp($s['function'], 'trigger_error')) { 
                    $pos = $i; 
                    break; 
                } 
            }
            // Use croak info (argument).
            $croakOffset = isset($p[3])? $p[3] : 0;
            // Skip all grayed elements - do not count them.
            for ($pos++; $pos<count($stack); $pos++) {
                if (!empty($stack[$pos]['grayed'])) continue;
                if (!$croakOffset) break;
                $croakOffset--;
            }
            if ($pos+1 > count($stack)-1) $pos = count($stack) - 2;
            $first = $stack[$pos];
        }
        // Save full error info.
        $this->_bd_trace = array(
            "errtype" => $type,
            "errno"   => $errno,
            "errstr"  => $errstr,
            "stack"   => $stack,
        ) + $first;
    }

    
    // array getTrace()
    // Returns associated stacktrace.
    function getTrace()
    {
        return $this->_bd_trace;
    }


    // string generate($contentType="html")
    // Return the the message (and, maybe, add it to the log).
    function generate($contentType="html") 
    {
        if (ini_get("display_errors")) {
            return $this->format(dirname(__FILE__)."/BacktraceDumper/$contentType.php");
        }
        if (ini_get("log_errors")) {
            error_log($this->format(dirname(__FILE__)."/BacktraceDumper/text.php"));
            return null;
        }
    }
    
    
    // void show($contentType="html")
    // Show the message (and, maybe, add it to the log).
    function show($contentType="html") 
    {
        $error = $this->generate($contentType);
        if ($error !== null) echo $error;
    }


    // string format(string $tplFile) 
    // Return formatted stacktrace.
    function format($tplFile=null) 
    {
        $error = $this->getTrace();
        if ($tplFile !== null) {
            $code = '?'.'>'.file_get_contents($tplFile).'<'.'?php';
            $code = preg_replace('/(\?>)(\r?\n)/sx', "$1<?php echo \"$2\"?>", $code);
            $code = preg_replace('/(<\? (?:php\s+)? ) echo (?=[\s(]) \s* (.*?) \s* (\?>)/xs', "$1 \$__result__ .= ($2); $3", $code);
            $code = preg_replace_callback('/\?>\r?\n?(.*?)<\?(?:php)?/s', array(&$this, '_genOutHtml'), $code);
#           echo nl2br(htmlspecialchars($code));
            $__result__ = '';
            eval($code);
            $text = $__result__;
        } else {
            $text = print_r($error, 1);
        }
        $text = preg_replace('/<!--.*?-->/s', "", $text);
        $text = preg_replace('/\t|^[ ]+/m', '', $text);
        $text = preg_replace('/\s*[\r\n]+/s', ' ', $text);
        $text = preg_replace('/\\\\n/s', "\n", $text);
        return $text;
    }


    // void set_error_handler()
    // Sets current PHP error handler to default.
    function set_error_handler() 
    {
        if (@$this && get_class($this) == __CLASS__) {
            $trace =& $this;
        } else {
            $trace =& new Debug_BacktraceDumper();
        }
        return set_error_handler(array(&$trace, "__errorHandler"));  
    }


    //
    // PRIVATE
    //
    
    // Internal - convertor from {?=...?} то eval code.
    // We cannot use ob_* functions, because error handler may be called
    // INSIDE ob_start() handler, but output handling inside OB handler is 
    // not supported in PHP. 
    function _genOutHtml($p) 
    {
        $text = str_replace("'", "\\'", str_replace("\\", "\\\\", $p[1]));
        return "; \$__result__ .= '".$text."'; ";
    }
    

    // Error handler.
    function __errorHandler($errno, $errstr, $errfile, $errline) 
    {
        if (!($errno & error_reporting())) return;
        $stack = array_splice(call_user_func($this->_db_stdTracer), 2); // PHP BUG! Need separate variable $stack!
        $this->prepare($errno, $errstr, $errfile, $errline, $stack);
        $this->show(isset($_SERVER['REQUEST_METHOD'])? 'html' : 'text');
    }


    // Tries to shrink filename.
    function _getDebugFileName($fname) 
    {
        $orig = false;
        for ($i=0; $orig!=$fname && $i<10; $i++) {
            $orig = $fname;
            foreach ($this->_bd_aliases as $a) {
                $fname = str_replace('\\', '/', $fname);
                $rootRe = $a['root']? preg_quote($a['root'], '/') : "";
                if ($a['isCallback'] || is_array($a['repl'])) {
                  $fname = preg_replace_callback("/^($rootRe).*/s", $a['repl'], $fname);
                } else {
                  $fname = preg_replace("/^($rootRe)/si", $a['repl'], $fname);
                }
            }
        }
        return $fname;
    }


    // Callback function for preg_replace_callback().
    // Fetches real file name from compiled template. 
    function __callbackGetSmartyTplName($p) 
    {
        $fname = $p[0];
        if (!file_exists($fname)) return $fname;
        $f = fopen($fname, "rb");
        for ($lines=array(), $i=0; $i<2; $i++) $lines[] = fgets($f, 1024);
        fclose($f);
        $lines = join('', $lines);
        $pock = null;
        if (!preg_match('/\bcompiled\s+from\s+(\S+)/s', $lines, $pock)) 
            return $fname;
        return $pock[1];
    }
}

//
// Example:
//   <?php
//   require_once "WEBINF/config.php";
//   require_once "Debug/BacktraceDumper.php";
//   Debug_BacktraceDumper::set_error_handler();
//   function F() { echo $nonExistent; }
//   echo "Hello, world!";
//   F();
//   echo "Hi there!";
//
?>