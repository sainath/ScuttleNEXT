<?php
$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
}
?>

<hr>
<div class="footer">
<div class="container">

	<div class="row links-horizontal">
		<div class="span9">
			<ul>
<!-- 				<li>Product</li> -->
				<li><a href="<?php echo createURL('bookmarks', $cUsername); ?>">home</a></li>
				<li><a href="<?php echo createURL('aboutus', $cUsername); ?>">about us</a></li>
				<!-- <li><a href="<?php echo createURL('pricing', $cUsername); ?>">pricing</a></li> -->
				<?php $email='mailto:'.$GLOBALS['adminemail'].'?subject=Feedback'; ?>
				<li><a href="<?php echo $email; ?>">contact us</a></li>
				<li class="divider-vertical"></li>
				<li><a href="<?php echo createURL('privacy', $cUsername); ?>">privacy</a></li>
				<!-- <li><a href="<?php echo createURL('features', $cUsername); ?>">features</a></li> -->
				<li><a href="<?php echo createURL('tools', $cUsername); ?>">tools</a></li>
 				<!-- <li><a href="<?php echo createURL('import', $cUsername); ?>">import bookmarks</a></li>  -->
				
				
				
				<li><a href="<?php echo createURL('help', $cUsername); ?>">help</a></li>				
			</ul>
		</div>
		
				
			<a class="pull-right" href="<?php echo createURL('bookmarks', $cUsername); ?>" class="brand"><?php echo $GLOBALS['sitename']; ?></a><br>
			<span class="pull-right" style="color: #777777;"> Access your favorite bookmarks from anywhere!! </span><br>
			<span class="pull-right" style="color: #BDBDBD;"> copyright &copy; 2013. All rights reserved</span>
		<hr>

		<div class="span9 pull-left">
		
			<ul style="color: #BDBDBD;"><i class="icon-heart"></i>&nbsp;Made with love in Hyderabad, India.</ul>
		</div>
	
	</div>
	
<!-- 	<p>Copyright </p> -->
</div>
</div>

</body>

</html>
