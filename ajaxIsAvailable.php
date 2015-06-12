<?php

header('Content-Type: text/plain; charset=UTF-8');
header('Last-Modified: '. gmdate("D, d M Y H:i:s") .' GMT');
header('Cache-Control: no-cache, must-revalidate');
require_once 'header.inc.php';

$userservice =& ServiceFactory::getServiceInstance('UserService');
echo !($userservice->isReserved($_GET['username']) || $userservice->getUserByUsername($_GET['username']));
