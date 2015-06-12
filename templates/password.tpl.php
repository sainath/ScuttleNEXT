<?php
$this->includeTemplate($GLOBALS['top_include']);
?>
<br><br><br><br>
<div class="container minheight">
	<form class="form-forgotpassword" action="<?php echo $formaction; ?>" method="post" >
	
	<?php
		if (isset($error)) {
			echo '<div class="alert alert-error">'.$error.'</div>';
		}
		if (isset($msg)) {
			echo '<div class="alert alert-success">'.$msg.'</div>';
		}
		
	?>

	<div class="span4 pull-left">
		<h4 class="form-signin-heading muted">Forgot username or password!</h4>	

		<input placeholder="E-mail" type="text" id="email" name="email" size="50" maxlength="50"  class="required" />&nbsp;&nbsp;<?php echo T_('E-mail'); ?><br>
		<button type="submit" name="submitted"  value="Submit" class="btn btn-warning"><i class="icon-chevron-right icon-white"></i>&nbsp;Submit</button>
	</div>

	<div class="muted">
		<span>To recover your ScuttleNEXT username or password, please enter your e-mail address.<br> We will send you the details.</span><hr>
	</div>
	
	</form>
</div>

<?php
$this->includeTemplate($GLOBALS['bottom_include']);
?>