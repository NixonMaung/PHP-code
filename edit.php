<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';
if(isset($_POST['text'])===true){
$id= $_POST['text'];
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	$sql = mysqli_query($con,"SELECT * FROM image WHERE id='$id'");
	 $row = mysqli_fetch_object($sql);
	 ?>
			<a href="indaxx.php" style="text-align:center" style="text-align:"right">Back</a>
			
			<form align="center" action ='Update_product.php' method ="POST" enctype="multipart/form-data"><br>
				
			<input type="hidden" value="<?php echo $id;?>" name="id"><br>
			<?php  echo '<img width="550" height="350" src="getimages.php?id=' .  $id . '"/>  ' . "\n";?><br><br><br>
		
			<input type="file" name="image" required/>
			<input type="submit" value="Upload" name="Update">
			
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
				
			</form>
<?php  } ?>
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>