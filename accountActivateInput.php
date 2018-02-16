<?php 
ob_start();
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/Header.php';?>
<div id="container">
	<?php  include 'includes/aside.php';

	if(isset($_POST['Submit'])){
		$email_code = trim($_POST['text']);
		if (activate($email_code )===true){
			
			header('Location: activate.php?email_code='.$_POST['text'].'');
		}else { 
			?>
			<h1>"Oop....</h1>
			<br>We had problem activation your account"
			<?php
		}
	}
	?>
	<form action="" method="POST" >
		<br><br>Account activation code:<input type="text" name="text" size="6" required/>
		<input type="submit" value="  Submit  " name="Submit"/>
	</form> 
</div>
<?php  
ob_end_flush();
include 'includes/overall/Footer.php';?>