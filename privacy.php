<?php

require_once 'header.inc.php';
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars             = array();
$tplVars['subtitle'] = T_('Privacy');
$templateservice->loadTemplate('privacy.tpl', $tplVars);
