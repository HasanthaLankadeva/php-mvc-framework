<?php 
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
	
	$user_id =  $_POST['user_id'];
	$phone = $_POST['phone'];
	
	$sql = "SELECT COUNT(*) AS num FROM students WHERE user_id LIKE '%".$user_id."%' AND password LIKE '%".$phone."%' AND status LIKE 'active'";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['num'] == 0){
		$result = 'success';
	} else {
		$result = 'User ID or Mobile Number invalid!';
	}
	
	$data = $result;
	echo json_encode($data);
	
?>