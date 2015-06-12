<?php
$tagservice =& ServiceFactory::getServiceInstance('TagService');
$userservice =& ServiceFactory::getServiceInstance('UserService');

$logged_on_userid = $userservice->getCurrentUserId();
if ($logged_on_userid === false) {
    $logged_on_userid = NULL;
}

$_SESSION['currenttag']=$currenttag;

$cUser = $userservice->getCurrentUser();
$cUsername = $cUser[$userservice->getFieldName('username')];

$popularTags        =& $tagservice->getPopularTags($logged_on_userid, 100, $logged_on_userid);
$popularTagsCloud   =& $tagservice->tagCloud($userPopularTags, 5, 90, 175); 
$popularTagsCount   = count($userPopularTags);

$_SESSION['totaltags']=$popularTagsCount;

if ($popularTags && count($popularTags) > 0) {
?>
<B class="text-sinfo">PERSONAL TAGS</B><br>

<div id="scrollbox4">
    

        <ul class="nav nav-list bs-docs-sidenav">
        
		<?php

			$contents = '';
			foreach ($popularTags as $row) {
				$entries = T_ngettext('bookmark', 'bookmarks', $row['bCount']);
				//echo $row['tag'];
				$selected="";
				
				if ($row['tag'] == $_SESSION['currenttag'])
				{
					$selected="active";
				}
				$contents .= '<li class="'.$selected.'"><a href="'. sprintf($cat_url, $user, filter($row['tag'], 'url')) .'" title="'. $row['bCount'] .' '. $entries .'" rel="tag" ><span class="name">'. filter($row['tag']) .'</span><span class="d"></span><span class="count">'.$row['bCount'].'</span></a></li>';
			}
			unset($_SESSION['currenttag']);
			echo $contents ;
        ?>
</ul>

</div>


<?php
}else{
	echo '<B class="text-sinfo">PERSONAL TAGS</B><br>';
	echo '<div id="scrollbox4">';
	echo '<p class="text-sinfo">no tags created so far</p>';
	echo '</div>';
}
?>