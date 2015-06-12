<?php
$this->includeTemplate($GLOBALS['top_include']);

$userservice =& ServiceFactory::getServiceInstance('UserService');
if ($userservice->isLoggedOn()) {
    $cUser = $userservice->getCurrentUser();
    $cUsername = $cUser[$userservice->getFieldName('username')];
}

$accessPublic = '';
//$accessShared = '';
$accessPrivate = '';

//$row['bStatus'] = 2;
//p($row);
switch ($row['bStatus']) {
    case 0 :
        $accessPublic = ' selected="selected"';
        break;
    //case 1 :
     //   $accessShared = ' selected="selected"';
      //  break;
    case 2 :
        $accessPrivate = ' selected="selected"';
        break;
}

if ($showdelete)
	$heading='Edit Bookmark';
else
	$heading='Add Bookmark';
?>


<div class="container minheight">
 	<div class="span8  pull-left"> 
		<form class="form-edit" action="<?php echo $formaction; ?>" method="post" >
			 	<?php
	if (isset($error)) {
	  echo '<div class="alert alert-error">'.$error.'</div>';
	}
	?>
		<?php
			if($_SESSION["messages"] != ""){
				$custom_message=trim($_SESSION["messages"]);
				echo '<div class="alert alert-success">'.$custom_message.'</div>';
			}
			$_SESSION["messages"] = "";	
		?>		
		<h5 class="text-sinfo form-signin-heading"><?php echo $heading; ?></h5>
		
		<input style="width:335px;" type="text" id="address" name="address"  value="<?php echo filter($row['bAddress'], 'xml'); ?>" onblur="useAddress(this)" />&nbsp;&nbsp;<?php echo T_('Address *(Required)'); ?><br>	
		
		<input style="width:335px;" type="text" id="titleField" name="title" maxlength="40" value="<?php echo filter($row['bTitle'], 'xml'); ?>" onkeypress="this.style.backgroundImage = 'none';" />&nbsp;&nbsp;<?php echo T_('Title *(Required)'); ?><br>

		<textarea data-content="Tag your bookmarks with as many labels as you want, so that it makes it easy to search/retrive the exact information you were looking for." data-placement="right" data-trigger="focus"  data-original-title="What are Tags?" style="width:335px;" type="text" id="tags" name="tags" size="75"  ><?php echo filter(implode(', ', $row['tags']), 'xml'); ?></textarea>&nbsp;&nbsp;<?php echo T_('Tags Comma-separated'); ?><br>
			
		<textarea data-content="Notes are used to explain about your bookmark, and may help you remind something important about the bookmark" data-placement="right" data-trigger="focus"  data-original-title="Notes" style="width:335px;" type="text" id="descriptionField" name="description" maxlength="255" ><?php echo filter($row['bDescription'], 'xml'); ?></textarea>&nbsp;&nbsp;Notes<br>

		<select name="status">
            <option value="0"<?php echo $accessPublic ?>><?php echo T_('Public'); ?></option>
            <!-- <option value="1"<?php echo $accessShared ?>><?php echo T_('Shared with Watch List'); ?></option> -->
            <option value="2"<?php echo $accessPrivate ?>><?php echo T_('Private'); ?></option>
        </select>
<br>
		<?php
				
		
		?>
		<?php //echo T_('Privacy: all your bookmarks will be private.'); ?>

		<div style="text-align: center;">
			<!-- <input type="hidden" name="status" value="2" /> -->
			<input type="submit" name="submitted" value="<?php echo $btnsubmit; ?>" class="btn btn-warning"/>
				<?php if ($showdelete): ?>
				  <input type="submit" name="delete" value="<?php echo T_('Delete Bookmark'); ?> " class="btn btn-danger"/>
				<?php endif; ?>
				<?php if ($popup): ?>
				  <input type="hidden" name="popup" value="1" />
				<?php elseif ($referrer): ?>
				  <input type="hidden" name="referrer" value="<?php echo $referrer; ?>" />
				<?php endif; ?>
		</div>
		<?php if (isset($referrer)): ?>
		<input type="hidden" name="referrer" value="<?php echo $referrer; ?>" />
		<?php endif; ?>
		<!-- <hr> -->
		
	 </div> 

		<script type="text/javascript">
		$(function() {
		  $("#address").focus();
		});
		</script>
		<div class="span4 block pull-right">
		<?php
		// Dynamic tag selection
		$this->includeTemplate('dynamictags.inc');
		?>
		</div>

		</form>

 </div>
<?php
}
$this->includeTemplate($GLOBALS['bottom_include']); 
?>