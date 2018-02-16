<?php
ob_start();

function email($to,$subject,$body){//send register email 
	mail($to, $subject, $body,"From: DoNotReply@gre.ac.uk\r\n");
}

function email_contact($to,$subject,$body){
	mail("maungaye89@gmail.com", "$subject", "$body","From: $to\r\n");
}

Function logged_in_redirect(){
	if(logged_in()===true){
		Header('Location: index.php');
		exit();		
	}
}

Function protect_page(){
	if(logged_in()===false){
		Header('Location: protected.php');
		exit();		
	}
}

Function array_sanitize($data)
    {		
	$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	$data =  mysqli_real_escape_string($con,$data);
	//Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
	}
	
Function sanitize ($data)
    {
		$con = mysqli_connect('localhost', 'ma9892p', 'ma9892p' , 'ma9892p');
	return mysqli_real_escape_string($con,$data);// Escapes special characters in a string for use in an SQL statement.
	}
	
	function output_errors($errors){
		$output = array();
		foreach($errors as $error){// loop until Errors lenght 
			$output[] = '<li>'. $error. '</li>';
		}
		return '<ul>' . implode('', $output)  .'</ul>';
	}
		  ob_end_flush();
?>