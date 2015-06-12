<?php

require_once 'header.inc.php';

$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$cacheservice    =& ServiceFactory::getServiceInstance('CacheService');

$tplvars = array();
if (isset($_GET['action']) && 'logout' == $_GET['action']) {
  $userservice->logout($path);
  $tplvars['msg'] = T_('You have now logged out');
}

// Header variables
$tplVars['loadjs'] = true;
$tplVars['rsschannels'] = array(
    array(sprintf(T_('%s: My bookmarks'), $sitename), createURL('rss'))
);

if ($usecache) {
    // Generate hash for caching on
    $hashtext = $_SERVER['REQUEST_URI'];
    if ($userservice->isLoggedOn()) {
        $hashtext .= $userservice->getCurrentUserID();
    }
    $hash = md5($hashtext);

    // Cache for 15 minutes
    $cacheservice->Start($hash, 900);
}


	// Pagination
	$perpage = getPerPageCount();

	$tplVars['page']     = 0;
	$tplVars['start']    = 0;
	$tplVars['popCount'] = 30;
	$tplVars['sidebar_blocks'] = array('recent');
	$tplVars['range'] = 'all';
	$tplVars['pagetitle'] = T_('carry your favorite bookmarks whereever you are!');
	$tplVars['subtitle'] = T_('My Bookmarks');
	$tplVars['bookmarkCount'] = 1;
	//$bookmarks =& $bookmarkservice->getBookmarks(0, $perpage, NULL, NULL, NULL, getSortOrder(), NULL);
	$tplVars['total'] = $bookmarks['total'];
	$tplVars['bookmarks'] =& $bookmarks['bookmarks'];
	$tplVars['cat_url'] = createURL('tags', '%2$s');
	$tplVars['nav_url'] = createURL('index', '%3$s');

	// load the defaily bookmarks.php page
	header('Location: '. createURL('bookmarks'));

	$templateservice->loadTemplate('bookmarks.tpl', $tplVars);

	
if ($usecache) {
    // Cache output if existing copy has expired
    $cacheservice->End($hash);
}
