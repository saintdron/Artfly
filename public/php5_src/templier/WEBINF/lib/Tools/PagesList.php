<?php
/**
 * Tools_PagesList: generate page navigator.
 * @version 1.01
 */
 
class Tools_PagesList 
{
    function make($pageSize, $nElts, $curElt=null, $url=false, $arg="p") 
    { 
        $pages = array();
        $pageSize = intval($pageSize);
        if ($pageSize <= 0) $pageSize = 10;
        if ($url === false) $url = $_SERVER["REQUEST_URI"];
        if ($curElt === null) $curElt = isset($_GET[$arg])? $_GET[$arg] : 0;
        for ($n=1,$i=0; $i<$nElts; $i+=$pageSize,$n++) {
            if (preg_match("/([?&]$arg=)\d+/s", $url)) {
                $purl = preg_replace("/([?&]$arg=)\d+/s", '${1}'.$i, $url);
            } else {
                $div = strpos($url, "?")? "&" : "?";
                $purl = $url.$div.$arg."=".$i;
            }
            $pages[] = array(
                "n"       => $n,
                "pos"     => $i,
                "isfirst" => false,
                "islast"  => false,
                "url"     => $purl,
                "iscur"   => $curElt>=$i && $curElt<$i+$pageSize,
            );
        }
        if (count($pages)) {
            $pages[0]["isfirst"] = 1;       
            $pages[count($pages)-1]["islast"] = 1;
            if ($curElt >= $nElts) $pages[count($pages)-1]["iscur"] = true;
        }
        return $pages;
    }
    
    function frame($frameSize, $pageSize, $nElts, $curElt=null, $url=false, $arg="p")
    {
        $pages = Tools_PagesList::make($pageSize, $nElts, $curElt, $url, $arg);
        for ($i=0; $i<count($pages); $i++) if ($pages[$i]['iscur']) break;
        $cur = $i;
        $start = 0;
        if ($i > $frameSize/2) $start = intval($i-$frameSize/2);
        if (count($pages) - $start < $frameSize) $start = count($pages) - $frameSize;
        $start = max($start, 0);
        $framePages = array_slice($pages, $start, $frameSize);
        
        $frame = array();
        if ($start != 0) {
            $prevframe = max($cur - $frameSize, 0);
            $frame['prevframe'] = $pages[$prevframe];
        }
        if ($cur != 0) {
            $prev = max($cur - 1, 0);
            $frame['prev'] = $pages[$prev];
        }
        if ($start + $frameSize < count($pages)) { 
            $nextframe = min($cur + $frameSize, count($pages)-1);
            $frame['nextframe'] = $pages[$nextframe];
        }
        if ($cur+1 <= count($pages)-1) {
            $next = min($cur + 1, count($pages)-1);
            $frame['next'] = $pages[$next];
        }
        $frame['pages'] = $framePages;
        
        return $frame;
    }
}
?>