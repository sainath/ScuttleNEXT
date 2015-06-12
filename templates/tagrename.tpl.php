<?php
$this->includeTemplate($GLOBALS['top_include']);
?>
<script type="text/javascript">
window.onload = function() {
    document.getElementById("new").focus();
}
</script>

<div class="container minheight">
      <form class="form-signin" action="<?php echo $formaction; ?>" method="post" >
        <h3 class="form-signin-heading">Rename Tag</h3>

        <?php echo T_('Old:'); ?>&nbsp;&nbsp;&nbsp;<input type="text" disabled id="old1" name="old1" value="<?php echo $old; ?>">
		<input type="hidden" name="old" id="old" value="<?php echo $old; ?>" />
<br>
        New:&nbsp;<input id="new" name="new" type="text" placeholder="<?php echo T_('new tag'); ?>"><?php //echo T_('Required'); ?>
		<div style="text-align: center;">
			<input type="submit" name="confirm" value="<?php echo T_('Rename'); ?>" class="btn btn-primary">
			<input type="submit" name="cancel" value="<?php echo T_('Cancel'); ?>" class="btn btn-primary">
		</div>
		<?php if (isset($referrer)): ?>
		<input type="hidden" name="referrer" value="<?php echo $referrer; ?>" />
		<?php endif; ?>

      </form>
 </div>

<?php
$this->includeTemplate($GLOBALS['bottom_include']); 
?>
 	  	 
