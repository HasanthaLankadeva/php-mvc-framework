<?php 
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
	
	$user_id =  $_POST['user_id'];
	$password = md5($_POST['password']);
	
	try {
		$sql = "UPDATE students SET password='".$password."' WHERE user_id='".$user_id."'";
		$sth = $DB->query($sql);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
		
	$DB = null;	
	
	$data = "success";
	echo json_encode($data);
	
?>