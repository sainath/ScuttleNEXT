<?php

header('Content-Type: text/plain; charset=UTF-8');
header('Last-Modified: '. gmdate("D, d M Y H:i:s") .' GMT');
header('Cache-Control: no-cache, must-revalidate');
require_once 'header.inc.php';

$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');
$bookmark = intval($_GET['id']);
if (!$bookmarkservice->editAllowed($bookmark)) {
  echo T_('You are not allowed to delete this bookmark');
} elseif ($bookmarkservice->deleteBookmark($bookmark)) {
	$_SESSION['messages']='Deleted bookmark successfully';
  echo true;
} else {
  echo T_('Failed to delete bookmark');
}
