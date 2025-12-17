<?php
	if($moduleName){
		$sql = "SELECT COUNT(*) AS num FROM ".$moduleName;
		$stmt = $DB->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	
	$rql = "SELECT COUNT(*) AS num FROM module_reviews";
	$rtmt = $DB->prepare($rql);
	$rtmt->execute();
	$rrow = $rtmt->fetch(PDO::FETCH_ASSOC);	
?>