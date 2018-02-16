<?php 
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/Header.php';?>
<h1 style="text-align:center">New post</h1>
<div id="container">
<?php  include 'includes/aside.php';?>

<a href="indaxx.php" style="text-align:center">Click here to upload again.</a><p>
<?php
if(isset($_POST['Update'])) {
		
				$id = $_POST['id'];
				if ( !preg_match( '/gif|png|x-png|jpeg/', $_FILES['image']['type']) ) {
				   die('<p>Only browser compatible images allowed</p></body></html>');
				} else if ( $_FILES['image']['size'] > 16384 ) {
				   die('<p>Sorry file too large</p></body></html>');
				// Connect to database
				} else if ( !($link = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p')) ) {
				   die('<p>Error connecting to database</p></body></html>');
				// Copy image file into a variable
				} else if ( !($handle = fopen ($_FILES['image']['tmp_name'], "r")) ) {
				   die('<p>Error opening temp file</p></body></html>');
				} else if ( !($images = fread ($handle, filesize($_FILES['image']['tmp_name']))) ) {
				   die('<p>Error reading temp file</p></body></html>');
				} else {
				   fclose ($handle);
				   	
					$id = $_POST['id'];
	
		$image =addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name= addslashes($_FILES['image']['name']);
		$type= addslashes($_FILES['image']['type']);		
		$sql ="UPDATE image SET name= '$image_name',type='$type',img='$image' WHERE id='$id'";
			if(mysqli_query($link ,$sql)){	
		header('Location:indaxx.php');
		
			}else{
				echo "Pleae try again..";
				
			}
		}
}
	
		
ob_end_flush();		
?>