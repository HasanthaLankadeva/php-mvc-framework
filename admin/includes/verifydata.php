 <?php
	header('Content-Type: application/json');
	require_once('db_connection/db_connection.php');
	
	$itemID = $_POST['itemID'];
	$month = $_POST['month'];
	$user_id = $_POST['studentID'];
	
	$sql = "SELECT COUNT(*) AS num FROM module_payments WHERE user_id LIKE '%".$user_id."%' AND course_id LIKE '%".$itemID."%' AND year LIKE '%".date('Y')."%' AND month LIKE '%".$month."%'";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if($row['num'] == 0){
		$data = true;
	} else {
		$data = false;
	}
	
	echo json_encode($row['num']);
?>