<?php

require_once 'header.inc.php';
$userservice     =& ServiceFactory::getServiceInstance('UserService');
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');

$tplVars   = array();
$completed = false;

if ($userservice->isLoggedOn()) {
	$cUserId = $userservice->getCurrentUserId();
	//$cUsername = strtolower($cUser[$userservice->getFieldName('username')]);
	header('Location: '. createURL('bookmarks', $cUserId));
}

if ($_POST['submitted']) {
  if (!$completed) {  
    $posteduser = trim(utf8_strtolower($_POST['username']));
    $postedpass = trim($_POST['password']);
    $postedconf = trim($_POST['passconf']);
    $postedmail = trim($_POST['email']);

    // Check token
    if (!isset($_SESSION['token']) || $_POST['token'] != $_SESSION['token']) {
      $tplVars['error'] = T_('Form could not be authenticated. Please try again.');
    }

    // Check elapsed time
    if (!isset($_SESSION['token_time']) || time() - $_SESSION['token_time'] < 1) {
      $tplVars['error'] = T_('Form was submitted too quickly. Please wait before trying again.');
    }

    // Check if form is incomplete
    elseif (!$posteduser || !$postedpass || !$postedmail) {
      $tplVars['error'] = T_('You <em>must</em> enter a username, password and e-mail address.');
    }

    // Check if username is reserved
    elseif ($userservice->isReserved($posteduser)) {
      $tplVars['error'] = T_('This username has been reserved, please make another choice.');
    }

    // Check if username already exists
    elseif ($userservice->getUserByUsername($posteduser)) {
      $tplVars['error'] = T_('This username already exists, please make another choice.');
    }
	
	// Check if username already exists
    elseif ($userservice->getUserByEmail($postedmail)) {
      $tplVars['error'] = T_('This E-Mail is already regestered, please make another choice.');
    }
    
    // Check that password is long enough
    elseif ($postedpass != '' && strlen($postedpass) < 6) {
      $tplVars['error'] = T_('Password must be at least 6 characters long.');       
    }

    // Check if password matches confirmation
    elseif ($postedpass != $postedconf) {
      $tplVars['error'] = T_('Password and confirmation do not match.');
    }

    // Check if e-mail address is blocked
    elseif ($userservice->isBlockedEmail($postedmail)) {
      $tplVars['error'] = T_('This e-mail address is not permitted.');
    }

    // Check if e-mail address is valid
    elseif (!$userservice->isValidEmail($postedmail)) {
      $tplVars['error'] = T_('E-mail address is not valid. Please try again.');
    }

    // Register details
    elseif ($userservice->addUser($posteduser, $_POST['password'], $postedmail)) {
      // sign in with new username
      $login = $userservice->login($posteduser, $_POST['password']);
      if ($login) {
        header('Location: '. createURL('bookmarks', $posteduser));
      }
      $tplVars['msg'] = T_('Congratulations, you have successfully created your login!');
	  
	  // SEND E-MAIL
      $message = T_('Your registration was successful. <br>Your username is:') ."\n". $posteduser ."\n\n".T_('Your new password is:') ."\n". $postedpass ."\n\n". T_('To keep your credentials secure, you should change this password in your profile page the next time you sign in.');
      $message = wordwrap($message, 70);
      $headers = 'From: '. $adminemail;
      $mail = mail($postedmail, sprintf(T_('%s registration successful'), $GLOBALS['sitename']), $message, $headers);

    }
    else {
      $tplVars['error'] = T_('Registration failed. Please try again.');
    }
  }
  else {
    $tplVars['msg'] = T_('Your registration was successful. Check your e-mail for instructions on how to verify your account.');  
  }
}

// Generate anti-CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['token']      = $token;
$_SESSION['token_time'] = time();

$tplVars['loadjs']     = TRUE;
$tplVars['subtitle']   = T_('Sign up');
$tplVars['pagetitle']   = T_('Sign up');
$tplVars['formaction'] = createURL('register');
$tplVars['token']      = $token;
$templateservice->loadTemplate('register.tpl', $tplVars);
