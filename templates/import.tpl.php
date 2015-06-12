<?php $this->includeTemplate($GLOBALS['top_include']); ?>
<br><br><br><br>
<div id="bookmarks" class="container minheight">
	<div class="span6 pull-left">
		<form id="import" enctype="multipart/form-data" action="<?php echo $formaction; ?>" method="post">
		<h4 class="form-signin-heading"><?php echo T_('Import Bookmarks from Browser'); ?></h4>		
		<input type="file" name="userfile" size="50" /><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
		<input type="hidden" name="status" value="2" />            

		<input type="submit" name="submitted" value="<?php echo T_('Import'); ?>" class="btn btn-primary"/>
		</form>
	</div>
	<div class="span5 pull-right">
		<h4><?php echo T_('Instructions'); ?></h4>
		<ol>
			<li>
				<p><?php echo T_('Export your bookmarks from your browser to a file'); ?>:</p>
				<ul>
					<li><?php echo T_('Internet Explorer: <kbd>File &rarr; Import and Export&hellip; &rarr; Export Favorites</kbd>'); ?></li>
					<li><?php echo T_('Mozilla Firefox: <kbd>Bookmarks &rarr; Manage Bookmarks&hellip; &rarr; File &rarr; Export&hellip;</kbd>'); ?></li>
					<li><?php echo T_('Google Chrome: <kbd>Bookmark Manager &rarr; Organize &rarr; Export Bookmarks&hellip;</kbd>'); ?></li>
				</ul>
			</li>
			<li><?php echo T_('Click <kbd>Browse&hellip;</kbd> to find the saved bookmark file on your computer. The maximum size the file can be is 1MB.'); ?></li>
			<!-- <li><?php echo T_('Select the default privacy setting for your imported bookmarks.'); ?></li> -->
			<li><?php echo T_('Click <kbd>Import</kbd> to start importing the bookmarks; it may take some time.'); ?></li>
		</ol>
	</div>

 </div>

<?php $this->includeTemplate($GLOBALS['bottom_include']); ?>