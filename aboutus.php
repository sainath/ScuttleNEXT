<?php

require_once 'header.inc.php';
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars             = array();
$tplVars['subtitle'] = T_('About us');
$templateservice->loadTemplate('about.tpl', $tplVars);
