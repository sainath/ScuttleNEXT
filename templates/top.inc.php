<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title><?php echo filter($GLOBALS['sitename'] . (isset($pagetitle) ? ' - ' . $pagetitle : '')); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="<?php echo $GLOBALS['root']; ?>icon.png" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['root']; ?>scuttle.css" /> -->
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['root']; ?>css/bootstrap.css" />
<!-- 	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['root']; ?>css/jquery.toolbars.css" /> -->
<?php if ($loadjs): ?>
      <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/jquery-1.8.2.min.js"></script>
      
	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/bootstrap.js"></script>
	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/bootstrap-dropdown.js"></script>
	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/bootstrap-tooltip.js"></script>
	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/bootstrap-popover.js"></script>
	  
	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/enscroll.js"></script>
<!-- 	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/jquery.tocify.js"></script> -->
	<script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/jquery.validate.js"></script>
	  
<!-- 	  <script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>js/jquery.toolbar.js"></script> -->
<script type="text/javascript" src="<?php echo $GLOBALS['root']; ?>jsScuttle.php"></script>
	 

    <?php endif; ?>
    
</head>
<body>

<?php
$headerstyle = '';
if (isset($_GET['popup'])) {
    $headerstyle = ' class="popup"';
}

$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
	$currentUserID = $userservice->getCurrentUserId();
	$total_count_of_bookmarks =& $userservice->getUserBookmarksCount($currentUserID);
}



$tagservice =& ServiceFactory::getServiceInstance('TagService');
$user_all_tags        =& $tagservice->getTags($userid);

//echo $popularTagsCount;

$PAGE=$userservice->getPage();
?>

<div class="container">
    <div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container">
			  <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </a>
			  <a href="<?php echo createURL('bookmarks', $cUsername); ?>" title="Access your favorite bookmarks from anywhere" class="brand"><!-- <i class="icon-bookmark icon-white"></i>  --><IMG SRC="<?php echo $GLOBALS['root'];?>/img/logo.png" WIDTH="30" HEIGHT="30" BORDER="0" ALT=""> &nbsp;<?php echo $GLOBALS['sitename']; ?>&nbsp;&nbsp;<FONT SIZE="1" COLOR=""><B>[BETA]</B></FONT></a>   

			  <div class="nav-collapse collapse navbar-responsive-collapse">
				
				<?php
				if (!isset($_GET['popup'])) {
					$this->includeTemplate('toolbar.inc');
				}
				?>
				
			  </div><!-- /.nav-collapse -->

			</div>

		  </div><!-- /navbar-inner -->
		  
   </div>
</div>
<br>
<?php //if($cUsername){ ?>

<?php //} ?>


			<?php

			?>

<?php
if ($userservice->isLoggedOn()) {
?>
<br/><br/>

<?php }
else{
	// No Data
}

?>
<!-- </div> -->

<?php

if(!isset($_SESSION["messages"])){
	if (isset($msg)) {
		echo '<br><br><br><div class="container"><div class="alert alert-success">'. $msg .'</div></div>';
	}
}
?>
