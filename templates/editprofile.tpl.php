<?php
$this->includeTemplate($GLOBALS['top_include']);
?>

<div class="container minheight">
	<div class="span8 pull-left">
		<form class="form-edit" action="<?php echo $formaction; ?>" method="post" >
		<h4 class="form-signin-heading"><?php echo T_('Account Details'); ?></h4>		
		<input type="text" disabled value="<?php echo $user; ?>" onblur="useAddress(this)" />&nbsp;&nbsp;<?php echo T_('Username'); ?><br>	
		<input type="password" id="pPass" name="pPass" size="20" maxlength="20" />&nbsp;&nbsp;<?php echo T_('New Password'); ?><br>
		<input type="password" id="pPassConf" name="pPassConf" size="20" maxlength="20" />&nbsp;&nbsp;<?php echo T_('Confirm Password'); ?><br>		
		<input type="text" id="pMail" name="pMail" size="75" value="<?php echo filter($row['email'], 'xml'); ?>" />&nbsp;&nbsp;<?php echo T_('E-mail *( Required )'); ?><br>
		
		<h4 class="form-signin-heading"><?php echo T_('Personal Details'); ?></h4>
		<input type="text" id="pName" name="pName" size="75" value="<?php echo filter($row['name'], 'xml'); ?>" />&nbsp;&nbsp;<?php echo T_('Name'); ?><br>
		<input type="text" id="pPage" name="pPage" size="75" value="<?php echo filter($row['homepage'], 'xml'); ?>" />&nbsp;&nbsp;<?php echo T_('Homepage'); ?><br>
		<!-- <textarea name="pDesc" cols="75" rows="10"><?php echo $row['uContent']; ?></textarea>&nbsp;&nbsp;<?php echo T_('Description'); ?><br> -->

		<input type="submit" name="submitted" value="<?php echo T_('Save Changes'); ?>" class="btn btn-primary"/>
		<input type="submit" name="cancel" value="<?php echo T_('Cancel'); ?>" class="btn btn-primary">
		</form>
	</div>
	<div class="span4 block pull-right font13px"><h5><U>Help</U></h5>
		<b>Here you can update your Password and Email address</b><br><br>
		<UL>
			<LI>Password must be at least 6 characters long.
			<LI>Password and confirmation should match.
			<LI>A valid E-mail address is required.
			<LI>Personal Details like Name and Home page can be updated.
		</UL>
	</div>

 </div>

<?php
$this->includeTemplate($GLOBALS['bottom_include']);
?>