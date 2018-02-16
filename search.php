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
    padding: 6px;
}

tr:nth-child(even) {
    background-color: #212F3D  ;
}
</style>
<?php
    
$button = $_GET ['submit'];
$search = $_GET ['search']; 
  $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
if(strlen($search)<=1)
echo "Search term too short";
else{
echo "You searched for <b>$search</b> <hr size='1'></br>";

    
$search_exploded = explode (" ", $search);
 
$x = "";
$struct = "";  
    
foreach($search_exploded as $search_each)
{
$x++;
if($x==1){
$struct .=" seller_type LIKE '%$search_each%' or title LIKE '%$search_each%' or property_type LIKE '%$search_each%' or 
 area LIKE '%$search_each%'    ";
}
else{
$struct .="AND title LIKE '%$search_each%'";
}
  
}
  
$structs ="SELECT * from ads WHERE $struct";
$run = mysqli_query( $con,$structs);
    
$foundnum = mysqli_num_rows($run);
    
if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words. for example: If you want to search 'how to find accommodation'
then use general keyword like 'ads' 'flat' etc..</br>2. Try different words with similar
 meaning.</br>3. Please check your spelling.</br>4. If you need help, visit out Customer service page to contact headoffice.";
else
{ 
  
echo "$foundnum results found !<p>";
  
$per_page = 2;
$start = isset($_GET['start']) ? $_GET['start']: '';
$max_pages = ceil($foundnum / $per_page);
if(!$start)
$start=0; 
$getquery = mysqli_query( $con,"SELECT * FROM ads WHERE $struct LIMIT $start, $per_page");
  echo '<table>';
while($runrows = mysqli_fetch_assoc($getquery))
{?>
 <tr>
 	<form action="ad.php" method="POST">
	<input type="hidden" name="text" value ="<?php echo  $runrows['ad_id'] ?>"/>
    <td height ="50px" width="15%">
	<input type="image" alt="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image coming soon" width="170px" height="100px" <?php echo '<img   src="getImage.php?id=' . $runrows['ad_id']. '" />  ' . "\n";?> 
	
	</td>
	</form>    
	<td>
	<li><?php echo  $runrows["title"];?></li>
	<li><b>Weekly rate:</b>  £<?php echo  $runrows["weekly_rate"];?></li>
	<li><b>Location:</b> <?php echo  $runrows["area"];?></li>
	</td>
  
</tr>
    <?php
}
echo '</table>';

  
//Pagination Starts
echo "<br>";echo "<br>";
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <a href='search.php?search=$search&submit=Search&start=$prev'>Prev</a> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search&start=$i'>$counter</a> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search&start=$i'>$counter</a> ";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <a href='search.php?search=$search&submit=Search&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=Search&start=$per_page'>2</a> .... ";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search&start=$i'>$counter</a> ";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <a href='search.php?search=$search&submit=Search&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=Search&start=$per_page'>2</a> .... ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=Search&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=Search&start=$i'>$counter</a> ";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <a href='search.php?search=$search&submit=Search&start=$next'>Next</a> ";    
}   
echo "</center>";
} 
} 
?>
		
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>
