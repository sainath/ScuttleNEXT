<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');

$PAGE=$userservice->getPage();
if ($userservice->isLoggedOn()) {
	$userid = $userservice->getCurrentUserId();
	$total_count_of_bookmarks =& $userservice->getUserBookmarksCount($userid);
	$total_count_of_tags =& $userservice->getUserTagsCount($userid);

    $cUser = $userservice->getCurrentUser();

    $cUsername = $cUser[$userservice->getFieldName('username')];
	$cUserProfileName = $cUser['name'];
	
	
	$tagservice =& ServiceFactory::getServiceInstance('TagService');
	//$user_all_tags        =& $tagservice->getTags($userid);

	$addbookmarkactive='';
	if(isset($_SESSION['addbookmarkactive'])){
		$addbookmarkactive='active';
	}
	$starredactive='';
	if(isset($_SESSION['privateactive'])){
		$privateactive='active';
	}
	$tagsactive='';
	if(isset($_SESSION['tagsactive'])){
		$tagsactive='active';
	}
	$profileactive='';
	if(isset($_SESSION['profileactive'])){
		$profileactive='active';
	}

?>

<ul class="nav pull-left"><!-- <li><a href="<?php echo createURL('about'); ?>"><?php echo T_('About'); ?></a></li>	   --><!-- <li><a href="<?php echo createURL('bookmarks', $cUsername); ?>" title="access your favorite bookmarks from anywhere" class="brand"><?php echo T_('Home'); ?></a></li> --><!-- <li class="divider-vertical"></li> --><!-- <li><a class="brand" href="<?php echo createURL('why'); ?>">&nbsp;&nbsp;Why?</a></li> --><!-- <li class="divider-vertical"></li> -->
		
		<?php
		echo '<li class="divider">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>';
		//		echo '<li class="'.$popularactive.'"><a title="popular" href="'.createURL('popular', $cUsername).'">POPULAR</a></li>'; 

			//echo '<li class="'.$addbookmarkactive.'" ><a href="'.createURL('bookmarks', $cUsername . '?action=add').'">ADD BOOKMARK</a></li><li class="divider">&nbsp;</li>';
//			echo '<li class="'.$suggestionsactive.'"><a title="recommended" href="'.createURL('recommended', $cUsername).'">RECOMMENDED</a></li>'; 

echo '<li class="divider">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>';

			include 'search.inc.php';
		?>	

</ul>

<?php
	//include 'search.inc.php';
?>
	<div class="navbar-form pull-right">

		<ul class="nav">
		<?php
		

			unset($_SESSION['addbookmarkactive']);
			unset($_SESSION['privateactive']);
			unset($_SESSION['tagsactive']);
			unset($_SESSION['profileactive']);

			$name='';
			if($cUserProfileName != ""){
				$name = $cUserProfileName;
			}else{
				$name = $cUsername;
			}

		?>	
			<li class="divider">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

		  
		  <!-- <li class="active"><a href="<?php echo createURL('bookmarks', $cUsername . '?action=add'); ?>">ADD BOOKMARK</a></li> -->
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo createURL('profile', $cUsername); ?>"><i class="icon-user icon-white"></i>&nbsp;<?php echo $name.'&nbsp;'; ?><b class="caret"></b><!-- <b class="caret"></b> --></a>

			  <ul id="menu1" class="dropdown-menu">
				
			  <li><a href="<?php echo createURL('bookmarks', $cUsername); ?>">My Bookmarks</a></li>
			  <li><a href="<?php echo createURL('alltags', $cUsername); ?>">My Tags (<?php echo count($user_all_tags); ?>)</a></li>
			  <li><a href="<?php echo createURL('private', $cUsername); ?>">Private Bookmarks</a></li>
			  <li><a href="<?php echo createURL('bookmarks', $cUsername . '?action=add'); ?>">Add Bookmark</a></li>

				<!-- <li class="divider"></li> -->
				<li><a title="Tools" href="<?php echo createURL('tools', $cUsername); ?>">Tools</a></li>
				<li><a title="Account Settings" href="<?php echo $userservice->getProfileUrl($userid, $cUsername); ?>">Account Settings</a></li>
				<!-- <li class="divider"></li> -->
				<li class="access"><a href="<?php echo $GLOBALS['root']; ?>?action=logout"><?php echo T_('Sign out'); ?></a></li>
			  </ul>
			</li>
		  
		</ul>
	</div>
		
<!-- </div> --><!--/.nav-collapse -->

<?php
} else {
?>

	<ul class="nav pull-right">
		<li><a href="<?php echo createURL('news'); ?>" class=""><i class="icon-bullhorn icon-white"></i>&nbsp;News</a></li>
		<li><a href="<?php echo createURL('register'); ?>" class=""><i class="icon-share-alt icon-white"></i>&nbsp;Join Today</a></li>
		<li><a href="<?php echo createURL('login'); ?>" class=""><i class="icon-white icon-user"></i>&nbsp;Sign in</a></li>

	</ul>

<?php
}
?>
