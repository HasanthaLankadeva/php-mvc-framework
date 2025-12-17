<?php
	session_start();
	
	unset($_SESSION['loggedin']);
	
	// Redirect to login page
	echo '<script type="text/javascript">window.location.href = "index.php";</script>';
	
?>