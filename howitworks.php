<?php
require_once 'header.inc.php';

$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars = array();

$templatename = 'howitworks.tpl';
$tplVars['subtitle']   = T_('How it works');
$templateservice->loadTemplate($templatename, $tplVars);
