<?php
$this->includeTemplate($GLOBALS['top_include']);

if ($tags && count($tags) > 0) {
?>

<div class="container minheight"> <!-- 1 MAIN container START -->
	<div class="container-fluid"> <!-- 2 container-fluid START -->
		<div class="row-fluid">	<!-- 3 row-fluid START -->

		<div class="span3 block pull-right"><h6><U>What are Tags?</U></h6>Tag your bookmarks with as many labels as you want, so that it makes your life easy to retrive the exact information you were looking for.<br></div>

		<div class="span9 block pull-left">			
	 

			<div class="tagcloud form-tags">
			<?php
			$contents = '';
			foreach ($tags as $row) {
				$entries = T_ngettext('bookmark', 'bookmarks', $row['bCount']);
				$contents .= '<a class="tag" href="'. sprintf($cat_url, $user, filter($row['tag'], 'url')) .'" title="'. $row['bCount'] .' '. $entries .'" rel="tag" style="padding:6px;font-size:'. $row['size'] .'">'. filter($row['tag']) .'</a> ';
			}
			echo $contents ."\n";
			?>
			</div>

			
		</div>

		</div>	<!-- 3 row-fluid END -->
	</div> <!-- 2 container-fluid END -->
</div> <!-- 1 MAIN END -->


<?php
}else{
	
	$this->includeTemplate('home-first-time-login-no-tags.tpl');

}


$this->includeTemplate($GLOBALS['bottom_include']);
?>