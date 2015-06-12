<?php
$this->includeTemplate($GLOBALS['top_include']);

$userservice =& ServiceFactory::getServiceInstance('UserService');


if (!$userservice->isLoggedOn()) {
	echo '<br><br><br>';
}
?>

<div class="container-narrow minheight"> <!-- 1 MAIN container START -->
	<div class="container-fluid"> <!-- 2 container-fluid START -->
		<div class="row-fluid">	<!-- 3 row-fluid START -->

				

			<div class="jumbotron">
			Drag me to your Bookmarks Bar to quickly share any web page with your friends, even when you're not on Facebook.

If you can't see the Bookmarks Bar, Choose "Show Bookmarks Bar" from the View menu.

				 <h2 class="text-sinfo">Bookmarklet makes it easy for you to save any web page with a single click</h2>

			<br><span class="font16px text-sinfo">Drag the following button to your browser's bookmarks toolbar(enable it from Browser menu View > Toolbars ) and click it whenever you want to add the page you are on.</span><br><br>


			<script type="text/javascript">
			var selection = '';
			if (window.getSelection) {
				selection = 'window.getSelection()';
			} else if (document.getSelection) {
				selection = 'document.getSelection()';
			} else if (document.selection) {
				selection = 'document.selection.createRange().text';
			}
			
			document.write('<a class="btn btn-info btn-large" href="javascript:x=document;a=encodeURIComponent(x.location.href);t=encodeURIComponent(x.title);d=encodeURIComponent('+selection+');open(\'<?php echo createURL('bookmarks', $GLOBALS['user']); ?>?action=add&amp;popup=1&amp;address=\'+a+\'&amp;title=\'+t+\'&amp;description=\'+d,\'<?php echo $GLOBALS['sitename']; ?>\',\'modal=1,status=0,scrollbars=1,toolbar=0,resizable=1,width=730,height=465,left=\'+(screen.width-730)/2+\',top=\'+(screen.height-425)/2);void 0;"><?php echo sprintf(T_('Post to %s (Pop-up)'), $GLOBALS['sitename']); ?><\/a>');
			
			</script>
			</div>
			<hr>
            <p class="font16px text-sinfo">Unable to install the bookmarklet, please read the below instructions.</p>
        	<ul class="default text-sinfo">
        		<li>First, make sure your browser's bookmark toolbar is visible. In Firefox, choose "Bookmarks Toolbar" in View &gt; Toolbars. You can find similar options in other browsers.</li>
        		<li>Second, drag the bookmarklet button to the right to your Bookmarks Toolbar.</li>
				<li>That's it!  Now, to save a webpage to <?php echo $GLOBALS['sitename']; ?>, just click on your bookmarklet to open the save window. Add title and tags and then save it.</li>
				<li>Save page looks like following.</li>
			</ul>
			<CENTER><img src="../img/modal1.png" style="disply:block;text-align:center;" ></CENTER>
			<hr>

		

		</div>	<!-- 3 row-fluid END -->
	</div> <!-- 2 container-fluid END -->
</div> <!-- 1 MAIN END -->


<?php

$this->includeTemplate($GLOBALS['bottom_include']);
unset($_SESSION['pagename']);
?>