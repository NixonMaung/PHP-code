<?php 
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/Header.php';?>
<h1 style="text-align:center">New post</h1>
<div id="container">
<?php  include 'includes/aside.php';?>



<?php 
if(empty($_POST)===false){
	$required_fields = array('title','property_type','address','no_bed','image','description','date_available');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key,$required_fields)===true){
			$errors[]='Fields marked with an asterisk are required';
			break 1;
		}	
}}  if(isset($_GET['$ad_id']) && empty($_GET['$ad_id']) ){
		echo 'Your new accommodation post added successfully!';?>
		<table align="center" >
	<tbody >
			<?php
				$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
				$sql = mysqli_query($con,"SELECT * from image");?>		
				<?php for ( $i = 0 ; $i < mysqli_num_rows($sql) ; $i++ ) {
				$row = mysqli_fetch_assoc($sql);
			?>			
				<td>
				<?php echo '<img width="40" height="40" src="getimages.php?id=' . $row['id'] . '"/>  ' . "";?><br>
				<a href="edit.php?id=<?php echo  $row['id'] ?>">Edit</a>
				<a href="accommodation.php?id=<?php echo  $row['id'] ?>">Delete</a>
				</td>
			
			<?php }?>
					
	</tbody >
</table>
		
		<?php 
		  
	  }else {
		  
		  if (empty($_POST)===false && empty($errors)=== true){
			  
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
		  'available_couples' =>$_POST['available_couples'],
		  'posted'		    =>date("Y/m/d"),
		  'contact'		    =>$user_data ['email'],
		  'user_id'			=> $session_user_id
		  ); $ad_id = accommodation_user($accommodation_data);
					 $_SESSION['ad_id']=$ad_id;
		
		  
		  //insert image
		  if(empty ($_POST['image'])===false){
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
				   // Commit image to the database
				   $image = mysqli_real_escape_string($link, $image);
				    
				   $query = 'INSERT INTO image (ad_id,type,name,active,pri,img) VALUES ("' .$ad_id . '", "' . $_FILES['image']['type'] . '","' . $_FILES['image']['name']  . '","' . 1 . '","' . 1 . '","' . $image . '")';
				   if ( !(mysqli_query($link, $query)) ) {
					  die('<p>Error writing image to database</p></body></html>');
		  } }}else {
					   	 header('Location: indaxx.php' );
						exit();
				   }
	  
				
						  
		  
		  
		  
		
	  }else if (empty($error)===true) {
		    $errors []='';
		 echo  output_errors($errors);  
	  }
	  ?>
		
		

		
	<form action ="" method="POST" enctype="multipart/form-data">
<table >
<tbody >
	<tr>
		<td >						
		Ad Title*:
			<input type="text" name="title" size="32">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
							
		<td>	
			Number of Bed*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="number" name="no_bed" min="1" max="600">
		</td>						
	</tr>
	<tr>
		<td>
		Address*:
			<input type="text" name="address" size="32">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Property Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="property_type">
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
		<input type="text" name="area" size="32">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Seller Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="seller_type">
				<option value="Private">Private</option>
				<option value="Public">Public</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
		 Weekly rate:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="number" name="weekly_rate" step=0.01 > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		
		<td>
		Available to couples:
		  <input type="radio" name="available_couples" value="Yes" checked="Yes">Yes
		  <input type="radio" name="available_couples" value="No"> No<br>
		 </td>
	</tr>
	<tr>
		<td>
		 Date available*: &nbsp;&nbsp;&nbsp;&nbsp; <input type="date" name="date_available" min="2016-01-02">&nbsp;&nbsp;
		 </td>
	<tr>
	</tr>
	<tr>
</tbody>
</table><br>
		 
		Description*:<br>
		<textarea rows="5" cols="70" name="description"  ></textarea><br>
		
	<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		

			<input type="submit" value="    Submit    "/>
	
			
		
</form>


<?php }  ?>


</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>