<?php 
ob_start();
include 'core/init.php';

include 'includes/overall/Header.php';?>
<div id="container">
<?php  include 'includes/aside.php';?>

<h1>Sorry you need to be logged in to do that!</h1>
<p>Please register or log in</p>

</div>
<?php  include 'includes/overall/Footer.php';ob_end_flush();?>