<?php
$this->includeTemplate($GLOBALS['top_include']);

$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
}

$heading='View Details';

?>
<div class="minheight">
<div class="container form-view-details ">

	
		<?php
			if($_SESSION["messages"] != ""){
				$custom_message=trim($_SESSION["messages"]);
				echo '<div class="alert alert-success">'.$custom_message.'</div>';
			}
			$_SESSION["messages"] = "";	
		?>
		<TABLE class="span8 ">
		<TR>
		<TD class="tdminwidth"><?php
			//THUMBNAIL CODE 
			echo '<img src="http://img.bitpixels.com/getthumbnail?code=53738&size=200&url='.$address.'" width="172" height="129"/><br>';
			//echo '<p class="pull-right"><img src="'.$GLOBALS['root'].'img/getthumbnail.jpg" width="172" height="129"/></p>';
			?></TD>
		<TD class="tdminwidth">&nbsp;</TD>
		</TR>
		<TR>
			<TD class="tdminwidth">				
				<p class="font13px"><i class="icon-pencil"></i>
				<?php echo T_('Title'); ?>&nbsp;
				</p>		
			</TD>
			<TD class="tdminwidth">
			<p class="font13px">
			<?php 
				if ($row['bStarred'] == '1'){
					echo '<IMG SRC="'.$GLOBALS['root'].'/img/rating3.gif" WIDTH="13" HEIGHT="12" BORDER="0" ALT="">';
				}
				?>
			<?php echo filter($row['bTitle'], 'xml'); ?>
				<?php 
				echo '&nbsp;&nbsp;<a style="font-size: 11.5px;"href="'. createURL('edit', $row['bId']) .'"><i class="icon-pencil"></i>&nbsp;'. T_('edit') .'</a><script type="text/javascript">document.write("&nbsp;&nbsp;&nbsp;&nbsp;<a style=\"font-size: 11.5px;\" href=\"#\" onclick=\"deleteBookmark(this, '. $row['bId'] .');  return false;\"><i class=\"icon-trash\"></i>&nbsp;'. T_('delete') .'<\/a>");</script>';
				?>
				</p><br>
			</TD>
		</TR>
		<TR>
			<TD><p class="font13px"><i class="icon-bookmark"></i>
		<?php echo T_('Bookmark'); ?></p></TD>
			<TD><p class="font13px"><?php echo '<a style="font-size:12px;" target="_blank" href="'. filter($row['bAddress']) .'"'. $rel .' class="taggedlink" >'. filter($row['bAddress']) .'</a>'; ?></p></TD>
		</TR>
		<TR>
			<TD><p class="font13px">
		<?php echo T_('<i class="icon-tags"></i>&nbsp;Tags'); ?></p></TD>
			<TD><p class="font13px"><?php 
			
			//echo filter(implode(', ', $row['tags']), 'xml'); 
			$cats = '';
			$cat_url = createURL('bookmarks', '%s/%s');
			foreach ($row['tags'] as $tag) {
				//$tag =& $tags[$key];
				$cats .= '<a class="post-tag" href="'. sprintf($cat_url, filter($user, 'url'), filter($tag, 'url')) .'" rel="tag">'. filter($tag) .'</a> ';
			}
			$cats = substr($cats, 0, -2);
			//if ($cats != '') {
			//	$cats = ' tags - '. $cats;
			//}
			echo $cats;

			?></p></TD>
		</TR>
		<?php
		
		?>

		</TABLE>
	
	</div>

 </div>
<?php

$this->includeTemplate($GLOBALS['bottom_include']); 
?>