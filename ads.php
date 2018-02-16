<?php

function user_ad($user_id){
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	return ( mysqli_query($con,"SELECT * from ads where user_id='$user_id' ORDER BY ad_id DESC"));
}

function image_active($ad_id){
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	return (mysqli_query($con,"SELECT * from image where ad_id='$ad_id' and active = '1'"));
}

function index_display(){
		$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		//return ( mysqli_query($con,"SELECT image.img,ads.ad_id, ads.title, ads.area, ads.weekly_rate  from image,ads where image.ad_id = ads.ad_id and image.pri=1 ORDER BY id DESC"));
		return ( mysqli_query($con,"SELECT ads.ad_id, ads.title, ads.area, ads.weekly_rate image.img, from ads,image whereads.ad_id = image.ad_id  ORDER BY id DESC"));
}

	
	function myfunction($ad_id) {
		$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	return  mysqli_num_rows(mysqli_query($con,"SELECT * from image where ad_id='$ad_id'" ));
	}
		
function delete_row ($num_row,$ad_id ){
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	 if ($num_row>=1){
	mysqli_query($con ,"DELETE  image.*, ads.* FROM image INNER JOIN ads ON image.ad_id = ads.ad_id WHERE (ads.ad_id)='$ad_id' and image.ad_id='$ad_id'");
}else {
	mysqli_query($con ,"DELETE FROM ads where ad_id= '$ad_id' ");
	}
	mysqli_query($con ,"DELETE  image.*, ads.* FROM image INNER JOIN ads ON image.ad_id = ads.ad_id WHERE (ads.ad_id)='$ad_id' and image.ad_id='$ad_id'");
	}
 

function image_id($ad_id){
 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"SELECT id from `image` where active = '1' and ad_id =$ad_id"); 
 $num_row = mysqli_num_rows($query);
 $row=mysqli_fetch_array($query);
	return ($num_row ==1 )? $row['id'] :false ;
}

function update_ad($ad_id,$update_data){//take ad id and new data.
	
	$update = array();// creating arrray.
	
	array_walk($update_data,'array_sanitize');//array_walk — Apply a user supplied function to every member of an array

	foreach($update_data as  $fields=> $data){//fie
		
		$update[] = '`'.$fields.'` =\''.$data.'\'';
	}
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	
	mysqli_query($con,"UPDATE ads SET  "  . implode(', ', $update) . " WHERE ad_id =$ad_id");

}

function ad_count(){
 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"select * from ads "); 
 return (mysqli_num_rows($query) );
}

function ad_data($ad_id){//take ad id 
	$data = array(); 
	$ad_id=(int)$ad_id;//converting to int 
	$func_num_args = func_num_args();//func_num_args — Returns the number of arguments passed to the function
	$func_get_args = func_get_args();//func_get_args — Returns an array comprising a function's argument list
	
	if($func_get_args>0){
		unset($func_get_args[0]);
		$fields ='`'. implode('`, `', $func_get_args).'`';//implode — Join array elements with a string
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
$res = mysqli_query($con,"SELECT * from ads where ad_id ='$ad_id'");
		return $res;
	}	
}

function ad_datas(){
		 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		$data = mysqli_query($con,"SELECT *  FROM `ads` ORDER BY ad_id DESC");
		return $data;
} 

function ad_delete($ad_id){
		 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		return mysqli_query($con,"DELETE FROM ads where ad_id = '$ad_id'");	
} 

function new_ad_data($ad_id){
	$ad_id=(int)$ad_id;
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	return mysqli_query($con,"SELECT * from ads where ad_id ='$ad_id'");
		
	}
	
	
?>