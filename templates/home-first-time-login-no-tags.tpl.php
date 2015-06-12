<div class="container-narrow minheight">
	<div class="jumbotron">
	<br>
			<h3>You don't have any tags</h3>
			<p class="lead">Tags are small keywords which are handy and short which helps you categorize and easily find your favorite bookmarks again.</p>
			<?php $addurl =createURL('bookmarks', $currentUsername .'?action=add');   ?>
			<a class="btn btn-large btn-success" href="<?php echo $addurl ?>"><?php echo T_('Add Bookmark'); ?></a>
	</div>

</div>