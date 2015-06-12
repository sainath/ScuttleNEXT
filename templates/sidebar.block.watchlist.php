<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');

$watching = $userservice->getWatchNames($userid);
//echo T_('Starred'); 
if (!$watching) {
?>
<b><?php echo T_('Starred'); ?></b><br>
<div id="watching">
    <ul>
    <?php foreach($watching as $watchuser): ?>
        <li><a href="<?php echo createURL('bookmarks', $watchuser); ?>"><?php echo $watchuser; ?></a> &rarr;</li>
    <?php endforeach; ?>
    </ul>
</div>
<br>
<?php
}
?>