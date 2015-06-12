<?php

require_once 'header.inc.php';

$tagservice = & ServiceFactory :: getServiceInstance('TagService');
$templateservice = & ServiceFactory :: getServiceInstance('TemplateService');
$userservice = & ServiceFactory :: getServiceInstance('UserService');

list ($url, $tag) = explode('/', $_SERVER['PATH_INFO']);

if ($_POST['confirm']) {
	if (isset($_POST['old']) && (trim($_POST['old']) != ''))
	    $old = trim($_REQUEST['old']);
	else
	    $old = NULL;

	if (isset($_POST['new']) && (trim($_POST['new']) != ''))
	    $new = trim($_POST['new']);
	else
	    $new = NULL;

	if (is_null($old) || is_null($new)) {
	     $tplVars['error'] = T_('Failed to rename the tag');
	     $templateservice->loadTemplate('error.500.tpl', $tplVars);
	     exit();
	} else {
	    // Rename the tag.
	    if($tagservice->renameTag($userservice->getCurrentUserId(), $old, $new, true)) {
		     $tplVars['msg'] = T_('Tag renamed');
		     $logged_on_user = $userservice->getCurrentUser();
			 $_SESSION["messages"] = 'Succefully renamed the tag from '.$old.' to '.$new;
		     header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')]));
		} else {
		     $tplVars['error'] = T_('Failed to rename the tag1');
		     $templateservice->loadTemplate('error.500.tpl', $tplVars);
		     exit();
		}
	}
} elseif ($_POST['cancel']) {
    $logged_on_user = $userservice->getCurrentUser();
    header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')] .'/'. $tags));
}

$tplVars['subtitle']    = T_('Rename Tag') .': '. $tag;
$tplVars['formaction']  = $_SERVER['SCRIPT_NAME'] .'/'. $tag;
$tplVars['referrer']    = $_SERVER['HTTP_REFERER'];
$tplVars['old'] = $tag;
$templateservice->loadTemplate('tagrename.tpl', $tplVars);
?>
 	  	 
