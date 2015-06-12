<?php

require_once 'header.inc.php';
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars             = array();
$tplVars['subtitle'] = T_('Help');
$templateservice->loadTemplate('help.tpl', $tplVars);
