<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';
if(isset($_GET['success'])===true && empty($_GET['success'])===true){
echo '<h1>Thanks,</h1> we received your message.'; }
   
?>
<h1>Contact details</h1>
		
 <form action ="" method="POST" style="text-align:left" >
		<ul>
		<b>Your name*:<br>
			<input type="text" name="name" size="32" required  >
		</ul>
		<ul>
		Your email address*:<br>
			<input type="email" name="email" size="32" required>
		</ul>
		<ul>
		Your message*:<br>
		<textarea name ="message" rows="10" cols="70" required></textarea>
		</ul>
		<ul>
		<input type="submit" value="   Send   ">
		</ul>
	</form>
	<?php
	if (isset($_POST['name'],$_POST['email'],$_POST['message'])){

	  $fields =[
	  'name' => $_POST['name'],
	  'email' => $_POST['email'],
	  'message' => $_POST['message']
	  ];
	  foreach( $fields as  $field => $data){
		  if($data){
			  $errors[] ='The '.$field.' is required.';
	  } 
	  }
		  if (empty($error)===true ) {
					$from = $_POST['email'];
			  email_contact($from ,$_POST['name'], $_POST['message']);
				header('Location: contact.php?success');
				exit();
	  } 
  }else{
	  $errors[] ='Something went wrong.';
  }
  
  ?>

</div>


</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>