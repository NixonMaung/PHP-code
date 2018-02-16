<?php

function accommodation_user($accommodation_data){
	array_walk($accommodation_data,'array_sanitize');
	$fields = '`' . implode('`, `',array_keys($accommodation_data)) . '`';
	$data = '\'' . implode ('\', \'',($accommodation_data)). '\'';
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p')or die(error_log);
	$sql = "INSERT INTO ads ($fields) VALUES ($data)";
	if ($con->query($sql) === TRUE) {
    $last_id = $con->insert_id;
	return $last_id;
	}
}

function recover($mode,$email){
	$mode 		=  sanitize($mode); 
	$email 		=  sanitize($email);
	
	$user_data  = user_data(user_id_from_email($email),'first_name','username');
	
	if ($mode == 'username'){
		email($email,"Your username","Hello ".$user_data['first_name'].",\n\nYour username is: ".$user_data['username']."\n\n-Audrey");
	}else if ($mode == 'password'){
		$gererated_password =substr(md5(rand(999,999999)),0,6);//Return part of a string as 6 chara and Generate a random integer
		
		change_password(user_id_from_email($email),$gererated_password);
		
		update_user(user_id_from_email($email),array('password_recover'=>'1'));
		
		email($email,"Your password recovery","Hello ".$user_data['first_name'].",\n\nYour new passwrod is: ".$gererated_password."\n\nPlease log in to change this.-Audrey");	
	}
}

function update_user($user_id,$update_data){

	$update = array();
	array_walk($update_data,'array_sanitize');
	
	foreach($update_data as  $fields=> $data){
		$update[] = '`'.$fields.'` =\''.$data.'\'';
	}
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	mysqli_query($con,"UPDATE users SET  "  . implode(', ', $update) . " WHERE user_id =$user_id");

}

	//new 
	function autoLogin ($email_code){
		$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		$result = mysqli_query($con, "SELECT (user_id) FROM users WHERE email_code = '$email_code'");
		$num_row = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		return $row['user_id']; 
	}

function activate($email_code){
$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');

$email_code= mysqli_real_escape_string($con ,$email_code);
$query= mysqli_query($con,"SELECT * FROM users WHERE email_code='$email_code' AND active=0");
$num = mysqli_num_rows($query);
if($num == '1') {
	mysqli_query($con ,"UPDATE users SET active = 1 WHERE email_code = '$email_code'");

	return true;

}else{
	return false;
	
}
}
function change_password($user_id,$password){
	$user_id=(int)$user_id;
	$password = md5($password);
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	mysqli_query($con,"UPDATE users SET password = '$password' , password_recover=0 WHERE user_id='$user_id'");
}
	
function register_user($register_data){
	array_walk($register_data,'array_sanitize');
	$register_data['password']= md5($register_data['password']);
	$fields = '`' . implode('`, `',array_keys($register_data)) . '`';
	$data = '\'' . implode ('\', \'',($register_data)). '\'';
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	mysqli_query($con,"INSERT INTO users ($fields) VALUES ($data)");
	email($register_data['email'],"Activation code: ".$register_data['email_code'].""," Hello ".$register_data['first_name'].",\n\nYou need to active your account, so use the Activation code or click the link below:\n\nhttp://localhost/activate.php?email_code=".$register_data['email_code']." \n\n - Comp1687");
}

function user_count(){
 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"select * from users where active = 1"); 
 return (mysqli_num_rows($query) );
}

function user_data($user_id){
	$data = array();
	$user_id=(int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_get_args>0){
		unset($func_get_args[0]);
		$fields ='`'. implode('`, `', $func_get_args).'`';
		 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		$data =mysqli_fetch_assoc( mysqli_query($con,"SELECT $fields  FROM `users` WHERE `user_id` = $user_id"));
		return $data;
	}
}

function user_id_from_email($email){
$email = sanitize($email);
$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
$query = mysqli_query($con, "SELECT (user_id) FROM users where email = '$email'");
$row=mysqli_fetch_array($query);

return  $row['user_id'] ;
	
	
	
}

function logged_in(){
	return (isset($_SESSION['user_id'])) ? true: false ;
}


function user_exists($username)
{
	$username = sanitize($username);
$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'"); 
 return (mysqli_num_rows($query) > 0) ? true:false;
}
function email_exists($email)
{
	$username = sanitize($email);
 $con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'"); 
 return (mysqli_num_rows($query) > 0) ? true:false;
}


function user_active($username)
{
	$username = sanitize($username);
$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
 $query = mysqli_query($con,"SELECT * FROM users WHERE username = '$username' AND active=1"); 
 return (mysqli_num_rows($query) > 0) ? true:false;
}


function login ($username, $password)
{
		$username = sanitize($username);
		$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
		$password = md5($password);
	$result = mysqli_query($con, "SELECT (user_id) FROM users where username = '$username' and password = '$password'");
		$num_row = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		return ($num_row ==1 )? $row['user_id'] :false ;
}
?>