<?php

// Include logged in state check
require("assets/php/checkLogInState.php");

// Include config file
require_once "assets/php/config.php";
 
// Define variables and initialize with empty values
$nachname = $nachname_err = "";
$vorname = $vorname_err = "";
$geburtsname = $geburtsname_err = "";
$geburtsdatum = $geburtsdatum_err = "";
$geburtsort = $geburtsort_err = "";
$nationalität = $nationalität_err = "";
$konfession = $konfession_err = "";
$strasse = $strasse_err = "";
$hausnummer = $hausnummer_err = "";
$plz = $plz_err = "";
$ort = $ort_err = "";
$telefon = $telefon_err = "";
$telefon_Mobil = $telefon_Mobil = "";
$email = $email_err = "";
$einstelldatum = $einstelldatum_err = "";

// Variablendeklaration (Dropdowns)
$geschlecht = "";
$standort = "";
$familienstand = "";
$anrede = "";
$position = "";


// Variablendeklaration (optionale Felder)
$gruppe = "";

// Variable Names Array
$valueArr = array("nachname", "vorname", "geburtsname", "geburtsdatum", "geschlecht",
"geburtsort", "familienstand", "nationalität", "konfession", "anrede", "strasse", "hausnummer", "plz", "ort", "telefon",
"telefon_Mobil", "email", "einstelldatum", "position", "gruppe", "standort");
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	//Validate all required fields and assign variable parameter
	foreach($valueArr as $key => $var)
    {
		if(isset($_POST["$var"]))
		{
			if(empty(trim($_POST["$var"])) && $var != "geschlecht" && $var != "familienstand" && $var != "standort" 
                && $var != "anrede" && $var != "gruppe" && $var != "position"){
			${$var . "_err"} = "Bitte geben sie " . ucfirst($var) . " ein.";     
			} else{
				${"$var"} = trim($_POST["$var"]);
			}
		}	
    }
	if(empty($vorname_err) && empty($nachname_err) && empty($geburtsdatum_err) && empty($geburtsort_err) && empty($aufnahmedatum_err) 
	&& empty($konfession_err) && empty($Nationalität_err) && empty($strasse_err) && empty($hausnummer_err) 
	&& empty($plz_err) && empty($ort_err) && empty($telefon_err))   
    { 
        // Prepare an insert statement
        $sql = "INSERT INTO mitarbeiterdaten (MitarbeiterID , Nachname, Vorname, Geburtsname, Geburtsdatum, Geschlecht,
         Geburtsort, Familienstand, Nationalität, Konfession, Anrede, Strasse, Hausnummer, PLZ, Ort, Telefon,
         Telefon_Mobil, Email, Einstelldatum, Position, Gruppe, Standortdaten_StandortID)
        VALUES (default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    


         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssisssssssi", $param_nachname, $param_vorname,
             $param_geburtsname, $param_geburtsdatum, $param_geschlecht, $param_geburtsort, $param_familienstand,
              $param_nationalität, $param_konfession, $param_anrede, $param_strasse, $param_hausnummer,
               $param_plz, $param_ort, $param_telefon, $param_telefon_Mobil, $param_email, $param_einstelldatum,
                $param_position, $param_gruppe, $param_standort);
            
            // Set parameters
            $param_nachname = $nachname;
            $param_vorname = $vorname;
            $param_geburtsname = $geburtsname;
            $param_geburtsdatum = $geburtsdatum;
            $param_geburtsort = $geburtsort;
            $param_nationalität = $nationalität;
            $param_konfession = $konfession;
            $param_strasse = $strasse;
            $param_hausnummer = $hausnummer;
            $param_plz = $plz;
            $param_ort = $ort;
            $param_telefon = $telefon;
            $param_telefon_Mobil = $telefon_Mobil;
            $param_email = $email;
            $param_einstelldatum = $einstelldatum;
            $param_geschlecht = $geschlecht;
            $param_standort = $standort;
            $param_familienstand = $familienstand;
            $param_anrede = $anrede;
            $param_position = $position;
            $param_gruppe = $gruppe;

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
					<h3 class="page-title">Mitarbeiterdaten</h3>                    						
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Neuen Mitarbeiter anlegen</h3>
						</div>
						<div class="panel-body">
                        <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="row">
						        <div class="col-md-4">
                                    <span>Anrede</span>	
                                    <select class="form-control" name="anrede">
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>										
									</select>  
                                    <span class="help-block"><br></span> 
                                    
                                    <span>Geburtsname</span>
							        <input type="text" name="geburtsname" class="form-control" value="<?php echo $geburtsname; ?>">
									<span class="help-block"><?php echo (!empty($geburtsname_err)) ? $geburtsname_err : "<br>"; ?></span>                   
                                                                           
                                    <span>Geschlecht</span>
							        <select class="form-control" name="geschlecht">
										<option value="männlich">männlich</option>
										<option value="weiblich">weiblich</option>										
									</select>
									<span class="help-block"><br></span>

                                    <span>Konfession</span>
							        <input type="text" name="konfession" class="form-control" value="<?php echo $konfession; ?>">
									<span class="help-block"><?php echo (!empty($konfession_err)) ? $konfession_err : "<br>"; ?></span>                                     
                                                                           
                                </div>
                                <div class="col-md-4">	
                                    <span>Nachname</span>
							        <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
									<span class="help-block"><?php echo (!empty($nachname_err)) ? $nachname_err : "<br>"; ?></span>
                                    
                                    
                                    <span>Geburtsort</span>
							        <input type="text" name="geburtsort" class="form-control" value="<?php echo $geburtsort; ?>">
                                    <span class="help-block"><?php echo (!empty($geburtsort_err)) ? $geburtsort_err : "<br>"; ?></span>

                                    <span>Familienstand</span>
							        <select class="form-control" name="familienstand">
										<option value="Ledig">Ledig</option>
										<option value="Verheiratet">Verheiratet</option>		
                                        <option value="Geschieden">Geschieden</option>	
                                        <option value="Verwitwet">Verwitwet</option>									
									</select>  
                                    <span class="help-block"><br></span> 

                                    <span>Gruppe</span>
							        <input type="text" name="gruppe" class="form-control" value="<?php echo $gruppe; ?>">
                                    <span class="help-block"><br></span>                                                                        
                                                                    
                                </div>
                                <div class="col-md-4">	  
                                    <span>Vorname</span>
							        <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
									<span class="help-block"><?php echo (!empty($vorname_err)) ? $vorname_err : "<br>"; ?></span> 
                                    
                                    <span>Geburtsdatum</span>
							        <input type="text" name="geburtsdatum" class="form-control" value="<?php echo $geburtsdatum; ?>">
									<span class="help-block"><?php echo (!empty($geburtsdatum_err)) ? $geburtsdatum_err : "<br>"; ?></span>
                                                                        
                                    <span>Nationalität</span>
							        <input type="text" name="nationalität" class="form-control" value="<?php echo $nationalität; ?>">
									<span class="help-block"><?php echo (!empty($nationalität_err)) ? $nationalität_err : "<br>"; ?></span>
                                                                        
                                    <span>Position</span>
							        <select class="form-control" name="position">
										<option value="Management">Management</option>
										<option value="Erziehung">Erziehung</option>	
                                        <option value="Sonstige">Sonstige</option>										
									</select>  
                                    <span class="help-block"><br></span>   
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

                                    <span>Privattelefon</span>
							        <input type="text" name="telefon" class="form-control" value="<?php echo $telefon; ?>">
									<span class="help-block"><?php echo (!empty($telefon_err)) ? $telefon_err : "<br>"; ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span>Hausnummer</span>
                                    <input type="text" name="hausnummer" class="form-control" value="<?php echo $hausnummer; ?>">
									<span class="help-block"><?php echo (!empty($hausnummer_err)) ? $hausnummer_err : "<br>"; ?></span>

                                    <span>Ort</span>
							        <input type="text" name="ort" class="form-control" value="<?php echo $ort; ?>">
									<span class="help-block"><?php echo (!empty($ort_err)) ? $ort_err : "<br>"; ?></span>

                                    <span>Mobiltelefon</span>
							        <input type="text" name="telefon_Mobil" class="form-control" value="<?php echo $telefon_Mobil; ?>">
									<span class="help-block"><?php echo (!empty($telefon_Mobil_err)) ? $telefon_Mobil_err : "<br>"; ?></span>
                                </div>
                                <div class="col-md-4">

                                    <span>Standort</span>
                                    <select class="form-control" name="standort">
										<option value="1">testeinrichtung</option>
										<option value="2">testeinrichtung2</option>										
									</select>
									<span class="help-block"><br></span>

                                    <span>Einstelldatum</span>
                                    <input type="text" name="einstelldatum" class="form-control" value="<?php echo $einstelldatum; ?>">
									<span class="help-block"><?php echo (!empty($einstelldatum_err)) ? $einstelldatum_err : "<br>"; ?></span>
                                    
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