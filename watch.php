<?php

require_once 'header.inc.php';
$userservice =& ServiceFactory::getServiceInstance('UserService');

@list($url, $user) = isset($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : NULL;
if ($userservice->isLoggedOn() && $user) {
    $tplVars = array();
    $pagetitle = '';

    if (is_int($user)) {
        $userid = intval($user);
    } else {
        if (!($userinfo = $userservice->getUserByUsername($user))) {
            $tplVars['error'] = sprintf(T_('User with username %s was not found'), $user);
            $templateservice->loadTemplate('error.404.tpl', $tplVars);
            exit();
        } else {
            $userid =& $userinfo['uId'];
        }
    }

    $watched = $userservice->getWatchStatus($userid, $userservice->getCurrentUserId());
    $changed = $userservice->setWatchStatus($userid);

    if ($watched) {
        $tplVars['msg'] = T_('User removed from your watchlist');
    } else {
        $tplVars['msg'] = T_('User added to your watchlist');
    }

    $currentUser = $userservice->getCurrentUser();
    $currentUsername = $currentUser[$userservice->getFieldName('username')];

    header('Location: '. createURL('watchlist', $currentUsername));
}
?>
