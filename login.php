<?php

require_once 'header.inc.php';
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars = array();

// Header variables
$tplVars['loadjs'] = true;

$login = false;
//echo '<pre>';

if (isset($_POST['submitted']) && isset($_POST['username']) && isset($_POST['password'])) {
    $posteduser = trim(utf8_strtolower($_POST['username']));
    $login      = $userservice->login($posteduser, $_POST['password'], ($_POST['keeppass'] == 'yes'), $path); 
    if ($login) {
        if ($_POST['query'])
            header('Location: '. createURL('bookmarks', $posteduser .'?'. $_POST['query']));
        else
            header('Location: '. createURL('bookmarks', $posteduser ));
    } else {
        $tplVars['error'] = T_('Invalid username/password combination. <br>Please try again.');
    }
}
if (!$login) { 
    if ($userservice->isLoggedOn()) {
        $cUser = $userservice->getCurrentUser();
        $cUsername = strtolower($cUser[$userservice->getFieldName('username')]);
        header('Location: '. createURL('bookmarks', $cUsername));
    }

    $tplVars['subtitle']    = T_('sign in');
	$tplVars['pagetitle']    = T_('Sign in');
    $tplVars['formaction']  = createURL('login');
    $tplVars['querystring'] = filter($_SERVER['QUERY_STRING']);
    $templateservice->loadTemplate('login.tpl', $tplVars);
}
?>
