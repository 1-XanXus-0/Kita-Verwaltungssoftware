<?php
// Login Check
require("assets/php/checkLogInState.php");
// SQL Server Konfiguration
require_once "assets/php/config.php";

// Variablendeklaration (Pflichtfelder)
$vorname = $vorname_err = "";
$nachname = $nachname_err = "";
$geb = $geb_err = "";
$gebort = $gebort_err = "";
$aufnahme = $aufnahme_err = ""; // default heutiges Datum statt Pflichtfeld?
$konfession = $konfession_err = "";
$nationalität = $nationalität_err = "";
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
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validations
    if(empty(trim($_POST["vorname"]))) {$vorname_err = "Bitte Vorname eingeben.";
    } elseif(strlen(trim($_POST["vorname"])) > 45) {$vorname_err = "Maximal 45 Zeichen";
    } else {$vorname = trim($_POST["vorname"]); }
    
    if(empty(trim($_POST["nachname"]))) {$nachname_err = "Bitte Nachname eingeben.";
    } elseif(strlen(trim($_POST["nachname"])) > 45) {$vorname_err = "Maximal 45 Zeichen";
    } else {$nachname = trim($_POST["nachname"]); }

    if(empty(trim($_POST["geb"]))) {$geb_err = "Bitte Geburtsdatum angeben.";
    } else {$geb = trim($_POST["geb"]); }

    if(empty(trim($_POST["gebort"]))) {$gebort_err = "Bitte Geburtsort eingeben.";
    } elseif(strlen(trim($_POST["gebort"])) > 45) {$vorname_err = "Maximal 45 Zeichen";
    } else {$gebort = trim($_POST["gebort"]); }

    if(empty(trim($_POST["aufnahme"]))) {$aufnahme_err = "Bitte Aufnahmedatum angeben.";
    } else {$aufnahme = trim($_POST["aufnahme"]); }

    // if(empty(trim($_POST["einschulung"]))) {$gebort_err = "Bitte voraussichtliches Einschulumgsdatum angeben.";
    // } elseif(strlen(trim($_POST["einschulung"])) > 45) {$vorname_err = "Maximal 45 Zeichen";
    // } else {$gebort = trim($_POST["einschulung"]); }

        // if(empty(trim($_POST["einschulung"]))) {$aufnahme = "DATEETIMW.Eetzt()";
    // } elseif(strlen(trim($_POST["einschulung"])) > 45z) {$aufname_err = "Maximal 45 Zeichen";
    // } else {$gebort = trim($_POST["einschulung"]); }

    if(empty(trim($_POST["nationalität"]))) {$konfession_err = "Bitte Staatsbürgeschaft einngeben.";
    } elseif(strlen(trim($_POST["nationalität"])) > 5) {$vorname_err = "Maximal 45 Zeichen";
    } else {$vorname = trim($_POST["nationalität"]); }

    if(empty(trim($_POST["konfession"]))) {$konfession_err = "Bitte Konfession eingeben.";
    } elseif(strlen(trim($_POST["konfession"])) > 5) {$vorname_err = "Maximal 45 Zeichen";
    } else {$vorname = trim($_POST["konfession"]); }

    if(empty(trim($_POST["strasse"]))) {$strasse_err = "Bitte Strassennamen eingeben.";
    } elseif(strlen(trim($_POST["strasse"])) > 5) {$strasse_err = "Maximal 45 Zeichen";
    } else {$vorname = trim($_POST["strasse"]); }

    if(empty(trim($_POST["hausnr"]))) {$hausnr_err = "Bitte Hausnummr eingeben.";
    } elseif(strlen(trim($_POST["hausnr"])) > 5) {$hausnr_err = "Maximal 45 Zeichen";
    } else {$vorname = trim($_POST["hausnr"]); }

    if(empty(trim($_POST["plz"]))) {$plz_err = "Bitte PLZ eingeben.";
    } elseif(strlen(trim($_POST["plz"])) > 45) {$plz = "Maximal 5 Zeichen";
    } else {$gebort = trim($_POST["plz"]); }

    if(empty(trim($_POST["ort"]))) {$ort_err = "Bitte Wohnort eingeben.";
    } elseif(strlen(trim($_POST["ort"])) > 45) {$ort = "Maximal 45 Zeichen";
    } else {$gebort = trim($_POST["ort"]); }
}

    // Check input errors before inserting in database
    if(empty($vorname_err) && empty($nachname_err) && empty($geb_err) && empty($gebort_err) && empty($aufnahme_err) && empty($konfession_err) && empty($nationalität_err) && empty($deutsch_err) && empty($strasse) && empty($hausnr_err) && empty($plz_err) && empty($ort_err) && empty($tel_err))
    
    {    
        // Prepare an insert statement
        $sql = "INSERT INTO `mydb`.`Kinderdaten` (KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Herkunftsland, SprichtDeutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
                VALUES (default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssi", $param_vorname, $param_nachname, $param_geschlecht, $param_geb, $param_einschulung, $param_aufnahme, $param_gruppe, $param_gebort, $param_konfession, $param_nationalität, $param_deutsch, $param_strasse, $param_hausnr, $param_tel, $param_plz, $param_ort, $param_standort)
            
            // Set parameters
            $param_vorname = $vorname;
            $param_nachname = $nachname;
            $param_geschlecht = $geschlecht;
            $param_geburtsdatum = $geb;
            $param_geburtsort = $gebort;
            $param_aufnahme = $aufnahme;
            $param_konfession = $konfession;
            $param_nationalität = $nationalität;
            $param_sprichtDeutsch = $deutsch;
            $param_strasse = $strasse;
            $param_hausnr = $hausnr;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_tel = $tel;
            $param_einschulung = $einschulung;
            $param_gruppe = $gruppe;
            $param_standortID = $standort;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect
                echo "Kind erfolgreich in die Datenbank aufgenommen.";
                header("location: kind_main.php");
            } else {
                echo "Ein Fehler ist aufgetreten. Kind konnte nicht erstellt werden.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);

?>


<!doctype html>
<html lang="en">

<head>
	<title>Tables | Klorofil - Free Bootstrap Dashboard Template</title>
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
				<a href="index.php"><img src="assets/img/logo_nav.PNG" alt="VP-IT Logo" class="img-responsive logo"></a>
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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span><?php echo $username ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="pw-reset.php"><i class="lnr lnr-cog"></i> <span>PW Ändern</span></a></li>
								<li><a href="assets/php/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
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
						<li><a href="tabellendaten_auflisten.php" class="active"><i class="lnr lnr-dice"></i> <span>Kinderdaten</span></a></li>
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
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Neues Kind anlegen</h3>
								</div>
								<div class="form">
                  <form class="form-validate form-horizontal " id="register_form" method="get" action="">
                    <div class="form-group ">
                      <label for="vorname" class="control-label col-lg-2">Vorname<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="vorname" name="vorname" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="nachname" class="control-label col-lg-2">Nachname<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="nachname" name="nachname" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">Besitzt Penis<span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                        <input type="checkbox" style="width: 20px" class="checkbox form-control" id="geschlecht" name="geschlecht" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="address" class="control-label col-lg-2">Geburtsdatum<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="geb" name="geb" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="username" class="control-label col-lg-2">Geburtsort<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="gebort" name="gebort" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="confirm_password" class="control-label col-lg-2">Konfession<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="konfession" name="konfession" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Staatsbürgerschaft<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="nationaität" name="nationalität" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">Vorrangig gesprochene Sprache Deutsch?<span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                        <input type="checkbox" style="width: 20px" class="checkbox form-control" id="deutsch" name="deutsch" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Straße<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="strasse" name="strasse" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Hausnummer<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="hausnr" name="hausnr" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">PLZ<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="plz" name="plz" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Ort<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="ort" name="ort" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="email" class="control-label col-lg-2">Telefon<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="tel" name="tel" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="password" class="control-label col-lg-2">Aufnahmedatum<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="aufnahme" name="aufnahme" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="password" class="control-label col-lg-2">Voraussichtliches Einschulungsdatum<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="einschulung" name="einschulung" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="password" class="control-label col-lg-2">Gruppenname<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="gruppe" name="gruppe" type="text" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our Policy <span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                        <input type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit">Speichern</button>
                        <button class="btn btn-default" type="button">Abbrechen</button>
                      </div>
                    </div>
                  </form>
                </div>
							</div>
							<!-- END TABLE HOVER -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
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