<?php
header('HTTP/1.x 404 Not Found');
$this->includeTemplate($GLOBALS['top_include']);
?>

<div id="bookmarks" class="container minheight">
<div class="row">
		<?php
			if($_SESSION["messages"] != ""){
				$custom_message=trim($_SESSION["messages"]);
				echo '<div class="alert alert-error">'.$custom_message.'</div>';
			}
			$_SESSION["messages"] = "";	
		?>
<?php
if (!$error) {
    echo '<h1>'. T_('Not Found') .'</h1>';
    echo '<p>'. T_('The requested URL was not found on this server') .'</p>';
}
?>
</div>
</div>

<?php
$this->includeTemplate($GLOBALS['bottom_include']);
?>