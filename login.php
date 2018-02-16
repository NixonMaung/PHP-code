<?php 
ob_start();
include 'core/init.php';
include 'includes/overall/Header.php';logged_in_redirect();?>

<div id="container">
<?php  include 'includes/aside.php';


if(empty($_POST)=== false)
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username) === true  || empty($password) === true )
	{
		$errors[] = 'You need to enter a username and password ';
	}else if (user_exists($username)===false)
	{
		$errors[] = 'We can not find that username. Have you registered?';
	}else if (user_active($username)===false )
	{
		echo    'You have not activated your account!';
		
		  header('Location:accountActivateInput.php');
		  exit(); 
	}else 
	{	
	if(strlen($password)>32){
		$errors[] = 'Password too long';
	}
		 $login = login ($username,$password);
			if ($login ===false )
			{
				$errors[] = 'That username / passwrod combination is incorrect';
			}else {
		$_SESSION["user_id"] =   $login ;
      header("Location:index.php");
		exit();	
		} 
	}
}
if (empty($errors)===false){
	
?>
	<h2>We tried to log you in, but...</h2>
<?php
		echo output_errors ($errors);
	
}
?></div><?php
include 'includes/overall/Footer.php';ob_end_flush();?>
