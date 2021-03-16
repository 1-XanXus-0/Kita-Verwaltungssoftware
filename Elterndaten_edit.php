<?php

// Include logged in state check
require("assets/php/checkLogInState.php");

// Include config file
require_once "assets/php/config.php";
 
// Define variables (required fields)
$vorname = $vorname_err = "";
$nachname = $nachname_err = "";
$mobiltelefon = $mobiltelefon_err = "";
$privattelefon = $privattelefon_err = "";
$email = $email_err = "";

// Define variables (Optional Fields)
$diensttelefon = "";

// Variable Names Array
$valueArr = array("vorname", "nachname", "mobiltelefon", "privattelefon", "email", "diensttelefon");

if(isset($_COOKIE["tabellenName"]))
{
	$tabellenName = $_COOKIE['tabellenName'];
	$tabellenID = $_COOKIE['tabellenID'];
}


 // Prepare an insert statement
$sql = "SELECT * FROM $tabellenName WHERE ElternID = '$tabellenID'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
	{
		$vorname = $row["Vorname"];
		$nachname = $row["Nachname"];
		$privattelefon = $row["Telefon_Privat"];
        $mobiltelefon = $row["Telefon_Mobil"];
        $diensttelefon = $row["Telefon_Dienst"];
        $email = $row["Email"];
	}
} 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	//Validate all required fields and assign variable parameter
	foreach($valueArr as $key => $var)
    {
		if(isset($_POST["$var"]))
		{
			if(empty(trim($_POST["$var"])) && $var != "diensttelefon"){
			${$var . "_err"} = "Bitte geben sie " . ucfirst($var) . " ein.";     
			} else{
				${"$var"} = trim($_POST["$var"]);
			}
		}	
    }
	if(empty($vorname_err) && empty($nachname_err) && empty($mobiltelefon_err) && empty($privattelefon_err) && empty($email_err))
    { 
        // Prepare an insert statement
        $sql = "UPDATE elterndaten SET Nachname = ?, Vorname = ?, Telefon_Privat = ?, Telefon_Mobil = ?,
         Telefon_Dienst = ?, Email = ? WHERE ElternID = ?";

        if($stmt = mysqli_prepare($link, $sql) && isset($_POST["dbName"])){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_nachname, $param_vorname,
             $param_privattelefon, $param_mobiltelefon, $param_diensttelefon, $param_email, $param_ElternID);
            
            // Set parameters
            $param_nachname = $nachname;
            $param_vorname = $vorname;                        
            $param_privattelefon = $privattelefon;
            $param_mobiltelefon = $mobiltelefon;
            $param_diensttelefon = $diensttelefon;
            $param_email = $email;
            $param_ElternID = $tabellenID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                header("location: tabellendaten_auflisten.php");
				exit();

            } else{
                echo "Etwas ist schief gelaufen.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
	}

	if(isset($_POST["delete"]))
    {
        $sql = "DELETE FROM $tabellenName WHERE ElternID = '$tabellenID'";

        if($stmt = mysqli_prepare($link, $sql))
        {
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
               
                header("location: tabellendaten_auflisten.php");
				exit();

            } else{
                echo "Etwas ist schief gelaufen.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vormund Neu Anlegen</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="tabellendaten_Auflisten.php"><img src="assets/img/logo_nav.PNG" alt="VP-IT Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					
				</form>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">						
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt=""> <span><?php echo $username ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="pw-reset.php"><i class="lnr lnr-cog"></i> <span>PW Ändern</span></a></li>
								<li><a href="assets/php/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<!-- <li><a href="index.php" class="active"><i class="lnr lnr-home"></i> <span>Startseite</span></a></li> -->
						<li><a href="tabellendaten_Auflisten.php" class=""><i class="fa fa-database"></i> <span>Daten</span></a></li>
						<li><a href="kind_neu.php" class=""><i class="lnr lnr-users"></i> <span>Kind hinzufügen</span></a></li>
						<li><a href="eltern_neu.php" class=""><i class="lnr lnr-users"></i> <span>Vormund hinzufügen</span></a></li>
						<li><a href="mitarbeiter_neu.php" class=""><i class="lnr lnr-users"></i> <span>Mitarbeiter hinzufügen</span></a></li>
						<li><a href="standort_neu.php" class=""><i class="lnr lnr-users"></i> <span>Standort hinzufügen</span></a></li>						
						<li><a href="Benutzer_Anlegen.php" class=""><i class="lnr lnr-user"></i> <span>Benutzer Anlegen</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Elterndaten</h3>                    						
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $vorname . " "; echo $nachname; ?></h3>
						</div>
						<div class="panel-body">
                        <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="row">
						        <div class="col-md-4">	
                                        <span>Nachname</span>
							            <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
										<span class="help-block"><?php echo (!empty($nachname_err)) ? $nachname_err : "<br>"; ?></span>
                                      
                                        <span>Mobiltelefon</span>
							            <input type="text" name="mobiltelefon" class="form-control" value="<?php echo $mobiltelefon; ?>">
										<span class="help-block"><?php echo (!empty($mobiltelefon_err)) ? $mobiltelefon_err : "<br>"; ?></span>
                                        
                                </div>
                                <div class="col-md-4">	
                                    <span>Vorname</span>
							        <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
									<span class="help-block"><?php echo (!empty($vorname_err)) ? $vorname_err : "<br>"; ?></span>
                                    
                                    <span>Privattelefon</span>
							        <input type="text" name="privattelefon" class="form-control" value="<?php echo $privattelefon; ?>">
                                    <span class="help-block"><?php echo (!empty($privattelefon_err)) ? $privattelefon_err : "<br>"; ?></span>                             
                                </div>
                                <div class="col-md-4">	                                                                       
                                    <span>E-Mail</span>
							        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
									<span class="help-block"><?php echo (!empty($email_err)) ? $email_err : "<br>"; ?></span>
                                    
                                    <span>Diensttelefon</span>
							        <input type="text" name="diensttelefon" class="form-control" value="<?php echo $diensttelefon; ?>">
									<span class="help-block"><?php echo (!empty($diensttelefon_err)) ? $diensttelefon_err : "<br>"; ?></span>
                                                                        
                                </div>
                            </div>
                            <br>
                            <div class="row">
						        <div class="col-md-6">
                                    <button type="submit" name="dbName" class="btn btn-primary btn-block" value="submit">Ändern</button>
                                 </div>
                                <div class="col-md-6">
                                    <button type="submit" name="delete" class="btn btn-primary btn-block" value="submit">Löschen</button>
                                </div>
                            </div>
                        </form>
						</div>
					</div>
					<!-- END INPUTS -->	
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 <a href="VP-IT.com" target="_blank">VP-IT</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
</body>
</html>