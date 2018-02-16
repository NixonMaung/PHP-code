<?php 
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/Header.php';?>
<h1 style="text-align:center">Change password</h1>
<div id="container">
<?php  include 'includes/aside.php';


if(empty($_POST)===false){
	$required_fields = array('current_password','password','password_again');
	foreach ($_POST as $key=>$value){
		if (empty($value)&& in_array($key,$required_fields)===true){
			$errors[]='Fields marked with an asterisk are required.';
			break 1;
		}
	}
	if(md5($_POST['current_password'])=== $user_data['password'] ){
			if(trim($_POST['password']) !== trim($_POST['password_again'])){
				$errors[]='Your new password do not match.';
							
			}else if (strlen($_POST['password'])<6){
				$errors[]='You password must be at least 6 characters.';	
			}
	}else{
		$errors[]='Your current password is incorrect';
	}
}  if(isset($_GET['success'])===true && empty($_GET['success'])===true){
			echo 'Your password has been changed.';
   }else{
   if(isset($_GET['force'])===true && empty($_GET['force'])===true){
	   ?>
	   <p>You must change your password now that you've requested.</p>
	   <?php
   }
 if (empty	($_POST)===false && empty($errors)=== true){
change_password($session_user_id,$_POST['password']);
header('Location: changepassword.php?success');	
	echo 'ok';
 }else if (empty($error)===true){
	   $errors []='';
	 echo output_errors($errors);
 }
   
   
?>
<form action ="" method ="POST">
	<ul>
	<li>
	<b>Current password*:<br>
	<input type="password" name="current_password" >
	</li>
	<li>
		New password*:<br>
	<input type="password" name="password" ></li>
	<li>
		New password again*:<br>
	<input type="password" name="password_again" ></li>
	<li>
	<input type="submit" value ="Change password">
	</li>
	</ul>
</form>
   <?php }?>
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>