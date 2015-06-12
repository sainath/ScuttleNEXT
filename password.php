<?php

require_once 'header.inc.php';
$userservice =& ServiceFactory::getServiceInstance('UserService');
$templateservice =& ServiceFactory::getServiceInstance('TemplateService');
$tplVars = array();

if ($userservice->isLoggedOn()) {
	$cUser = $userservice->getCurrentUser();
	$cUsername = strtolower($cUser[$userservice->getFieldName('username')]);
	header('Location: '. createURL('bookmarks', $cUsername));
}
//echo '<pre>';
//print_r($_POST);

// IF SUBMITTED
if ($_POST['submitted']) {

	if (!$_POST['email']) {
        $tplVars['error'] = T_('You must enter your <abbr title="electronic mail">e-mail</abbr> address.');
    // E-MAIL
    } else {

        $userinfo = $userservice->getUserByEmail($_POST['email']);

        if ($_POST['email'] != $userinfo['email']) {
            $tplVars['error'] = T_('We couldn\'t find a ScuttleNEXT account associated with <b>'.$_POST['email'].'</b>.');

        // MATCH
        } else {

            // GENERATE AND STORE PASSWORD
            $password = $userservice->generatePassword($userinfo['uId']);
            if (!($password = $userservice->generatePassword($userinfo['uId']))) {
                $tplVars['error'] = T_('There was an error while generating your new password. Please try again.');    

            } else {
                // SEND E-MAIL
                $message = T_('Your username is:') ."\n". $userinfo['username'] ."\n\n".T_('Your new password is:') ."\n". $password ."\n\n". T_('To keep your credentials secure, you should change this password in your profile page the next time you sign in.');
                $message = wordwrap($message, 70);
                $headers = 'From: '. $adminemail;
                $mail = mail($_POST['email'], sprintf(T_('%s Account Information'), $GLOBALS['sitename']), $message, $headers);
				$email='mailto:'.$GLOBALS['adminemail'].'?subject=Forgot username or password ['.$_POST['email'].']';
                $tplVars['msg'] = 'Congratulations! Your username and new password is sent to <b>'.$_POST['email'].'</b><br>If you don\'t receive the email, please check your spam folder or <a href="'.$email.'">contact us</a>';
            }
        }
    }
}

$templatename = 'password.tpl';
$tplVars['pagetitle'] = 'Forgot username or password!';
$tplVars['subtitle'] = T_('Forgot username or password!');
$tplVars['formaction']  = createURL('password');
$templateservice->loadTemplate($templatename, $tplVars);
?>
