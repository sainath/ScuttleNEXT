<?php

require_once 'header.inc.php';
$tagservice = & ServiceFactory :: getServiceInstance('TagService');
$templateservice = & ServiceFactory :: getServiceInstance('TemplateService');
$userservice = & ServiceFactory :: getServiceInstance('UserService');

list ($url, $tag) = explode('/', $_SERVER['PATH_INFO']);

if ($_POST['confirm']) {
    if ($tagservice->deleteTag($tag)) {
        $tplVars['msg'] = T_('Tag deleted');
        $logged_on_user = $userservice->getCurrentUser();
		$_SESSION["messages"] = 'Succefully deleted the tag '.$tag;
        header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')]));
    } else {
        $tplVars['error'] = T_('Failed to delete the tag');
        $templateservice->loadTemplate('error.500.tpl', $tplVars);
        exit();
    }
} elseif ($_POST['cancel']) {
    $logged_on_user = $userservice->getCurrentUser();
    header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')] .'/'. $tags));
}

$tplVars['subtitle']    = T_('Delete Tag') .': '. $tag;
$tplVars['formaction']  = $_SERVER['SCRIPT_NAME'] .'/'. $tag;
$tplVars['referrer']    = $_SERVER['HTTP_REFERER'];
$templateservice->loadTemplate('tagdelete.tpl', $tplVars);

?>