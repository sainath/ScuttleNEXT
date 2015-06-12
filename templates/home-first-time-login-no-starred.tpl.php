<div class="container-narrow minheight">
	<div class="jumbotron">
	<br>
			<h3>You have not marked any bookmark as starred.</h3>
			<p class="lead">If any of the bookmark is important and used frequently then you can put them in starred so that it can be retrieved easily</p>
			<?php $addurl =createURL('bookmarks', $currentUsername .'?action=add');   ?>
			<a class="btn btn-large btn-success" href="<?php echo $addurl ?>"><?php echo T_('Add Bookmark'); ?></a>
	</div>

</div>