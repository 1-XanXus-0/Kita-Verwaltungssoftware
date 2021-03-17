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
						<li><a href="zahlungsdaten_edit.php" class=""><i class="fa fa-credit-card"></i> <span>Beitragsübersicht</span></a></li>	
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
			<p class="copyright">&copy; 2021 <a href="https://github.com/1-XanXus-0/Kita-Verwaltungssoftware" target="_blank">VP-IT</a>. All Rights Reserved.</p>
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