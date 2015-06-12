<?php $this->includeTemplate($GLOBALS['top_include']);
?> 
 
<div class="container minheight">
<br><br><br>
	<!-- <div class="span8 pull-left"> -->
		<form id="register" class="form-edit gray" action="<?php echo $formaction; ?>" method="post" >
		<?php
			if (isset($error)) {
				echo '<div class="alert alert-error">'.$error.'</div>';
			}
		?>
		<!-- <h4 class="form-signin-heading text-sinfo"><?php echo T_('Sign up'); ?></h4> -->		
		<h4 class="form-signin-heading muted">To join <?php echo $GLOBALS['sitename']; ?>, sign up below... it's free!<!--  Sign up here to create a free  account. All the information is required --></h4><hr style="margin: 10px 0;">
		<input type="text" id="username" name="username" size="30" maxlength="30" class="required" value="<?php echo htmlentities($_POST['username']); ?>"/>&nbsp;&nbsp;* Username&nbsp;&nbsp;<span id="availability"></span><br>

		<input type="password" id="password" name="password" size="40" maxlength="40" class="required"/>&nbsp;&nbsp;* Password<br>
		
		<input type="password" id="passconf" name="passconf" size="40" maxlength="40" />&nbsp;&nbsp;* Confirm Password<br>		
		
		<input type="text" id="email" name="email" size="50" maxlength="50" value="<?php echo htmlentities($_POST['email']); ?>"/>&nbsp;&nbsp;* E-mail<br>		

		* Required<br><br>

		<input type="hidden" name="token" value="<?php echo $token; ?>" />

<!-- <a class="btn btn-large btn-success" href="<?php echo createURL('register'); ?>">Sign up for a free account</a> -->
<i class="icon-share-alt icon-white"></i>
		<input type="submit" name="submitted" value="Sign up for a free account" class="btn btn-large btn-success"/>

		</form>

<!-- </div> -->

 </div>

<?php $this->includeTemplate($GLOBALS['bottom_include']); ?>


<script type="text/javascript">
$(function() {

  $("#username").focus()
                .keydown(function() {
					if ($("#username").val().length<4)
					{	
						$("#availability").removeClass()
                                            .addClass("not-available")
                                            .html("Minimum is 5 characters");
						return;
					}
                  clearTimeout(self.searching);
				  self.searching = setTimeout(function() {
                    $.get("<?php echo $GLOBALS['root']; ?>ajaxIsAvailable.php?username=" + $("#username").val(), function(data) {
                        if (data) {
                          $("#availability").removeClass()
                                            .html("<?php echo T_('Username is available'); ?>");
                        } else {
                          $("#availability").removeClass()
                                            .addClass("not-available")
                                            .html("<?php echo T_('Username is not Available'); ?>");
                        }
                      }
                    );
                  }, 300);
                });
				
});
</script>
