<?php 
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/Header.php';?>
<h1 style="text-align:center">Your post</h1>
<div id="container">
<?php  include 'includes/aside.php';?>

<table>
<?php 
$res = user_ad($session_user_id);
for ( $i = 0 ; $i < mysqli_num_rows($res) ; $i++ ) {
	$row = mysqli_fetch_assoc($res);?>
 <tr>
 	<form action="user_ad.php" method="POST">
	<input type="hidden" name="text" value ="<?php echo  $row['ad_id'] ?>"/>
    <td height ="50px" width="15%">
	<input type="image"style="text-align:center" alt="Please upload image hare."  width="170px" height="100px" <?php echo '<img src="getImage.php?id=' . $row['ad_id']. '" alt="Image coming soon" />  ' . "\n";?> 
	 
	</td>
	   
   <td>
	<li><?php echo  $row["title"];?></li>
	<li>Weekly rate:  £<?php echo  $row["weekly_rate"];?></li>
	<li>Location: <?php echo  $row["area"];?></li>
	<li>
	<input type="submit" value="Edit" /> &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" value="Image" name ='image'>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" value="Delete" name ='delete'>
	&nbsp;&nbsp;
	</li>
	</form>
	
	</td>
 
</tr><?php }?>
 
</table>
</form>


</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>
