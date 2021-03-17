<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: tabellendaten_Auflisten.php");
    exit;
}
 
// Include config file
require_once "assets/php/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["signin-email"]))){
        $username_err = "Bitte Benutzernamen eingeben.";
    } else{
        $username = trim($_POST["signin-email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["signin-password"]))){
        $password_err = "Bitte Passwort eingeben.";
    } else{
        $password = trim($_POST["signin-password"]);
    }

	
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT userID, benutzername, passwort FROM Benutzer_Anmeldedaten WHERE benutzername = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
						//if($password == $hashed_password){
                            // Password is correct, so start a new session

							// Check if Remember me is checked and create a cookie
							if(isset($_POST['remember_me'])){

							// Set a cookie that expires in 7 Days
							setcookie("username",$username, time()+3600*24*7);
							}

                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["userID"] = $id;
                            $_SESSION["signin-email"] = $username;    
                            
							
                            // Redirect user to welcome page
                            header("location: tabellendaten_Auflisten.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Die eingebenen Daten sind nicht korrekt.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $password_err = "Die eingegebenen Daten sind nicht korrekt.";
                }
            } else{
                echo "Oops! Etwas ist schief gelaufen. Bitte versuchen Sie es zu einem späteren Zeitpunkt wieder.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Kita-Verwaltungssoftware</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	
	<link rel="stylesheet" href="assets/css/login.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo-text-center"><img src="assets/img/logo_a.PNG" alt="VP-IT Logo"></div>
								<p class="lead">Bitte geben Sie Ihre Login-Daten ein.</p>
							</div>
							<form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
								<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
									<label for="signin-email" class="control-label sr-only">Benutzername</label>
									<input type="text" name="signin-email" class="form-control" id="signin-email" placeholder="Benutzername" value="<?php if(!empty($username)) echo $username; else{ echo $_COOKIE["username"];} ?>">
									<span class="help-block"><?php echo $username_err; ?></span>
								</div>
								<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="signin-password" class="form-control" id="signin-password" placeholder="Passwort">
									<span class="help-block"><?php echo $password_err; ?></span>
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox" name="remember_me">
										<span>Benutzername Speichern</span>
									</label>
								</div>
								<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Anmelden</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="pw-reset.php">Passwort vergessen</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Kita-Verwaltungssoftware</h1>
							<p>by VP-IT</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
