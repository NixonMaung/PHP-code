<?php
$link = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
$query = 'SELECT type,img FROM image WHERE id="' . $_GET['id'] . '"';
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
header('Content-Type: ' . $row['type']);
echo $row['img'];
?>