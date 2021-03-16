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

if(isset($_COOKIE["tabellenName"]))
{
	$tabellenName = $_COOKIE['tabellenName'];
	$tabellenID = $_COOKIE['tabellenID'];
}


 // Prepare an insert statement
$sql = "SELECT * FROM $tabellenName WHERE MitarbeiterID = '$tabellenID'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
	{
		$vorname = $row["Vorname"];
		$nachname = $row["Nachname"];
		$geschlecht  = $row["Geschlecht"];
		$geburtsdatum = $row["Geburtsdatum"];
		$gruppe = $row["Gruppe"];
		$geburtsort = $row["Geburtsort"];
		$konfession = $row["Konfession"];
		$nationalität = $row["Nationalität"];
		$strasse = $row["Strasse"];
		$hausnummer = $row["Hausnummer"];
		$telefon = $row["Telefon"];
		$plz = $row["PLZ"];
		$ort = $row["Ort"];
        $geburtsname = $row["Geburtsname"];
        $telefon_Mobil = $row["Telefon_Mobil"];
        $email = $row["Email"];
        $einstelldatum = $row["Einstelldatum"];
        $familienstand = $row["Familienstand"];
        $anrede = $row["Anrede"];
        $position = $row["Position"];
		$standort = $row["Standortdaten_StandortID"];
	}
} 

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
        $sql = "UPDATE mitarbeiterdaten SET Nachname = ?, Vorname = ?, Geburtsname = ?, Geburtsdatum = ?, Geschlecht = ?,
         Geburtsort = ?, Familienstand = ?, Nationalität = ?, Konfession = ?, Anrede = ?, Strasse = ?, Hausnummer = ?, PLZ = ?, Ort = ?, Telefon = ?,
         Telefon_Mobil = ?, Email = ?, Einstelldatum = ?, Position = ?, Gruppe = ?, Standortdaten_StandortID = ? WHERE MitarbeiterID = ?";

    


         
        if($stmt = mysqli_prepare($link, $sql) && isset($_POST["dbName"])){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssisssssssii", $param_nachname, $param_vorname,
             $param_geburtsname, $param_geburtsdatum, $param_geschlecht, $param_geburtsort, $param_familienstand,
              $param_nationalität, $param_konfession, $param_anrede, $param_strasse, $param_hausnummer,
               $param_plz, $param_ort, $param_telefon, $param_telefon_Mobil, $param_email, $param_einstelldatum,
                $param_position, $param_gruppe, $param_standort, $param_MitarbeiterID);
            
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
            $param_MitarbeiterID = $tabellenID;

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
        $sql = "DELETE FROM $tabellenName WHERE MitarbeiterID = '$tabellenID'";

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
					<h3 class="page-title">Mitarbeiterdaten</h3>                    						
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $vorname . " "; echo $nachname; ?></h3>
						</div>
						<div class="panel-body">
                        <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="row">
						        <div class="col-md-4">
                                    <span>Anrede</span>	
                                    <select class="form-control" name="anrede">
										<option value="Herr" <?php  if($anrede == "ja") echo "selected"; else echo ""; ?>>Herr</option>
										<option value="Frau" <?php  if($anrede == "ja") echo "selected"; else echo ""; ?>>Frau</option>										
									</select>  
                                    <span class="help-block"><br></span> 
                                    
                                    <span>Geburtsname</span>
							        <input type="text" name="geburtsname" class="form-control" value="<?php echo $geburtsname; ?>">
									<span class="help-block"><?php echo (!empty($geburtsname_err)) ? $geburtsname_err : "<br>"; ?></span>                   
                                                                           
                                    <span>Geschlecht</span>
							        <select class="form-control" name="geschlecht">
										<option value="männlich" <?php  if($geschlecht == "M" || $geschlecht == "mänlich") echo "selected"; else echo ""; ?>>männlich</option>
										<option value="weiblich" <?php  if($geschlecht == "W" || $geschlecht == "weiblich") echo "selected"; else echo ""; ?>>weiblich</option>										
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
										<option value="Ledig" <?php  if($familienstand == "ja") echo "selected"; else echo ""; ?>>Ledig</option>
										<option value="Verheiratet" <?php  if($familienstand == "ja") echo "selected"; else echo ""; ?>>Verheiratet</option>		
                                        <option value="Geschieden" <?php  if($familienstand == "ja") echo "selected"; else echo ""; ?>>Geschieden</option>	
                                        <option value="Verwitwet" <?php  if($familienstand == "ja") echo "selected"; else echo ""; ?>>Verwitwet</option>									
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
										<option value="Management" <?php  if($position == "ja") echo "selected"; else echo ""; ?>>Management</option>
										<option value="Erziehung" <?php  if($position == "ja") echo "selected"; else echo ""; ?>>Erziehung</option>	
                                        <option value="Sonstige" <?php  if($position == "ja") echo "selected"; else echo ""; ?>>Sonstige</option>										
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
										<option value="1" <?php  if($standort == "ja") echo "selected"; else echo ""; ?>>testeinrichtung</option>
										<option value="2" <?php  if($standort == "ja") echo "selected"; else echo ""; ?>>testeinrichtung2</option>										
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