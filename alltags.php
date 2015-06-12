<?php

require_once 'header.inc.php';

$_SESSION['pagename']='tags';
$_SESSION['tagsactive'] = '1';

$templateservice =& ServiceFactory::getServiceInstance('TemplateService');
$tagservice      =& ServiceFactory::getServiceInstance('TagService');
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$cacheservice    =& ServiceFactory::getServiceInstance('CacheService');

@list($url, $user) = explode('/', $_SERVER['PATH_INFO']);
if (!$user) {
    header('Location: '. createURL('populartags'));
    exit;
}

if ($usecache) {
    // Generate hash for caching on
    $hashtext = $_SERVER['REQUEST_URI'];
    if ($userservice->isLoggedOn()) {
        $hashtext .= $userservice->getCurrentUserID();
    }
    $hash = md5($hashtext);

    // Cache for an hour
    $cacheservice->Start($hash, 3600);
}

// Header variables
$tplvars = array();
$pagetitle = T_('Personal Tags');

if (isset($user) && $user != '') {
    if (is_int($user)) {
      $userid = intval($user);
    } else {
        if ($userinfo = $userservice->getUserByUsername($user)) {
            $userid =& $userinfo[$userservice->getFieldName('primary')];
        } else {
            $tplVars['error'] = sprintf(T_('User with username %s was not found'), $user);
            $templateservice->loadTemplate('error.404.tpl', $tplVars);
            //throw a 404 error
            exit();
        }
    }
//    $pagetitle .= ' : '. ucfirst($user);
} else {
    $userid = NULL;
}

$tags =& $tagservice->getTags($userid);
$tplVars['tags'] =& $tagservice->tagCloud($tags, 5, 90, 225, getSortOrder()); 
$tplVars['user'] = $user;

if (isset($userid)) {
    $tplVars['cat_url'] = createURL('bookmarks', '%s/%s');
} else {
    $tplVars['cat_url'] = createURL('tags', '%2$s');
}

$tplVars['subtitle'] = $pagetitle;
$tplVars['pagetitle'] = $pagetitle;
$templateservice->loadTemplate('tags.tpl', $tplVars);

if ($usecache) {
    // Cache output if existing copy has expired
    $cacheservice->End($hash);
}
unset($_SESSION['tagsactive']);
unset($_SESSION['pagename']);
?>

