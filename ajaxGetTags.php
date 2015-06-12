<?php

header('Content-Type: text/plain; charset=UTF-8');
header('Last-Modified: '. gmdate("D, d M Y H:i:s") .' GMT');
header('Cache-Control: no-cache, must-revalidate');
require_once 'header.inc.php';

function getTags($url) {
    $fd = @fopen($url, 'r');
    if ($fd) {
        $html = fread($fd, 1750);
        fclose($fd);

		$tags = get_meta_tags($url);
        // Get title from title tag
        $title = $tags['keywords'];

        // Get encoding from charset attribute
        preg_match_all('/<meta.*charset=([^;"]*)">/i', $html, $tags);
        $encoding = strtoupper($matches[1][0]);

        // Convert to UTF-8 from the original encoding
        if (function_exists('mb_convert_encoding')) {
            $title = @mb_convert_encoding($title, 'UTF-8', $encoding);
        }

        if (utf8_strlen($title) > 0) {
            return $title;
        } else {
            // No title, so return filename
           // $uriparts = explode('/', $url);
            //$filename = end($uriparts);
            //unset($uriparts);

            //return $filename;
			 return false;
        }
    } else {
        return false;
    }
}
echo getTags($_GET['url']);
