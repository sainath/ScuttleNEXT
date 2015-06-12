<?php
require_once 'header.inc.php';

$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars = array();

$templatename = 'features.tpl';
$tplVars['subtitle']   = T_('Features');
//$tplVars['formaction'] = createURL('import');
$templateservice->loadTemplate($templatename, $tplVars);

?>
