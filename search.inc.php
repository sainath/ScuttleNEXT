
<form class="navbar-form pull-rights form-wrapper" id="search" action="<?php echo createURL('search'); ?>" method="post">
<?php
	$logged_on = FALSE;
	if ($userservice->isLoggedOn()) {
		$currentUser = $userservice->getCurrentUser();
		$currentUsername = $currentUser[$userservice->getFieldName('username')];
		$logged_on = TRUE;
	}
	if ($logged_on || isset($currentUsername)) {
		//echo T_('Search' /* Search ... for */);
?><!-- <li class="divider-vertical"></li> -->
		<input type="hidden" name="range" value="<?php echo $currentUsername ?>" />
		<input type="hidden" name="user" value="<?php echo $currentUsername ?>" />
<!-- 		<input type="text" class="span2"> -->
    <div class="input-append">
		<input id="search1" type="text" placeholder="Search" class="span2" name="terms" size="50" value="<?php echo filter($terms); ?>" />
		<button class="btn" type="submit">Go!</button>
		<!-- <button type="submit" class="btn">Search</button> -->
		<!-- &nbsp;&nbsp;<input class="btn" type="submit" value="Search tags/bookmarks" src="<?php echo $GLOBALS['root']; ?>../img/search.png"/> -->		
    </div>
	<div class="hider"></div>

<?php		
	}
?>
</form>
