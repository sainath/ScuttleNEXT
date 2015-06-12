<?php

$userservice     =& ServiceFactory::getServiceInstance('UserService');

 $currentUser = $userservice->getCurrentUser();
    $currentUserID = $userservice->getCurrentUserId();
    $currentUsername = $currentUser[$userservice->getFieldName('username')];
?>

<div class="container-narrow minheight">
	<div class="jumbotron">
	<br>
			<h3>Congratulations, you have successfully created your login</h3>
			<p class="lead">Now you can access your favorite bookmarks from anywhere and from any computer.<br> Click here to start adding your bookmarks</p>
			<?php 			

			
			$addurl =createURL('bookmarks', $currentUsername .'?action=add');   ?>
			<a class="btn btn-large btn-success" href="<?php echo $addurl ?>"><?php echo T_('Add Bookmark'); ?></a>
	</div>

	<br>

</div>