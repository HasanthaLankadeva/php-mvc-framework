<?php 
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
	session_start();
	$table = $_POST['m'];
	$user_id =  $_POST['user_id'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT COUNT(*) AS num FROM ".$table." WHERE user_id LIKE '%".$user_id."%' AND password LIKE '%".$password."%' AND status LIKE 'active'";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$name = '';
	$lastName = '';
	$email = '';
	$gender = '';
	$mobile = '';
	$category = '';
	
	if($row['num'] == 0){
		$result = 'User ID or Password invalid !';
	} else {
		
		$sql = "SELECT * FROM ".$table." WHERE user_id LIKE '%".$user_id."%' AND password LIKE '%".$password."%' AND status LIKE 'active'";
		$q = $DB->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
		
		while ($item = $q->fetch()){
			$name .= $item['first_name'];
			$lastName .= $item['last_name'];
			$email .= $item['email'];
			$gender .= $item['gender'];
			$mobile .= $item['phone'];
			$category .= $item['class_type'];
		}
		
		$token = getToken(10);
		
		try {
			$tsql = "UPDATE ".$table." SET token='".$token."' WHERE user_id='".$user_id."'";
			$tsth = $DB->query($tsql);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
		$_SESSION['user_id'] = $user_id;
		$_SESSION['name'] = $name;
		$_SESSION['lastName'] = $lastName;
		$_SESSION['gender'] = $gender;
		$_SESSION['email'] = $email;
		$_SESSION['mobile'] = $mobile;
		$_SESSION['category'] = $category;
		$_SESSION['token'] = $token;
		
		if($table == 'module_students'){
			$_SESSION['user_loged_in'] = true;
		} else {
			$_SESSION['teacher_loged_in'] = true;
		}
		
		$result = 'success';
		
	}
	
	// Generate token
	function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[rand(0, $max-1)];
		}

		return $token;
	}
	
	$data = array( $result, $name, $user_id );
	
	echo json_encode($data);
	
?>