<?php

require_once 'header.inc.php';

$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');
$url = $_GET['url'];

function getTitle($url) {
	$fd = @fopen($url, 'r');
	if ($fd) {
		$html = fread($fd, 1750);
		fclose($fd);

		// Get title from title tag
		preg_match_all('/<title>(.*)<\/title>/si', $html, $matches);
		$title = $matches[1][0];

		// Get encoding from charset attribute
		preg_match_all('/<meta.*charset=([^;"]*)">/i', $html, $matches);
		$encoding = strtoupper($matches[1][0]);

		// Convert to UTF-8 from the original encoding
		if (function_exists('mb_convert_encoding')) {
			$title = @mb_convert_encoding($title, 'UTF-8', $encoding);
		}

		if (utf8_strlen($title) > 0) {
			return $title;
		} else {
			// No title, so return filename
			//$uriparts = explode('/', $url);
			//$filename = end($uriparts);
			//unset($uriparts);

			//return $filename;
			return false;
		}
	} else {
		return false;
	}
}

if ($bookmarkservice->bookmarkExists($url)){
	$bookmark =& $bookmarkservice->getBookmarkByAddress($url);
	echo $bookmark['bTitle'];
}else{
	echo getTitle($_GET['url']);
}
