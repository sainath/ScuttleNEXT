<?php
$tagservice =& ServiceFactory::getServiceInstance('TagService');
$userservice =& ServiceFactory::getServiceInstance('UserService');

$logged_on_userid = $userservice->getCurrentUserId();
if ($logged_on_userid === false) {
    $logged_on_userid = NULL;
}
if ($currenttag) {
	$_SESSION['currenttag']=$currenttag;
    $relatedTags = $tagservice->getRelatedTags($currenttag, $userid, $logged_on_userid);
    if (sizeof($relatedTags) > 0) {
?>

<?php echo '<b class="text-sinfo">RELATED TAGS</b>'; ?>
<div id="related">
<ul class="nav nav-list bs-docs-sidenav">    
    <?php foreach($relatedTags as $row): ?>
        <li><a href="<?php echo sprintf($cat_url, filter($user, 'url'), filter($row['tag'], 'url')); ?>" rel="tag"><?php echo filter($row['tag']); ?></a></li>
    <?php endforeach; ?>
</ul>
</div>

<?php
    }
}
?>