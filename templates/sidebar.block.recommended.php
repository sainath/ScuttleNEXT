<?php
$tagservice =& ServiceFactory::getServiceInstance('TagService');
$userservice =& ServiceFactory::getServiceInstance('UserService');

$logged_on_userid = $userservice->getCurrentUserId();
if ($logged_on_userid === false) {
    $logged_on_userid = NULL;
}
//if ($currenttag) {
	$_SESSION['currenttag']=$currenttag;
    $relatedTags = $tagservice->getRelatedTags($currenttag, $userid, $logged_on_userid);
    if (sizeof($relatedTags) > 0) {
?>
	   

<?php
 //   }
}
?>