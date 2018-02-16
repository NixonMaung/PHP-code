<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<a href="userPost.php" style="text-align:center" style="text-align:"right">Back</a>

<?php  include 'includes/aside.php';
	if(isset($_POST['delete']))
{	
	$id=$_POST['text'];
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	$sql = mysqli_query($con,"DELETE FROM image WHERE id='$id'");
	if($sql){
		Header('Location:indaxx.php');
		echo $_GET['id'];
	}
}
			$ad_id=$_SESSION['ad_id'];
			$res = ad_data($ad_id);
		
			while ($row = mysqli_fetch_array($res))
				{
			?>
		<br>	
			<table  border-right:1px dashed #ddd; align= "center">
			<h1 style="text-align:center">
			<?php echo $row['title'];?></h1>
			<td>			
			<img style="text-align:center; " alt="Please upload image hare." height = "250px" width="500px"  id="mainImage" <?php echo '<img src="getImage.php?id=' .$ad_id. '"/>' ?>
	
		</td>
			</table>
			
		<div id="myDiv" onclick="changeImage(event)" >
			<table>
				<tbody>
	
				<?php
			$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
			$res =( mysqli_query($con,"SELECT * from image where ad_id ='$ad_id'"));
			for ( $i = 0 ; $i < mysqli_num_rows($res) ; $i++ ) {
			$row = mysqli_fetch_assoc($res);?>
		
		<td>
			<img height="60px" width="70px" align="left" style=" border:3px solod grey" <?php echo '<img src="getimages.php?id=' .$row['id']. '"/>' ?> 
				
				<form action="edit.php" method="POST">
				<input type="hidden" name="text" value ="<?php echo  $row['id'] ?>"/>
				<button type="submit">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
				</form>

				<form action="indaxx.php" method="POST">
				<input type="hidden" name="text" value ="<?php echo  $row['id'] ?>"/>
				<button type="submit" name="delete">Delete</button>
				</form>	
		

		</td>
				
				<?php }?>
				</tbody>
			</table>	
<p><hr>
			<form action ='insert_product.php' method ="POST" enctype="multipart/form-data">					
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Image: <input type="file" name="image" id="image" >
			<input type="submit" value="Upload" name="upload" >
			<input type="submit" value="Save" name="save"  >
			</form>			
		
			
				<?php }if(isset($_GET['error']) && empty($_GET['error'])){

				
?>
 Please check your upload and try again.
</div>
</div>


<?php }  ob_end_flush();


	  
  ?>





				<script type = "text/javascript">
				var images = document.getElementById("myDiv").getElementsByTagName("img");
				
					for (var i= 0; i< images.lenght; i++){
						images[i].onmouseover = function(){
							this.style.cursor = 'hand';
							this.style.borderColor='red';
						}
						images[i].onmouseout = function(){
							this.style.cursor = 'pointer';
							this.style.borderColor='grey';
						}
						
					}
				
					function changeImage(event){
						event=event || window.event.event;
						var targetElement = event.target || event.srcElement;
						if( targetElement.tagName =="IMG"){
							document.getElementById("mainImage").src = targetElement.getAttribute("src");
						}
						
						
					}
				</script>