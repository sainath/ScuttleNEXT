<?php
header('HTTP/1.x 500 Server error');
$this->includeTemplate($GLOBALS['top_include']);
if (!$error) {
    echo '<h1>'. T_('General server error') .'</h1>';
    echo '<p>'. T_('The requested URL could not be processed') .'</p>';
}
?>
<div class="container minheight">

      print error in this container

 </div>

<?php $this->includeTemplate($GLOBALS['bottom_include']); ?>