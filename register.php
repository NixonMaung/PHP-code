<?php 
ob_start();
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/Header.php';?>
<div id="container">

<?php  include 'includes/aside.php';?>


<?php
if(empty($_POST)===false){
	$required_fields = array('username','password','password_againn','first_name','email');
	foreach ($_POST as $key=>$value){
		if (empty($value)&& in_array($key,$required_fields)===true){
			$errors[]='Fields marked with an asterisk are required.';
			break 1;
		}
	}	
	if(empty($errors)===true){
		if(user_exists($_POST['username'])===true){
			$errors[]='Sorry, the username \' ' .$_POST['username'].' \' is already taken.';
		}
		if(preg_match("/\\s/",$_POST['username'])==true){
			$errors[]='Your username must not contain any spaces.';
		}
		if(strlen($_POST['password'])<6){
			$errors[]='You password must be at least 6 characters.';
		}
		if ($_POST['password'] !== $_POST['password_againn']){
			$errors[]='Your password do not match.';
		}
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL )===false){
			$errors[] = 'A valid email address is required.';
		}
			if(email_exists($_POST['email'])===true){
			$errors[]='Sorry, the email \' ' .$_POST['email'].' \' is already in use.';
		}
	}
}
?>      

 <?php
	   if(isset($_GET['success']) && empty($_GET['success'])){
			echo 'You have been registered successfully. Please check your email to activate your account!';
		  
	  }else {
		  if (empty	($_POST)===false && empty($errors)=== true){
		  $register_data = array(
		  'username' 	=>$_POST['username'],
		  'password'	=>$_POST['password'],
		  'first_name'	=>$_POST['first_name'],
		  'last_name'	=>$_POST['last_name'],
		  'email'		=>$_POST['email'],
		  'email_code'	=>substr(md5(rand(999,999999)),0,5)
		  );
		  register_user($register_data);
		   header('Location:accountActivateInput.php');
		  exit(); 
	  }else if (empty($error)===true) {
		    $errors []='';
		 echo  output_errors($errors);  
	  }
	  }
	  ?> 	
	  <h1>Register</h1>
 
	   <form action ="" method="POST">
		<ul>
		<b>Username*:<br>
			<input type="text" name="username" size="32"  >
		</ul>
		<ul>
		Password*:<br>
			<input type="password" name="password" size="32">
		</ul>
		<ul>
		Password*:<br>
			<input type="password" name="password_againn" size="32">
		</ul>
		<ul>
		First Name*:<br>
			<input type="text" name="first_name" size="32">
		</ul>
		<ul>
		Last Name:<br>
			<input type="text" name="last_name" size="32">
		</ul>
		<ul>
		Email*:<br>
			<input type="text" name="email" size="32">
		</ul>

			<input type="submit" value="  Register   " name="register">
		</ul>
	
	</form>
</div>

<?php  include 'includes/overall/Footer.php';ob_end_flush();?>
