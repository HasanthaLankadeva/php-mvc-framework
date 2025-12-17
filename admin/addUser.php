<?php 
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
		
		function UserID()
		{
			$x = 4; // Amount of digits
			$min = pow(10,$x);
			$max = pow(10,$x+1)-1;
			$uID = rand($min, $max);
			return $uID;
		}
		
		$table = $_POST['m'];
		$user_id =  UserID();
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$class_type = implode(',', $_POST['class_type']);
		$qualifications = $_POST['qualifications'];
		$grade = $_POST['grade'];
		$status = ($table == 'module_students') ? 'active' : 'deactive';
		$reg_date = date("Y-m-d");
		$password = md5($_POST['password']);
		$dcrptpassword = encryptIt( $_POST['password'] );
		
		function encryptIt( $q ) {
			$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
			$qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
			return( $qEncoded );
		}
		
		if ($table == 'module_students'){
			try {
				$sql = "INSERT INTO module_students (user_id, first_name, last_name, gender, email, phone, class_type, grade, reg_date, status, password, dcrptpassword) VALUES ('$user_id', '$first_name', '$last_name', '$gender', '$email', '$phone', '$class_type', '$grade', '$reg_date', '$status', '$password', '$dcrptpassword')";
				$sth = $DB->query($sql);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		} else {
			try {
				$sql = "INSERT INTO module_lecturesadmin (user_id, first_name, last_name, gender, email, phone, class_type, qualifications, reg_date, status, password, dcrptpassword) VALUES ('$user_id', '$first_name', '$last_name', '$gender', '$email', '$phone', '$class_type', '$qualifications', '$reg_date', '$status', '$password', '$dcrptpassword')";
				$sth = $DB->query($sql);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		$DB = null;
		
		$data = array( $user_id, $first_name, $phone );
		echo json_encode($data);
		
	?>