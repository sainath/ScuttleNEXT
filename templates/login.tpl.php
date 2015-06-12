<?php $this->includeTemplate($GLOBALS['top_include']); ?>

<br><br><br><br>
<div class="container minheight">

      <form class="form-signin" action="<?php echo $formaction; ?>" method="post">
	 	<?php
	if (isset($error)) {
	  echo '<div class="alert alert-error">'.$error.'</div>';
	}
	?>
	  <input type="hidden" name="query" value="<?php echo $querystring; ?>" />
        <h4 class="form-signin-heading muted">Sign in</h4>

        <input type="text" placeholder="<?php echo T_('Username'); ?>" size="30" maxlength="30" class="input-block-level" id="username" name="username" value="<?php echo htmlentities($_POST['username']); ?>">

		&nbsp;<span class="muted">Password</span>
        <input id="password" name="password" type="password" size="40" maxlength="40" placeholder="password" class="input-block-level">
		<input type="hidden" name="keeppass" value="yes" />
		
        <button type="submit" name="submitted"  value="Submit" class="btn btn-warning"><i class="icon-user icon-white"></i>&nbsp;Sign in</button>&nbsp;&nbsp;&nbsp;<a href="<?php echo $GLOBALS['root'] ?>password.php">Forgot your username or password?</a>
      </form>
		<CENTER class="muted">
			<h4 style="font-family: Calibri;margin-top:20px;">Don't have an acount?</h4>

			<a class="btn btn-large btn-success" href="<?php echo createURL('register'); ?>">Sign up for a free account</a>
		</CENTER>
	<div class="span6"> 

	</div>
 </div>
 


<script type="text/javascript">
$(function() {
  $("#username").focus();
});
</script>

<?php $this->includeTemplate($GLOBALS['bottom_include']); ?>
