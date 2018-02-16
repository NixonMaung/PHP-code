<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';?>
<h1>Recover</h1>
<?php

  if(isset($_GET['success'])===true && empty($_GET['success'])===true){
	?>
	<p>Thanks, we have emailed you.</p>
	<?php 
}else{
$mode_allowed = array ('username','password');
if(isset($_GET['mode'])===true && in_array($_GET['mode'],$mode_allowed)){
	
	 if (isset($_POST['email'])===true && empty($_POST['email'])=== false){
		 
		 if(email_exists($_POST['email'])===true){
			recover($_GET['mode'],$_POST['email']);
			 Header('location: recover.php?success');
			 exit();
		 }else {
			 echo '<p>Ooop, we could not find that email address</p>';
		 }
	 }
	 
?> <form action ="" method="POST">
	<ul>
		Please enter your email address:<br>
			<input type="text" name="email" size="32">
		</ul>
		</ul>
			<input type="submit" value="Recover">
		</ul>
</form>
<?php
}else{
	Header('location: index.php');
	exit();
}
}
?>



</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>