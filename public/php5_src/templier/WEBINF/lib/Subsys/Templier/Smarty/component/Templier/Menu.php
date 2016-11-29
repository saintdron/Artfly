<?php ## Формирует меню текущего раздела.
require_once "File/Path.php";

class Templier_Menu extends Subsys_Templier_Component
{
    var $LINES_TO_READ = 6;
    var $mask = "*.htm*";
    var $title = "title"; // lower case!!!
    var $order = "order";
    var $grayed = "grayed";
    var $uri = null;
    var $recurrent = false;

    function main($params)
    {
        // Fetch arguments.
        if (isset($params['mask']))  $this->mask  = $params['mask'];
        if (isset($params['title'])) $this->title = strtolower($params['title']);
        if (isset($params['order'])) $this->order = strtolower($params['order']);
        if (isset($params['uri']))   $this->uri   = $params['uri'];
        if (isset($params['recurrent']))  $this->recurrent = $params['recurrent'];

        $parent = $this->templier->requestContext->getParent();
        $data = $this->_getElements($this->uri);
        return array(
            "root"     => $parent->isRoot(),
            "elements" => $data,
        );
    }
    
    function _getElements($uri=null)
    {
        $data = array();
        // Iterate throught the files.
        $parent = $this->templier->requestContext->getParent();
        if ($uri!==null) $parent =& $parent->getRelative($uri);
        $data = array();
        foreach ($parent->getChildren() as $child) {
            $file = $this->_parseFile($child);
            if ($file) $data[] = $file;
        }

        // Sort using order info.
        usort($data, array(&$this, '_sortCallback'));
        // Resurse.
        if ($this->recurrent) {
            $curDirData = $data;
            $data = array();
            foreach ($curDirData as $file) {
                $data[] = $file;
                if ($file['context']['isdir']) {
                    $data = array_merge($data, $this->_getElements($file['context']['uri']));
                    $data[] = array("levelOut"=>true);
                }
            }
        }
        return $data;
    }

    # Parse file into blocks.
    function _parseFile($context)
    {
        if (!$context->isValid()) return;
        $fname = $context->fname;
        $blocks = array();
        $f = @fopen($fname, "rb");
        if (!$f) return;

        $content = '';
        if ($this->LINES_TO_READ) {
            for ($i=0; $i<$this->LINES_TO_READ && !feof($f); $i++) {
                $content .= fgets($f, 1024);
            }
        } else {
            $content = fread($f, filesize($fname));
        }

        fclose($f);

        $parts = preg_split('/^##([^\s=#]+)(?:\s*=\s*)?/ms', $content, 0, PREG_SPLIT_DELIM_CAPTURE);
        for ($i=1; $i<count($parts); $i+=2) {
            $name = $parts[$i];
            $value = $parts[$i+1];
            $value = preg_replace('/^(["\'])(.*)\1$/s', '$2', $value);
            $blocks[strtolower($name)] = trim($value);
        }

        if (!isset($blocks[$this->title])) return;
        $bOrd = isset($blocks[$this->order])? $blocks[$this->order] : null;
        if ($bOrd && $bOrd->value === '') return;
        $bgrayed = isset($blocks[$this->grayed])? $blocks[$this->grayed] : null;
        $result = array(
            'context'  => $context->getDump(),
            'title'    => $blocks[$this->title],
            'order'    => $bOrd? $bOrd: '',
            'grayed'   => $bgrayed? $bgrayed : '',
            'blocks'   => $blocks,
        );
        return $result;
    }

    function _sortCallback($a, $b)
    {
        list ($aT, $bT) = array($a['title'], $b['title']);
        list ($aO, $bO) = array($a['order'], $b['order']);
        list ($aD, $bD) = array($a['context']['isdir'], $b['context']['isdir']);
        if ($aO !== null && $bO !== null) return strnatcmp($aO, $bO);
        if ($aD && !$bD) return -1;
        if (!$aD && $bD) return 1;
        return strcasecmp($aT, $bT);
    }
}
?>