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
			if($_SESSION["messages"] != ""){
				$custom_message=trim($_SESSION["messages"]);
				echo '<div class="alert alert-success">'.$custom_message.'</div>';
			}
			$_SESSION["messages"] = "";	
		?>
<?php
//if (count($bookmarks) > 0) {
if ($userservice->isLoggedOn() && (count($bookmarks) > 0)) {
?>

<div class="span2 block pull-right"><?php if ($PAGE != "bookmarklet") { ?>
	<!-- <span class="text-sinfo">Add bookmark with a single click.<br>
	
	</span> -->
	<div class="blog-feedback">
        <!-- <h6>Add bookmark with a single click.</h6>  -->
		<!-- <p class="blackcolor"> -->
		
		<a class="btn btn-primary" href="<?php echo createURL('bookmarklet'); ?>"><?php echo T_('Add bookmark with a single click.'); ?></a>
		
		<!-- </p> -->
		<!-- <center><p> <a class="btn btn-primary" href="<?php echo createURL('bookmarklet'); ?>"><?php echo T_('know more'); ?></a><br></p></center> -->
	</div>
	<br>

	<?php 
	$this->includeTemplate('sidebar.block.recommended.php');	
	
	} ?>


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
	$this->includeTemplate('home-first-time-login-no-starred.tpl');
}

if (count($bookmarks) > 0) {

	echo '<div class="span8 block pull-right">';
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

$show_details = '<a class="btn btn-mini btn-primary" style="font-size:10.5px;" href="'. createURL('viewdetails', $row['bId']) .'" >'. T_('details') .'</a>'; 
//echo '<div class="hover-toggle btn-group"><button class="btn btn-mini">i</button></div>';

echo '<span class="img-container"><img src="'.$GLOBALS['root'].'img/getthumbnail.jpg" width="172" height="129" style="border:1px solid #f6f6f6;"/>              <div class="hover-toggle btn-group">
                  '.$show_details.'                  
               </div></span><br>';

echo '<img src="'.$GLOBALS['root'].'img/favicons.png" width="16" height="16" />&nbsp;&nbsp;<a style="font-size:11px;" target="_blank" href="'. $address .'"'. $rel .' class="taggedlink" >'. filter($row['bTitle']) .'</a>'; //.$show_details;

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
	echo '<div class="span11">';
	echo '<div class="pagination pagination-small">
			<ul>
                <li>'. $bfirst .'</li>
                <li>'. $bprev .'</li>
                <li>'. $bnext .'</li>
                <li>'. $blast .'</li>
                
              </ul>
			  <br><span class="label">'.'Page '.$page.' of '.$totalpages.'</span>
		</div>';

	echo '</div></div>';
}

} else {
	
	$tplVars['formaction']  = createURL('login');
	$this->includeTemplate('home-no-login.tpl'); 

}
		
			 //if (count($bookmarks) > 0) { 
				if ($userservice->isLoggedOn() && (count($bookmarks) > 0)) {
			?>

			<div class="span2 pull-left block">
			<?php
			$this->includeTemplate('sidebar.tpl');
			?>
			</div>

			<?php } ?>

		</div>	<!-- 3 row-fluid END -->
	</div> <!-- 2 container-fluid END -->
</div> <!-- 1 MAIN END -->

<?php
$this->includeTemplate($GLOBALS['bottom_include']);
?>