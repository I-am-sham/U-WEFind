<?php

	//session_start();
	
function getDBConnection(){
	try{ 
		$db = new mysqli("localhost","root","","timetable");
		if ($db == null && $db->connect_errno > 0)return null;
		return $db;
	}catch(Exception $e){ } 
	return null;
}

function saveUser($Fname, $Lname, $username, $email, $password){
	$password = sha1($password);
	$sql = "INSERT INTO `user` (`Fname`, `Lname`, `username`, `email`, `password`) VALUES ('$Fname', '$Lname', '$username', '$email', '$password');";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}
?>