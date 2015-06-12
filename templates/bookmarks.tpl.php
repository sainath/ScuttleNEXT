<?php

function getFavicon($linkurl){
	//$linkurl = $_GET['url'];
	$linkurl = str_replace("http://",'',$linkurl); // remove protocol from the domain
	$imgurl = "http://www.google.com/s2/favicons?domain=" . $linkurl;
	return $imgurl;
}

$userservice     =& ServiceFactory::getServiceInstance('UserService');
$bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');

$logged_on_userid = $userservice->getCurrentUserId();
$currentUser = $userservice->getCurrentUser();
$currentUsername = $currentUser[$userservice->getFieldName('username')];

$this->includeTemplate($GLOBALS['top_include']);

?>
<div class="container minheight"> <!-- 1 MAIN container START -->
	<div class="container-fluid"> <!-- 2 container-fluid START -->
		<div class="row-fluid">	<!-- 3 row-fluid START -->

	<?php

		if (isset($error)) {
		  echo '<div class="alert alert-error">'.$error.'</div>';
		}

			if($_SESSION["messages"] != ""){
				$custom_message=trim($_SESSION["messages"]);
				echo '<div class="alert alert-success">'.$custom_message.'</div>';
			}
			$_SESSION["messages"] = "";	

//if (count($bookmarks) > 0) {
if ($userservice->isLoggedOn() && (count($bookmarks) > 0)) {
?>


<div class="span2 block pull-right"><?php if ($PAGE != "bookmarklet") { ?>
	<!-- <span class="text-sinfo">Add bookmark with a single click.<br>
	
	</span> -->
	<?php 
			//include 'search.inc.php';
		?>

			<center><a class="btn btn-info" href="<?php echo createURL('bookmarks', $currentUsername . '?action=add'); ?>"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Add Bookmark</a></center><br>
			<a class="text-sinfo" href="<?php echo createURL('sethomepage', $currentUsername); ?>">Make ScuttleNEXT your homepage</a>
<hr>
	
	<?php 
		
	} ?>

<b class="text-sinfo">RECOMMENDED</b>
</div>

<?php
}else{
?>


<?php } ?>		

			<?php
			



//if (count($bookmarks) > 0) {
if ($userservice->isLoggedOn()) {


?>
	<?php

if (count($bookmarks) == 0) {


	$this->includeTemplate('home-first-time-login.tpl');
}

if (count($bookmarks) > 0) {

	echo '<div class="span10 block pull-right">';

?>

<div class="row-fluid">

	  <ul class="nav breadcrumb nav-pills">
		<li><a href="<?php echo createURL('bookmarks', $currentUsername); ?>">Home</a><!--  <span class="divider">/</span> --></li>
		

		<li class="dropdown">
			  <a  class="dropdown-toggle" data-toggle="dropdown" href="<?php echo createURL('bookmarks', $currentUsername); ?>"><!-- <i class="icon-user icon-white"></i> -->&nbsp;My Bookmarks&nbsp;<b class="caret"></b><!-- <b class="caret"></b> --></a>


			  <ul class="dropdown-menu">
				
			  <li><a href="<?php echo createURL('bookmarks', $currentUsername); ?>">My Bookmarks</a></li>
			  <li><a href="<?php echo createURL('alltags', $currentUsername); ?>">My Tags (<?php echo count($user_all_tags); ?>)</a></li>
			  <li><a href="<?php echo createURL('private', $currentUsername); ?>">Private Bookmarks</a></li>
			  <li><a href="<?php echo createURL('bookmarks', $currentUsername . '?action=add'); ?>">Add Bookmark</a></li>

				<!-- <li class="divider"></li> -->
				<li><a title="Tools" href="<?php echo createURL('tools', $currentUsername); ?>">Tools</a></li>
				<li><a title="Account Settings" href="<?php echo $userservice->getProfileUrl($userid, $currentUsername); ?>">Account Settings</a></li>
				<!-- <li class="divider"></li> -->
				<li class="access"><a href="<?php echo $GLOBALS['root']; ?>?action=logout"><?php echo T_('Sign out'); ?></a></li>
			  </ul>
			</li>


		<li class="pull-right ">
			<div id="sort" >
			 <a title="Sort by Date" href="?sort=date_desc">Date</a><span class="divider">/</span>
			 <a title="Sort by Title" href="?sort=title_asc">Title</a><!-- <span class="divider">/</span> -->
	  		<!-- <a href="?sort=url_asc">URL</a> -->
	     </div></li>    

	  </ul>
</div>
<?php

	echo '<div class="row-fluid">';

    foreach(array_keys($bookmarks) as $key) {
        $row =& $bookmarks[$key];
		$bookmark_id=$row["bId"];

        switch ($row['bStatus']) {
            case 0:
                $access = '';
                break;
            case 1:
                $access = ' shared';
                break;
            case 2:
                $access = ' private';
                break;
        }

        $cats = '';
        $tags = $row['tags'];
        foreach(array_keys($tags) as $key) {
            $tag =& $tags[$key];
            $cats .= '<a href="'. sprintf($cat_url, filter($user, 'url'), filter($tag, 'url')) .'" rel="tag">'. filter($tag) .'</a>, ';
        }
        $cats = substr($cats, 0, -2);
        if ($cats != '') {
            $cats = ' tags - '. $cats;
        }

        // Edit and delete links
        $edit = '';
        if ($bookmarkservice->editAllowed($row['bId'])) {
            $edit = '<a href=/"'. createURL('viewdetails', $currentUsername .'?action=view&amp;address='. urlencode($row['bAddress']) .'&amp;title='. urlencode($row['bTitle'])) .'">'. T_('details') .'</a> | <a href="'. createURL('edit', $row['bId']) .'">'. T_('edit') .'</a><script type="text/javascript">document.write(" | <a href=\"#\" onclick=\"deleteBookmark(this, '. $row['bId'] .');  return false;\">'. T_('delete') .'<\/a>");</script>';
        }

        // User attribution
        $copy = '';
        if (!isset($user) || isset($watched)) {
            $copy = ' '. T_('by') .' <a href="'. createURL('bookmarks', $row['username']) .'">'. $row['username'] .'</a>';
        }

        // Udders!
        if (!isset($hash)) {
            $others = $bookmarkservice->countOthers($row['bAddress']);
            $ostart = '<a href="'. createURL('history', $row['bHash']) .'">';
            $oend = '</a>';
            switch ($others) {
                case 0:
                    break;
                case 1:
                    $copy .= sprintf(T_(' and %s1 other%s'), $ostart, $oend);
                    break;
                default:
                    $copy .= sprintf(T_(' and %2$s%1$s others%3$s'), $others, $ostart, $oend);
            }
        }

        // Copy link
        if ($userservice->isLoggedOn() && ($logged_on_userid != $row['uId'])) {
            // Get the username of the current user
            $currentUser = $userservice->getCurrentUser();
            $currentUsername = $currentUser[$userservice->getFieldName('username')];
            $copy .= ' - <a href="'. createURL('bookmarks', $currentUsername .'?action=add&amp;address='. urlencode($row['bAddress']) .'&amp;title='. urlencode($row['bTitle'])) .'">'. T_('Copy') .'</a>';   
        }

        // Nofollow option
        $rel = '';
        if ($GLOBALS['nofollow']) {
            $rel = ' rel="nofollow"';
        }

        $address = filter($row['bAddress']);
        
        // Redirection option
        if ($GLOBALS['useredir']) {
            $address = $GLOBALS['url_redir'] . $address;
        }
        
	echo '<div class="thumbnail span3 wrapper '. $access .'">';
//}

?>

<?php

echo '<div class="bookitem hover-group">';

			$thumbnail='http://img.bitpixels.com/getthumbnail?code=53738&size=200&url='.$address;

$show_details = '<a class="btn btn-mini btn-primary" style="font-size:10.5px;" href="'. createURL('viewdetails', $row['bId']) .'" >'. T_('details') .'</a>'; 

echo '<span class="img-container"><img src="'.$thumbnail.'" width="200" height="150" style="border:1px solid #f6f6f6;"/><div class="hover-toggle btn-group">
                  '.$show_details.'                  
               </div></span><br>';

$base_url = parse_url($address);


echo '<img class="taggedlink" src="http://www.google.com/s2/favicons?domain='. $base_url['host'] .'" width="16" height="16" />&nbsp;&nbsp;<a style="font-size:11px;" target="_blank" href="'. $address .'"'. $rel .'  >'. filter($row['bTitle']) .'</a>'; 

if($access == " private" ){
	echo '<br><span class="icustom pull-left"><i class="icon-lock"></i></span>';
}
?>

       

<?php


echo '</div>';

echo '</div><!-- span3 end-->';

    }

	echo '</div>'; // row-fluid

    // PAGINATION
    
    // Ordering
    $sortOrder = '';
    if (isset($_GET['sort'])) {
        $sortOrder = 'sort='. $_GET['sort'];
    }
    
    $sortAmp = (($sortOrder) ? '&amp;'. $sortOrder : '');
    $sortQue = (($sortOrder) ? '?'. $sortOrder : '');
    
    // Previous
    $perpage = getPerPageCount();
    if (!$page || $page < 2) {
        $page = 1;
        $start = 0;
        $bfirst = '<span class="disable">'. T_('First') .'</span>';
        $bprev = '<span class="disable">'. T_('Previous') .'</span>';
    } else {
        $prev = $page - 1;
        $prev = 'page='. $prev;
        $start = ($page - 1) * $perpage;
        $bfirst= '<a href="'. sprintf($nav_url, $user, $currenttag, '') . $sortQue .'">'. T_('First') .'</a>';
        $bprev = '<a href="'. sprintf($nav_url, $user, $currenttag, '?') . $prev . $sortAmp .'">'. T_('Previous') .'</a>';
    }
    
    // Next
    $next = $page + 1;
    $totalpages = ceil($total / $perpage);
    if (count($bookmarks) < $perpage || $perpage * $page == $total) {
        $bnext = '<span class="disable">'. T_('Next') .'</span>';
        $blast = '<span class="disable">'. T_('Last') .'</span>';
    } else {
        $bnext = '<a href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $next . $sortAmp .'">'. T_('Next') .'</a>';
        $blast = '<a href="'. sprintf($nav_url, $user, $currenttag, '?page=') . $totalpages . $sortAmp .'">'. T_('Last') .'</a>';
    }

	if (count($bookmarks) < $perpage || $perpage * $page == $total) {
		echo '<div class="">';
		echo '<div class="pagination pagination-small" >
			  <span class="label">'.'Page '.$page.' of '.$totalpages.'</span>
			</div>';
		//echo '<p class="paging">'. $bfirst .'<span> / </span>'. $bprev .'<span> / </span>'. $bnext .'<span> / </span>'. $blast .'<span> / </span>'. sprintf(T_('Page %d of %d'), $page, $totalpages) .'</p>';
		echo '</div>';
		echo '</div>';

	}else{
		echo '<div class="">';
		echo '<div class="pagination pagination-small">
				<ul>
					<li>'. $bfirst .'</li>
					<li>'. $bprev .'</li>
					<li>'. $bnext .'</li>
					<li>'. $blast .'</li>
					
				  </ul>
				  <br><span class="label">'.'Page '.$page.' of '.$totalpages.'</span>
			</div>';
		//echo '<p class="paging">'. $bfirst .'<span> / </span>'. $bprev .'<span> / </span>'. $bnext .'<span> / </span>'. $blast .'<span> / </span>'. sprintf(T_('Page %d of %d'), $page, $totalpages) .'</p>';
		echo '</div>';
		echo '</div>';
		
	}
	// PAGINATION END

	
}

} else {
	
	$tplVars['formaction']  = createURL('login');
	$this->includeTemplate('home-no-login.tpl'); 

}
		
			 //if (count($bookmarks) > 0) { 
				if ($userservice->isLoggedOn() && (count($bookmarks) > 0)) {
			?>

			<!-- <div class="span2 pull-left block"> -->
			<?php
			//$this->includeTemplate('sidebar.tpl');
			?>

			<!-- </div> -->

			<?php } ?>

		</div>	<!-- 3 row-fluid END -->
	</div> <!-- 2 container-fluid END -->
</div> <!-- 1 MAIN END -->

<?php
$this->includeTemplate($GLOBALS['bottom_include']);

?>