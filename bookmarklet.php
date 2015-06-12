<?php

require_once 'header.inc.php';

$_SESSION['pagename']='bookmarklet';

$templateservice =& ServiceFactory::getServiceInstance('TemplateService');
//$tagservice      =& ServiceFactory::getServiceInstance('TagService');
$userservice     =& ServiceFactory::getServiceInstance('UserService');
//$cacheservice    =& ServiceFactory::getServiceInstance('CacheService');

if ($userservice->isLoggedOn()) {

	// Header variables
	$tplvars = array();
	$pagetitle = T_('Add Bookmarklet');

	$tplVars['user'] = $user;

	//$tplVars['cat_url'] = createURL('bookmarks', '%s/%s');
	
	$tplVars['subtitle'] = $pagetitle;
	$templateservice->loadTemplate('bookmarklet.tpl', $tplVars);
}

?>
