<?php 
	session_start();
    require_once('db_connection/db_connection.php');
    if(empty($_SESSION['loggedin'])) 
    { 
        echo '<script type="text/javascript"> window.location = "index.php"</script>';
    }
	$user = htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
	$GLOBALS['widgateData'] = simplexml_load_file(ADMIN_URL."area.xml");
?> 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WebTools</title>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<?php
if(!empty($adminPage) && $adminPage == "adminTools" || !empty($adminPage) && $adminPage == "userManager"){
echo '<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
echo '<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />';
}
?>
<link href="css/layout.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>