<?php

// Include logged in state check
require("assets/php/checkLogInState.php");

// Include config file
require_once "assets/php/config.php";
 
// Define variables and initialize with empty values
$vorname = $vorname_err = "";
$nachname = $nachname_err = "";
$geb = $geb_err = "";
$gebort = $gebort_err = "";
$aufnahme = $aufnahme_err = ""; // default heutiges Datum statt Pflichtfeld?
$konfession = $konfession_err = "";
$herkunft = $herkunft_err = "";
$strasse = $strasse_err = "";
$hausnr = $hausnr_err = "";
$plz = $plz_err = "";
$ort = $ort_err = "";
$tel = $tel_err = "";

// Variablendeklaration (Dropdowns)
$geschlecht = "";
$standort = "";
$deutsch = "";

// Variablendeklaration (optionale Felder)
$einschulung = "";
$gruppe = "";

// Variable Names Array
$valueArr = array("vorname", "nachname", "geschlecht", "geb", "gebort", "aufnahme", "konfesstion",
    "herkunft", "deutsch", "strasse", "hausnr", "plz", "ort", "tel", "einschulung", "gruppe", "standort");
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	//Validate all required fields and assign variable parameter
	foreach($valueArr as $key => $var)
    {
		if(isset($_POST["$var"]))
		{
			if(empty(trim($_POST["$var"])) && $var != "geschlecht" && $var != "deutsch" && $var != "standort" && $var != "einschulung" && $var != "gruppe"){
			${$var . "_err"} = "Bitte geben sie $var ein.";     
			} else{
				${"$var"} = trim($_POST["$var"]);
			}
		}	
    }
	if(empty($vorname_err) && empty($nachname_err) && empty($geb_err) && empty($gebort_err) && empty($aufnahme_err) 
	&& empty($konfession_err) && empty($herkunft_err) && empty($strasse_err) && empty($hausnr_err) 
	&& empty($plz_err) && empty($ort_err) && empty($tel_err))   
    { 
        // Prepare an insert statement
        $sql = "INSERT INTO kinderdaten (KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung,
         Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch,
          Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
        VALUES (default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    


         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssssi", $param_vorname, $param_nachname,
             $param_geschlecht, $param_geb, $param_einschulung, $param_aufnahme, $param_gruppe,
              $param_gebort, $param_konfession, $param_herkunft, $param_deutsch, $param_strasse,
               $param_hausnr, $param_tel, $param_plz, $param_ort, $param_standort);
            
            // Set parameters
            $param_vorname = $vorname;
            $param_nachname = $nachname;
            $param_geschlecht = $geschlecht;
            $param_geb = $geb;
            $param_gebort = $gebort;
            $param_aufnahme = $aufnahme;
            $param_konfession = $konfession;
            $param_herkunft = $herkunft;
            $param_deutsch = $deutsch;
            $param_strasse = $strasse;
            $param_hausnr = $hausnr;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_tel = $tel;
            $param_einschulung = $einschulung;
            $param_gruppe = $gruppe;
            $param_standort = $standort;
            
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
	<title>Kind Neu Anlegen</title>
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
				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-success update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
				</div>
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
					<h3 class="page-title">Kinderdaten</h3>                    						
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Neues Kind anlegen</h3>
						</div>
						<div class="panel-body">
                        <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="row">
						        <div class="col-md-4">	
                                        <span>Nachname</span>
							            <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
										<span class="help-block"><?php echo (!empty($nachname_err)) ? $nachname_err : "<br>"; ?></span>
                                      
                                        <span>Geburtsdatum</span>
							            <input type="text" id="geb" class="form-control" value="<?php echo $geb; ?>">
										<span class="help-block"><?php echo (!empty($geb_err)) ? $geb_err : "<br>"; ?></span>
                                        
                                        <span>Geburtsort</span>
							            <input type="text" name="gebort" class="form-control" value="<?php echo $gebort; ?>">
										<span class="help-block"><?php echo (!empty($gebort_err)) ? $gebort_err : "<br>"; ?></span>
                                        
                                        <span>Gruppe</span>
							            <input type="text" name="gruppe" class="form-control" value="<?php echo $gruppe; ?>">
                                        <span class="help-block"><br></span>
                                        
                                </div>
                                <div class="col-md-4">	
                                    <span>Vorname</span>
							        <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
									<span class="help-block"><?php echo (!empty($vorname_err)) ? $vorname_err : "<br>"; ?></span>
                                    
                                    <span>Einschulung</span>
							        <input type="text" name="einschulung" class="form-control" value="<?php echo $einschulung; ?>">
                                    <span class="help-block"><br></span>

                                    <span>Konfession</span>
							        <input type="text" name="konfession" class="form-control" value="<?php echo $konfession; ?>">
									<span class="help-block"><?php echo (!empty($konfession_err)) ? $konfession_err : "<br>"; ?></span>
                                    
                                    <span>Primäre Sprache Deutsch</span>
							        <select class="form-control" name="deutsch">
										<option value="Ja">Ja</option>
										<option value="Nein">Nein</option>										
									</select>  
                                    <span class="help-block"><br></span>                                   
                                </div>
                                <div class="col-md-4">	
                                    <span>Geschlecht</span>
							        <select class="form-control" name="geschlecht">
										<option value="männlich">männlich</option>
										<option value="weiblich">weiblich</option>										
									</select>
									<span class="help-block"><br></span>
                                    
                                    <span>Aufnahme</span>
							        <input type="text" name="aufnahme" class="form-control" value="<?php echo $aufnahme; ?>">
									<span class="help-block"><?php echo (!empty($aufnahme_err)) ? $aufnahme_err : "<br>"; ?></span>
                                    
                                    <span>Nationalität</span>
							        <input type="text" name="herkunft" class="form-control" value="<?php echo $herkunft; ?>">
									<span class="help-block"><?php echo (!empty($herkunft_err)) ? $herkunft_err : "<br>"; ?></span>
                                                                        
                                </div>
                            </div>
                            <div class="row">
						        <div class="col-md-4">
                                    <span>Straße</span>
							        <input type="text" name="strasse" class="form-control" value="<?php echo $strasse; ?>">
									<span class="help-block"><?php echo (!empty($strasse_err)) ? $strasse_err : "<br>"; ?></span>
                                   
                                    <span>PLZ</span>
							        <input type="text" name="plz" class="form-control" value="<?php echo $plz; ?>">
									<span class="help-block"><?php echo (!empty($plz_err)) ? $plz_err : "<br>"; ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span>Hausnummer</span>
                                    <input type="text" name="hausnr" class="form-control" value="<?php echo $hausnr; ?>">
									<span class="help-block"><?php echo (!empty($hausnr_err)) ? $hausnr_err : "<br>"; ?></span>

                                    <span>Ort</span>
							        <input type="text" name="ort" class="form-control" value="<?php echo $ort; ?>">
									<span class="help-block"><?php echo (!empty($ort_err)) ? $ort_err : "<br>"; ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span>Telefon</span>
                                    <input type="text" name="tel" class="form-control" value="<?php echo $tel; ?>">
									<span class="help-block"><?php echo (!empty($tel_err)) ? $tel_err : "<br>"; ?></span>

                                    <span>Standort</span>
                                    <select class="form-control" name="standort">
										<option value="1">testeinrichtung</option>
										<option value="2">testeinrichtung2</option>										
									</select>
									<span class="help-block"><br></span>
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