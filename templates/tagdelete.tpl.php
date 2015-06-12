<?php
$this->includeTemplate($GLOBALS['top_include']);
?>

<div class="container minheight">
      <form class="form-signin" action="<?php echo $formaction; ?>" method="post" >
        <h4 class="form-signin-heading"><?php echo T_('Are you sure you want to '.$subtitle.'?'); ?></h4>
		<div style="text-align: center;">
			<input type="submit" name="confirm" value="<?php echo T_('Yes'); ?>" class="btn btn-primary">
			<input type="submit" name="cancel" value="<?php echo T_('No'); ?>" class="btn btn-primary">
		</div>
		<?php if (isset($referrer)): ?>
		<input type="hidden" name="referrer" value="<?php echo $referrer; ?>" />
		<?php endif; ?>

      </form>
 </div>

<?php
$this->includeTemplate($GLOBALS['bottom_include']); 
?>