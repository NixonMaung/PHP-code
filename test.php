<?php 
ob_start();
include 'core/init.php';
//logged_in_redirect();
include 'includes/overall/Header.php';?>
<div id="container">
	<?php  include 'includes/aside.php';
	echo 'hi <br> ';

	$email_code = '54185';

	var_dump( autoLogin ($email_code ));

	$_SESSION["user_id"] =   activate($email_code); 

	var_dump( activate($email_code ));

	print_r($_SESSION["user_id"]);




