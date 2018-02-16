<?php
ob_start();
session_start(); 
require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/ads.php';
$current_file = explode('/',$_SERVER['SCRIPT_NAME']);
$current_file =end($current_file);


if(logged_in()===true){

	$session_user_id= $_SESSION['user_id'];
	$user_data = user_data($session_user_id,'user_id','username','password','first_name','last_name','email','password_recover','allow_email');
	
	if(user_active($user_data['username'])=== false){
		session_destroy();
		header('Location: index.php');
		exit();
	}if($current_file !== 'changepassword.php' && $current_file !== 'logout.php' && $user_data['password_recover']==1){
		header('Location: changepassword.php?force');
		exit();
	}
}
$error = array();
ob_end_flush();
?>