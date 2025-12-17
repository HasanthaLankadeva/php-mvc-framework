<?php 
    require_once('db_connection/db_connection.php');
?> 
<!DOCTYPE html>
<html>
<head>
<?php 
$adminPage = "createAccount";
require("includes/admin-header-open.php"); 
?>
<body>
<div class="holder">
    <div class="sidebar">
		<?php 
            include('includes/sideBar.php'); 
        ?>
    </div>
    <div class="content-wrapper">
    	<div class="top-bar">
            <div class="breadcrumb">
                <a class="fa fa-home" href="home.php"></a> <span>/</span> <span>User Manager</span>
            </div>
            <div class="dev">
				<a class="fa fa-desktop" href="<?=SERVER;?>" title="Preview Site" target="_blank"></a>
			</div>         
			<div class="live">
				<a class="fa fa-globe" href="<?=LIVE_SERVER;?>" title="Live Site" target="_blank"></a>
			</div>
        </div>
        <div class="inner-wrapper">  
    	<?php 
			 
			// Define variables and initialize with empty values
			$username = $email = $type = "";
			$username_err = $email_err = $password_err = $confirm_password_err = $type_err = "";
			 
			// Processing form data when form is submitted
			if($_SERVER["REQUEST_METHOD"] == "POST"){
			 
				// Validate email
				if(empty(trim($_POST["email"]))){
					$email_err = "Please enter a email.";
				} else{
					// Prepare a select statement
					$sql = "SELECT id FROM admin_accounts WHERE email = :email";
					
					if($stmt = $DB->prepare($sql)){
						// Bind variables to the prepared statement as parameters
						$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
						
						// Set parameters
						$param_email = trim($_POST["email"]);
						
						// Attempt to execute the prepared statement
						if($stmt->execute()){
							if($stmt->rowCount() == 1){
								$email_err = "This email is already taken.";
							} else{
								$email = trim($_POST["email"]);
							}
						} else{
							echo "Oops! Something went wrong. Please try again later.";
						}
			
						// Close statement
						unset($stmt);
					}
				}
				
				// Validate username
				if(empty(trim($_POST["username"]))){
					$username_err = "Please enter a name.";     
				} else{
					$username = trim($_POST["username"]);
				}
				
				// Validate confirm type
				if(empty(trim($_POST["type"]))){
					$type_err = "Please enter a type.";     
				} else{
					$type = trim($_POST["type"]);
				}
				
				// Validate password
				if(empty(trim($_POST["password"]))){
					$password_err = "Please enter a password.";     
				} elseif(strlen(trim($_POST["password"])) < 6){
					$password_err = "Password must have atleast 6 characters.";
				} else{
					$password = trim($_POST["password"]);
				}
				
				// Validate confirm password
				if(empty(trim($_POST["confirm_password"]))){
					$confirm_password_err = "Please confirm password.";     
				} else{
					$confirm_password = trim($_POST["confirm_password"]);
					if(empty($password_err) && ($password != $confirm_password)){
						$confirm_password_err = "Password did not match.";
					}
				}

				// Check input errors before inserting in database
				if(empty($username_err) && empty($email_err) && empty($type_err) && empty($confirm_password_err)){
					
					// Prepare an insert statement
					$sql = "INSERT INTO admin_accounts (username, password, email, type) VALUES (:username, :password, :email, :type)";
					 
					if($stmt = $DB->prepare($sql)){
						
						// Set parameters
						$param_username = $username;
						$param_type = $type;
						$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
						
						// Bind variables to the prepared statement as parameters
						$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
						$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
						$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
						$stmt->bindParam(":type", $param_type, PDO::PARAM_STR);
						
						// Attempt to execute the prepared statement
						if($stmt->execute()){
							echo 'userManager.php';
						} else {
							echo "Something went wrong. Please try again later.";
						}
			
					}
				}
				
				// Close connection
				unset($DB);
			}
		?> 
		
				<div class="wrapper">
					<h2>Create Account</h2>
					<form class="module-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<ul>
							<li class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
								<label>Name</label>
								<input type="text" name="username" class="form-control" value="">
								<span class="help-block"><?php echo $username_err; ?></span>
							</li>
							<li class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<label>Email</label>
								<input type="email" name="email" class="form-control" value="">
								<span class="help-block"><?php echo $email_err; ?></span>
							</li>
							<li class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
								<label>Password</label>
								<input type="password" name="password" class="form-control" value="">
								<span class="help-block"><?php echo $password_err; ?></span>
							</li>
							<li class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
								<label>Confirm Password</label>
								<input type="password" name="confirm_password" class="form-control" value="">
								<span class="help-block"><?php echo $confirm_password_err; ?></span>
							</li>
							<li class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
								<label>Type</label>
								<select class="form-control" name="type">
									<option value="admin">Admin</option>
									<option value="super-admin">Super Admin</option>
								</select>
								<span class="help-block"><?php echo $type_err; ?></span>
							</li>
							<li class="form-group">
								<input type="submit" class="btn btn-primary" value="Save">
							</li>
						</ul>
					</form>
				</div> 
			</div>
		</div>
	</div>


  

</body>
</html>