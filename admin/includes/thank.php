<?php
$status = 'Draft';
$ReffN = $_POST['ReffN'];
$name = $_POST['firstName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$jobcategory = $_POST['category'];
$jobtype = $_POST['secondCategory'];
$paymenttype = '';//$_POST['paymentType'];
$code = ''; //$_POST['code'];
$description = $_POST['description'];
$cv = $cv;

$sql = "INSERT INTO resumes (status, ReffN, name, email, phone, jobcategory, jobtype, paymenttype, code, description, cv) VALUES ('$status', '$ReffN', '$name', '$email', '$phone', '$jobcategory', '$jobtype', '$paymenttype', '$code', '$description', '$cv')";
$stmt = $DB->prepare($sql);
$stmt->execute();
if(!$stmt){
	
} else {
	sleep(5);
	echo '<script type="text/javascript">alert("Thank you!\nYour message has been successfully sent. We will contact you very soon!");</script>';
	
}
?>
<script> 
	location.replace("candidates.html");
</script>