<?php

// Include logged in state check
require("assets/php/checkLogInState.php");

// Include config file
require_once "assets/php/config.php";
 
// Define variables (required fields)
$bezeichnung = $bezeichnung_err = "";
$strasse = $strasse_err = "";
$hausnummer = $hausnummer_err = "";
$plz = $plz_err = "";
$ort = $ort_err = "";
$telefonnummer = $telefonnummer_err = "";
$faxnummer = $faxnummer_err = "";
$leitung = $leitung_err = "";
$email = $email_err = "";
$bundesland = $bundesland_err = "";


// Variable Names Array
$valueArr = array("bezeichnung", "strasse", "hausnummer", "plz", "ort", "telefonnummer", "faxnummer", "leitung", "email", "bundesland");
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	//Validate all required fields and assign variable parameter
	foreach($valueArr as $key => $var)
    {
		if(isset($_POST["$var"]))
		{
			if(empty(trim($_POST["$var"]))){
			${$var . "_err"} = "Bitte geben sie " . ucfirst($var) . " ein.";     
			} else{
				${"$var"} = trim($_POST["$var"]);
			}
		}	
    }
	if(empty($vorname_err) && empty($nachname_err) && empty($mobiltelefon_err) && empty($privattelefon_err) && empty($email_err))
    { 
        // Prepare an insert statement
        $sql = "INSERT INTO standortdaten (StandortID , Bez_der_Tageseinrichtung, Strasse, Hausnummer, PLZ  , Ort  , Telefon,
         Faxnummer, Leitung, email, Bundesland)
        VALUES (default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssissssss", $param_bezeichnung, $param_strasse,
             $param_hausnummer, $param_plz, $param_ort, $param_telefonnummer, $param_faxnummer, $param_leitung, $param_email, $param_bundesland);
            
            // Set parameters
            $param_bezeichnung = $bezeichnung;
            $param_strasse = $strasse;
            $param_hausnummer = $hausnummer;;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_telefonnummer = $telefonnummer;
            $param_faxnummer = $faxnummer;
            $param_leitung = $leitung;
            $param_email = $email;
            $param_bundesland = $bundesland;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                //header("location: kind_neu_test.php");
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
				<a href="index.html"><img src="assets/img/logo_nav.png" alt="VP IT Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
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
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="kind_neu.php" class=""><i class="lnr lnr-users"></i> <span>Kind hinzufügen</span></a></li>
                        <li><a href="eltern_neu.php" class=""><i class="lnr lnr-users"></i> <span>Vormund hinzufügen</span></a></li>
						<li><a href="elements.html" class=""><i class="lnr lnr-code"></i> <span>Elements</span></a></li>
						<li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
						<li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Profile</a></li>
									<li><a href="page-login.php" class="">Login</a></li>
									<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
								</ul>
							</div>
						</li>
						<li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
						<li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
						<li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
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
					<h3 class="page-title">Standortdaten</h3>                    						
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Neuen Standort anlegen</h3>
						</div>
						<div class="panel-body">
                        <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="row">
                                <div class="col-md-4">	
                                        <span>Standortbezeichnung</span>
							            <input type="text" name="bezeichnung" class="form-control" value="<?php echo $bezeichnung; ?>">
										<span class="help-block"><?php echo (!empty($bezeichnung_err)) ? $bezeichnung_err : "<br>"; ?></span>
                                      
                                        <span>Strasse</span>
							            <input type="text" name="strasse" class="form-control" value="<?php echo $strasse; ?>">
										<span class="help-block"><?php echo (!empty($strasse_err)) ? $strasse_err : "<br>"; ?></span>
                                </div>
                                <div class="col-md-4">	
                                    <span>Leitung</span>
							        <input type="text" name="leitung" class="form-control" value="<?php echo $leitung; ?>">
									<span class="help-block"><?php echo (!empty($leitung_err)) ? $leitung_err : "<br>"; ?></span>
                   
                                    <span>Hausnummer</span>
							        <input type="text" name="hausnummer" class="form-control" value="<?php echo $hausnummer; ?>">
									<span class="help-block"><?php echo (!empty($hausnummer_err)) ? $hausnummer_err : "<br>"; ?></span>
                                        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">	
                                        <span>PLZ</span>
							            <input type="text" name="plz" class="form-control" value="<?php echo $plz; ?>">
										<span class="help-block"><?php echo (!empty($plz_err)) ? $plz_err : "<br>"; ?></span>
                                      
                                        <span>Telefonnummer</span>
							            <input type="text" name="telefonnummer" class="form-control" value="<?php echo $telefonnummer; ?>">
										<span class="help-block"><?php echo (!empty($telefonnummer_err)) ? $telefonnummer_err : "<br>"; ?></span>
                                    </div>
                                <div class="col-md-4">	
                                    <span>Ort</span>
							        <input type="text" name="ort" class="form-control" value="<?php echo $ort; ?>">
									<span class="help-block"><?php echo (!empty($ort_err)) ? $ort_err : "<br>"; ?></span>
                   
                                    <span>Faxnummer</span>
							        <input type="text" name="faxnummer" class="form-control" value="<?php echo $faxnummer; ?>">
									<span class="help-block"><?php echo (!empty($faxnummer_err)) ? $faxnummer_err : "<br>"; ?></span>
                                        
                                </div>
                                <div class="col-md-4">	
                                    <span>Bundesland</span>
							        <input type="text" name="bundesland" class="form-control" value="<?php echo $bundesland; ?>">
									<span class="help-block"><?php echo (!empty($bundesland_err)) ? $bundesland_err : "<br>"; ?></span>
                   
                                    <span>E-Mail</span>
							        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
									<span class="help-block"><?php echo (!empty($email_err)) ? $email_err : "<br>"; ?></span>
                                        
                                </div>
                            </div>
                            <br>
                            <button type="submit" name="dbName" class="btn btn-primary btn-block" value="submit">Neu Anlegen</button>
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