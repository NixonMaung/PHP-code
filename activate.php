<?php 
ob_start();
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/Header.php';?>
<div id="container">
	<?php  include 'includes/aside.php';

	if (isset($_GET['email_code'])===true){

		$_SESSION["user_id"] =  autoLogin ($_GET['email_code']); 

		?>
		<h2> "Thanks,</h2> <br>
		We have been activated your account successfully ....."

	</div>
	<?php 
	header("refresh:5;http://localhost:8888/public_html/index.php");
	exit();	}include 'includes/overall/Footer.php';ob_end_flush();?>


