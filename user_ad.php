<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';

	
	if(empty($_POST["text"])===false)
	{
		$_SESSION['ad_id']= $_POST['text'];	
	}
	 

	if(empty($_POST["update"])===false){
		$required_fields = array('title','property_type','address','no_bed','description','image');
			foreach ($_POST["update"] as $key=>$value){
			if (empty($value) && in_array($key,$required_fields)===true){
			$errors[]='Fields marked with an asterisk are required';
			break 1;
		}	
	}
} 

		
?>


<h2 align="center">Accommodation post!</h2>
<a href="userPost.php" align="right" style="text-align:"right">Back</a><br><p><p>
<?php
if (isset($_POST['save'])){
	header('Location: userPost.php');
}else if(isset($_POST['delete'])){
	$row= myFunction($_SESSION['ad_id']);
	delete_row($row,$_SESSION['ad_id']);
	//echo $row.' ' .$_SESSION['ad_id'];
	header('location: userPost.php');

}else if(isset($_POST['image'])){
	header('location: indaxx.php');
	

}else if(isset($_GET['success']) && empty($_GET['success']) ){
	 echo  'Your\'s ad details have been updated.';
	
  
}else {

  if (empty($_POST["update"])===false && empty($errors)=== true){
  $accommodation_data = array(
  'title' 			=>$_POST['title'],
  'property_type' 	=>$_POST['property_type'],
  'area' 			=>$_POST['area'],
  'address' 		=>$_POST['address'],
  
  'no_bed'			=>$_POST['no_bed'],
  'description'		=>$_POST['description'],
  'weekly_rate'		=>$_POST['weekly_rate'],
  
  
  'seller_type'		=>$_POST['seller_type'],
   'date_available'	=>$_POST['date_available'],
  'available_couples'=>$_POST['available_couples'],
  'posted'		    =>date("Y/m/d"),
  'contact'		    =>$user_data ['email'],
  'user_id'			=> $session_user_id
  );
 

  update_ad($_SESSION['ad_id'],$accommodation_data);
  header('Location: user_ad.php?success');
  exit();
}else if (empty($error)===true) {
	$errors []='';
 echo  output_errors($errors);  
}

$res = ad_data($_SESSION['ad_id']);

while ($row = mysqli_fetch_array($res))
{
?>
<form action ="" method="POST" enctype="multipart/form-data">
<table >
<tbody >
	<tr>
		<td >						
		Ad Title*:
			<input type="text" name="title" size="32" value="<?php echo $row['title'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
							
		<td>	
			Number of Bed*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="number" name="no_bed" min="1" max="600" value="<?php echo $row['no_bed'];?>">
		</td>						
	</tr>
	<tr>
		<td>
		Address*:
			<input type="text" name="address" size="32" value="<?php echo $row['address'];?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Property Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="property_type" value="<?php echo $row['prpperty_type'];?>">
				<option value="Apartment">Apartment</option>
				<option value="House">House</option>
				<option value="Flat">Flat</option>
				<option value="Villa">Villa</option>
			  </select>
		</td>
	</tr>
	<tr>
		<td>
		City*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="area" size="32" value="<?php echo $row['area'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Seller Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="seller_type" value="<?php echo $row['seller_type'];?>">
				<option value="Private">Private</option>
				<option value="Public">Public</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
		 Weekly rate:&nbsp;
		 <input type="number" name="weekly_rate" step=0.01 value="<?php echo $row['weekly_rate'];?>"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Available to couples:
		  <input type="radio" name="available_couples" value="Yes" checked="Yes">Yes
		  <input type="radio" name="available_couples" value="No"> No<br>
		 </td>
	</tr>
	<tr>
		<td>
		 Date available:  <input type="date" name="date_available" min="2016-01-02" value="<?php echo $row['date_available'];?>">&nbsp;&nbsp;
		 </td>
	<tr>
	</tr>
	<tr>
</tbody>
</table><br>
		 
		Description*:<br>
		<textarea rows="5" cols="70" name="description"  ><?php echo $row['description'];?> </textarea><br>
		
	<br><br>
	<input type="submit" align="center" value="  Update  " name="update"/>
	<input type="submit" value="Cancel" name="save">
			
		
</form>
			
			
</div> 

<?php
} }
?></div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>