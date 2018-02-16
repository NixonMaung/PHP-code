<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';?>

<style> 
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    align:left;
	width:72%;
}

td, th {
    border: 1px solid #white;
    text-align: left;
    padding: 4px;
}

tr:nth-child(even) {
    background-color: #212F3D  ;
}
</style>
<br>

<table>
<?php 

$res =ad_datas();
 index_display();
for ( $i = 0 ; $i < mysqli_num_rows($res) ; $i++ ) {
	$row = mysqli_fetch_assoc($res);?>
 <tr>
 	<form action="ad.php" method="POST">
	<input type="hidden" name="text" value ="<?php echo  $row['ad_id'] ?>"/>
    <td height ="50px" width="15%">
	<input type="image" style="text-align:center" alt="Image will come soon..." width="170px" height="100px" <?php echo '<img   src="getImage.php?id=' . $row['ad_id']. '" />  ' . "\n";?> 
	
	</td>
	</form>    
   <td>
	<li><?php echo  $row["title"];?></li>
	<li><b>Weekly rate:</b>  £<?php echo  $row["weekly_rate"];?></li>
	<li><b>Location:</b> <?php echo  $row["area"];?></li>
	</td>
  
</tr>

<?php }?>
 
</table>
</form>

 
		
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>