<?php
/**
 * Some filepath related tools.
 */

class File_Path {
    var $VERSION = "1.20";

    // Return the absolute path.
    function absPath($name, $cur=false) 
    {
        // Glue full name.
        if ($cur === false) $cur = getcwd();
        if (!File_Path::isAbsolute($name))
            $name = File_Path::gluePath($cur, $name);
        $orig = preg_split("{[/\\\\]}s", $name);
        $absolute = File_Path::isAbsolute($name);
        // Delete ".." and "." parts.
        $parts = array();
        foreach ($orig as $e) {
            if ($e == ".")  continue;
            else if ($e == "..") {
                $size = sizeof($parts);
                if ($size > 1) array_pop($parts);
                else if (!$absolute) $parts = array(".");
            }
            else $parts[] = $e;
        }
        // Process root separately.
        if (!sizeof($parts)) return ".";
        if ($absolute && sizeof($parts)==1 && $parts[0] === "") return "/";
        return implode("/", $parts);
    }

    // Glue two pathes avoiding slashes duplicates.
    // Also normalize slashes (converts to "/").
    function gluePath($dir, $fname) 
    {
        $all = $dir."/".$fname;
        $all = preg_replace("{[\\\\//]+}s", "/", $all);
        $all = preg_replace("{/$}s", "", $all);
        return $all;
    }

    // Return true if the path is absolute.
    function isAbsolute($path) 
    {
        return preg_match("{^(\w:)?[/\\\\]}s", $path);
    }

    // Create directory structure.
    function mkdirs($strPath, $mode) 
    {
        if (file_exists($strPath) && is_dir($strPath)) return true;
        $pStrPath = dirname($strPath);
        if (!File_Path::mkdirs($pStrPath, $mode)) return false;
        return mkdir($strPath);
    }

    // Remove directory subtree
    function rmdirs($path)
    {
        if (!@is_dir($path) || @is_link($path)) {
            return unlink($path);
        }
        if (@is_dir($path)) {
            if (@rmdir($path)) return true;
            $d = opendir($path);
            while (false !== ($e=readdir($d))) {
                if ($e == "." || $e == "..") continue;
                $ok = File_Path::rmdirs("$path/$e");
                if (!$ok) return $ok;               
            }
            closedir($d);
            return rmdir($path);
        }
        return false;
    }
}

?>