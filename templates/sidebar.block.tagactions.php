<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $currentUser = $userservice->getCurrentUser();
    $currentUsername = $currentUser[$userservice->getFieldName('username')];

    if ($currentUsername == $user) {
        $tags = explode('+', $currenttag);
        $renametext = T_ngettext('rename tag', 'rename tags', count($tags));
        $renamelink = createURL('tagrename', $currenttag);
        $deletelink = createURL('tagdelete', $currenttag);
?>

<?php echo '<b>Actions for Tag ('.$currenttag.')</b>'; ?>
<div id="tagactions">
    <ul class="nav nav-list bs-docs-sidenav">
        <li><a href="<?php echo $renamelink; ?>"><?php echo $renametext ?></a></li>
        <?php if (count($tags) == 1): ?>
        <li><a href="<?php echo $deletelink; ?>"><?php echo T_('delete tag') ?></a></li>
        <?php endif; ?>
    </ul>
</div>

<?php
    }
}
?>
