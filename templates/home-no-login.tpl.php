
<div class="container"><br><br><br>
<div class="jumbotron">
        <h2 style="color:#888888;">Access your favorite bookmarks from anywhere!!</h2><!-- <p class="lead1" >very simple and easy to use</p> -->
</div><hr>
<div class="row-fluid marketing">
        <div class="span6">
			<img width="489" height="245" alt="Access your favorite bookmarks from anywhere!!" src="<?php echo $GLOBALS['root']; ?>/img/access-anywhere.png">
 			<p class="lead">ScuttleNEXT will allow you to save your favorite web links online and access them from any computer, wherever you are.</p> 

			<ul class="muted1">
				<li>Your bookmarks will be <abbr title="attribute">always handy</abbr>, whereever you are</li>
				<li><abbr title="attribute">Discover new websites</abbr>. This depends on what bookmarks/tags you save</li>
				<!-- <li><abbr title="attribute">Easily import</abbr> your exisiting browser bookmarks into this application</li> -->
				<li>With a <abbr title="attribute">single click</abbr> you can add your favorite bookmark to this service</li>
<!-- 				<li>Store all your favourite links in one place, accessible from anywhere</li> -->
<li><abbr title="attribute">Tag</abbr> your bookmarks with as many labels as you want, so that it makes your <abbr title="attribute">life easy</abbr> to retrive the exact information you were looking for.</li>
		    </ul>
<!-- 			<p style="text-align:center;"><a class="btn btn-large btn-success" href="<?php echo createURL('register'); ?>"><?php echo T_('Sign up for a free account'); ?></a></p> -->
		 </div>

	<div class="span6">  
<!-- 		<div class="container minheight"> 
		<br><br><br><br>-->
			  <form class="form-signin-small" action="<?php echo createURL('login'); ?>" method="post">
			  <input type="hidden" name="query" value="<?php echo filter($_SERVER['QUERY_STRING']); ?>" />
				<b class="lead muted" style="padding-bottom:15px;">Sign in</b>

				<input type="text" placeholder="<?php echo T_('Username'); ?>" class="input-block-level" id="username" name="username" value="<?php echo htmlentities($_POST['username']); ?>">

				<input id="password" name="password" type="password" placeholder="<?php echo T_('Password'); ?>" class="input-block-level">

				<!-- <label class="checkbox"> -->
				  <input type="hidden" name="keeppass" value="yes" />
				<!-- </label> -->
				<button type="submit" name="submitted" class="btn btn-warning"><i class="icon-user icon-white"></i>&nbsp;Sign in</button><br><a href="<?php echo $GLOBALS['root'] ?>password.php"><?php echo T_('Forgot your username or password?') ?></a>
			  </form>			  
<!-- 
		 </div> -->
		<script type="text/javascript">
		$(function() {
		  $("#username").focus();
		});
		</script>

		<CENTER>
			<h4 style="color: #aaa;font-family: Calibri;margin-top:30px;">Don't have an acount?</h4>
			<br>
			<a class="btn btn-large btn-success" href="<?php echo createURL('register'); ?>"><?php echo T_('Sign up for a free account'); ?></a>
		</CENTER>

		<span id="features">&nbsp;</span>

	</div>	

</div>

</div>

</div> <!-- container end -->
