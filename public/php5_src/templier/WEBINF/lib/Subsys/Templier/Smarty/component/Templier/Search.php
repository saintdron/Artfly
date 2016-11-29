<?php ## Поиск по файлам сайта методом прямого перебора.
require_once "File/Path.php";
require_once "Templier/Menu.php";
require_once "Tools/PagesList.php";

class Templier_Search extends Templier_Menu
{
    var $mask = "*.htm*";
    var $title = "title"; // lower case!!!
    var $text = "text";
    var $uri = null;
    var $pageSize = 2;
    var $contextSize = 60;

    function main($params)
    {
        $this->LINES_TO_READ = null;
        $params['recurrent'] = true;
        
        setlocale(LC_ALL, 'ru_RU.CP1251');

        $search = @$_GET['q'];
        $p = @$_GET['p']? $_GET['p'] : 0;
        if ($search === null) return null;
        
        $map = parent::main($params);
        $map['q'] = $search;
        $elements =& $map['elements'];
//        echo "<xmp>"; print_r($elements); echo "</xmp>";          
        $n = 0;
        foreach ($elements as $i=>$item) {
            $match = $this->_matched(@$item['blocks'][$this->text], $search);
            if (!$match) continue;
            $elements[$i]['n'] = ++$n;
            $elements[$i]['found'] = $match;
        }
        $elements = array_filter($elements, create_function('$a', 'return !empty($a["found"]);'));
        $map['total'] = count($elements);
        $map['pages'] = Tools_PagesList::make($this->pageSize, $map['total']);

        $elements = array_slice($elements, $p, $this->pageSize);
        return $map;
    }

    function _matched($text, $mask)
    {
        if (empty($text)) return;
        $text = strip_tags($text);
        $text = preg_replace('/\{.*?\}/s', '', $text);
        if (!preg_match('/(.?)\b('.preg_quote($mask, '/').')(.{0,'.$this->contextSize.'})((?:.|&\w+;)?)/is', $text, $p)) return; 
        return ($p[1]? '...' : '') . "<b>{$p[2]}</b>" . $p[3] . ($p[4]? '...' : '');
    }
}
?>