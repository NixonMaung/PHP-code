<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';?>

<form action='search.php' method='GET'>
<center>
<h1>My Search Engine</h1>
<input type='text' size='70' name='search'></br></br>
<input type='submit' name='submit' value='Search' ></br></br></br>
</center>
</form>
		
</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>