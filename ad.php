<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
	<a href="index.php" style="text-align:center" style="text-align:"right">Back</a>
	<?php  include 'includes/aside.php';

	if(!empty($_POST['text'])){
		$_SESSION['ad_id'] =$_POST['text'];
	}
	
	$ad_id=$_SESSION['ad_id'];

	$res = ad_data($ad_id);
	while ($row = mysqli_fetch_array($res))
	{
		?>
		<table  border-right:1px dashed #ddd; align= "center">
			
			<h1 style="text-align:center">
				<?php 
				echo $row['title'];

				$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
				$res =( mysqli_query($con,"SELECT * from image where ad_id ='$ad_id'"));
				?></h1>
				<td>
					
					<img style="text-align:center" alt="Image will come soon...." height = "350px" width="550px" style="border:3px solid grey" id="mainImage" <?php echo '<img src="getImage.php?id=' .$ad_id. '"/>' ?>
				</td>

			</table>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			<div id="myDiv" onclick="changeImage(event)">
				
				<?php
				for ( $i = 0 ; $i < mysqli_num_rows($res) ; $i++ ) {
					$row = mysqli_fetch_assoc($res);
					?>

					<img height="60px" width="70px" align="left" style=" border:3px solod grey" <?php echo '<img src="getimages.php?id=' .$row['id']. '"/>' ?>


					<?php }?>
				</div>
				<?php $res =  new_ad_data($ad_id); 
				for ( $i = 0 ; $i < mysqli_num_rows($res) ; $i++ ) {
					$row = mysqli_fetch_assoc($res);
					?>
					
					<table style="width:95%" "> 
						<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
						<tr>
							
							<td width="12%"><b>Posted:</td>
								<td><?php echo  $row['posted'];?></td>
								<td width="11%"><b>Property type</td>
									<td><?php echo $row['property_type'];?>
										<td width="11%"><b>Seller type: </td>
											<td><?php echo $row['seller_type'];?> </td>
											<td width="10%"><b>Location: </td>
												<td><?php echo $row['area'];?> </td>
												
											</tr>
											<tr>
												<td><b>Number of bed:</td>
													<td><?php echo $row['no_bed'];?></td>
													<td width="11%"><b>Date available:</td>
														<td><?php echo $row['date_available'];?></td>
														<td width="11%" ><b>Available to couples:<b></td>
															<td><?php echo $row['available_couples'];?></h3></td>
															
															<td width="11%"><b>Weekly rate: £</td>
																<td><?php echo $row['weekly_rate'];?> </td>
															</tr>

														</table>
														<hr>
														<b><h3>Description:</h3></b>
														
														<p><?php echo $row['description'];  ?>
														</p>
														<b><h3>Address:</h3></b>
														
														<?php echo $row['address'].' '.$row['area']; }} ?>
														
														


													</div>
													<?php  include 'includes/overall/Footer.php';ob_end_flush();?>
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
													