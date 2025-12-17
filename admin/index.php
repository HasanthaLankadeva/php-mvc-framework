<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WebTools</title>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-3.5.1.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>
</head>
<body>

<?php 
	session_start();
	// First we execute our common code to connection to the database and start the session 
    require_once('db_connection/db_connection.php');
	 
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: ".dirname($_SERVER['PHP_SELF'])."/home.php");
		exit;
	}
	
	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM admin_accounts WHERE username = :username";
			
			if($stmt = $DB->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
				
				// Set parameters
				$param_username = trim($_POST["username"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Check if username exists, if yes then verify password
					if($stmt->rowCount() == 1){
						if($row = $stmt->fetch()){
							$id = $row["id"];
							$username = $row["username"];
							$hashed_password = $row["password"];
							if(password_verify($password, $hashed_password)){
								// Password is correct, so start a new session
								//session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;                            
								
								// Redirect user to welcome page
								// header("location: ".dirname($_SERVER['PHP_SELF'])."/home.php");
								echo '<script type="text/javascript"> window.location = "home.php"</script>';
                              
							} else{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						}
					} else{
						// Display an error message if username doesn't exist
						$username_err = "No account found with that username.";
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
	
				// Close statement
				unset($stmt);
			}
		}
		
		// Close connection
		unset($db);
	}
?> 

    <div class="login-form-wrapper">
    	<div class="login-form">
            <h2>Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                	<span class="fa fa-user"></span>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                	<span class="fa fa-lock"></span>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <p class="forgot-pw">Forgot <a href="#">Password?</a></p>
                <div class="form-group button-wrapper">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
         </div>
    </div>
</body>
</html>