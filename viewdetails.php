<?php

require_once 'header.inc.php';

$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$tagservice      =& ServiceFactory::getServiceInstance('TagService');

// Header variables
$tplVars['subtitle'] = T_('View Details');
$tplVars['loadjs']   = TRUE;

list ($url, $bookmark) = explode('/', $_SERVER['PATH_INFO']);

$loggedon = false;
if ($userservice->isLoggedOn()) {
    $loggedon = true;
    $currentUser = $userservice->getCurrentUser();
    $currentUserID = $userservice->getCurrentUserId();
    $currentUsername = $currentUser[$userservice->getFieldName('username')];
}

if (!($row = $bookmarkservice->getBookmark(intval($bookmark), true))) {
    $tplVars['error'] = sprintf(T_('Bookmark with id %s was not found'), $bookmark);
    $templateservice->loadTemplate('error.404.tpl', $tplVars);
    exit();
} else {
    if (!$bookmarkservice->editAllowed($row)) {
        $tplVars['error'] = T_('You are not allowed to edit this bookmark');
        $templateservice->loadTemplate('error.500.tpl', $tplVars);
        exit();
    } else if ($_POST['submitted']) {
        if (!$_POST['title'] || !$_POST['address']) {
            $tplVars['error'] = T_('Your bookmark must have a title and an address');
        } else {
            // Update bookmark
            $bId = intval($bookmark);
            $address = trim($_POST['address']);
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $status = intval($_POST['status']);
            $tags = trim($_POST['tags']);

            $logged_on_user = $userservice->getCurrentUser();
            if (!$bookmarkservice->updateBookmark($bId, $address, $title, $description, $status, $tags)) {
                $tplvars['error'] = T_('Error while saving your bookmark');
            } else {
                if (isset($_POST['popup'])) {
					$_SESSION["messages"] = 'Bookmark saved Succefully ';
                    $tplVars['msg'] = (isset($_POST['popup'])) ? '<script type="text/javascript">window.close();</script>' : T_('Bookmark saved');
                } elseif (isset($_POST['referrer'])) {
                    header('Location: '. $_POST['referrer']);
                } else {
                    header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')]));
                }
            }
        }
    } else {
        if ($_POST['delete']) {
            // Delete bookmark
            if ($bookmarkservice->deleteBookmark($bookmark)) {
                $logged_on_user = $userservice->getCurrentUser();
                //if (isset($_POST['referrer'])) {
                //    header('Location: '. $_POST['referrer']);
                //} else {
                    header('Location: '. createURL('bookmarks', $logged_on_user[$userservice->getFieldName('username')]));
                //}
                exit();
            } else {
                $tplVars['error'] = T_('Failed to delete the bookmark');
                $templateservice->loadTemplate('error.500.tpl', $tplVars);
                exit();
            }
        }
    }
//	echo '<pre>';
//print_r($row['tags']);
	//$tags =& $tagservice->getTags($userid);
//	$tpl =& $tagservice->tagCloud($row['tags'], 5, 90, 225, getSortOrder()); 
//print_r($tpl);
	$tplVars['user'] = $currentUsername;
    $tplVars['popup'] = (isset($_GET['popup'])) ? $_GET['popup'] : null;
    $tplVars['row'] =& $row;
    $tplVars['formaction']  = createURL('edit', $bookmark);
    $tplVars['btnsubmit'] = T_('Save Changes');
    $tplVars['showdelete'] = true;
    $tplVars['referrer'] = $_SERVER['HTTP_REFERER'];
	//$_SESSION["messages"] = 'Succefully edited the bookmark.';
    $templateservice->loadTemplate('viewdetails.tpl', $tplVars);
}
