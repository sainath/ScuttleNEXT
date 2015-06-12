<?php
require_once 'header.inc.php';

$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars = array();

$templatename = 'bookmarklet.tpl';
$tplVars['subtitle']   = T_('Tools');
//$tplVars['formaction'] = createURL('import');

$templateservice->loadTemplate($templatename, $tplVars);

?>
