<?php 
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/Header.php';?>
<h1 style="text-align:center">New post</h1>
<div id="container">
<?php  include 'includes/aside.php';?>
<h1>'Oop...'</h1>
<a href="indaxx.php" style="text-align:center">Click here to upload the image again.</a><p>
<?php
if (empty(($_FILES['image']['tmp_name']))===false) {
		
		
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
				} else if ( !($image = fread ($handle, filesize($_FILES['image']['tmp_name']))) ) {
				   die('<p>Error reading temp file</p></body></html>');
				} else {
					
				
				   fclose ($handle);
				   	$name= addslashes($_FILES['image']['name']);
					$type= addslashes($_FILES['image']['type']);
				   // Commit image to the database
				   $image = mysqli_real_escape_string($link, $image);	
				   
					$query = 'INSERT INTO image (type,name,img,ad_id) VALUES ( "' . $type . '","' . $name . '","' . $image . '","' .$_SESSION['ad_id'] . '")';
				
				if(mysqli_query($link,$query)){
					header('Location:indaxx.php');
				}
		
				}
}
				
				if (isset($_POST['save'])){
					header('Location: userPost.php');
}		
 
?>		 

		
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>	