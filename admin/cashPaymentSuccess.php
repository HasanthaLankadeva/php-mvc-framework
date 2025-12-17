<?php 
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
	
	function transactionID()
	{
		$x = 6; // Amount of digits
		$min = pow(10,$x);
		$max = pow(10,$x+1)-1;
		$uID = rand($min, $max);
		return $uID;
	}

	$payment_type = 'cash';
	$transaction_id = transactionID();
	$student_id = $_POST['student_id'];
	$classID = $_POST['data_ref'];
	$year = date("Y");
	$month = $_POST['month'];
	$paid_date = date("Y-m-d");
	$status = 'deactive';
	
	$errors= array();
	$file_size = $_FILES['image']['size'];
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_type = $_FILES['image']['type'];
	$temporary = explode(".", $_FILES["image"]["name"]);
	$file_extension = end($temporary);
	$file_name = $classID.'_'.$year.'_'.$month.".".$file_extension;

	if(empty($errors) == true){
		$dirPath = 'img/uploads/pay-slips/'.$student_id;

		if(!is_dir($dirPath)){
			mkdir($dirPath);
		}
		
		$attachment = $dirPath.'/'.$file_name;
		
		move_uploaded_file($file_tmp,$attachment);
		
		try {
			$sql = "INSERT INTO module_payments (payment_type, transaction_id, user_id, course_id, year, month, paid_date, attachment, status) VALUES ('$payment_type', '$transaction_id', '$student_id', '$classID', '$year', '$month', '$paid_date', '$attachment', '$status')";
			$sth = $DB->query($sql);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
		$DB = null;
		
		$dataResult = "Success";
	}else{
		$dataResult = "Failed";
	}
	
	echo json_encode($dataResult); 
		
?>