<?php

// Include logged in state check
require("assets/php/checkLogInState.php");

// Include config file
require_once "assets/php/config.php";
 
// Define variables and initialize with empty values
$tabellenName = "Zahlungsdaten";
$outputTextField = "";


$month = '';
$id = '';
$toggle = '';	

$whereStmt = '';
$filterValue1 = '';
$filterValue2 = '';
            

// Prepare an insert statement
$query = $link->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'mydb' AND TABLE_NAME = '$tabellenName'");

//output variablen
$outputColNames = '';
$output = '<tr>';

// output data of each row
while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');
// array_shift($columnArr);


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

	//Creating the WHERE statement
	if(!empty($_POST["vorname"]) && !empty($_POST["nachname"]))
	{
		$whereStmt = "WHERE Vorname = '" .$_POST["vorname"] . "'AND Nachname =  '" . $_POST["nachname"] . "'";
		$filterValue1 = $_POST['vorname'];
		$filterValue2 = $_POST['nachname'];
	}
	else if(!empty($_POST["vorname"]))
	{
		$whereStmt = "WHERE Vorname = '" .$_POST["vorname"] . "'";
		$filterValue1 = $_POST['vorname'];
	}
	else if(!empty($_POST["nachname"]))
	{
		$whereStmt = "WHERE Nachname = '" .$_POST["nachname"] . "'";
		$filterValue2 = $_POST['nachname'];
	}
	//echo $whereStmt;
    
	// Button-Funktion
	if (isset($_POST["toggle"])) 
	{		

		$btnval = $_POST["toggle"];
		$btnvalue = explode (',', $btnval);
		$month = $btnvalue[0];
		$id = $btnvalue[1];
		$toggle = $btnvalue[2];

		if($toggle == "nicht bezahlt") 
		{
			$toggle = "bezahlt";
		} 
		else if ($toggle == "bezahlt") 
		{
			$toggle = "nicht bezahlt";
		}

		// Prepare an insert statement
        $sql = "UPDATE Zahlungsdaten SET $month = ? WHERE ZahlungsID = ?";
        if($stmt = mysqli_prepare($link, $sql))
		{
			
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si",  $param_toggle, $param_id);

			
			            // Set parameters						
						$param_id = $id;			
						$param_toggle = $toggle;

						            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				            
                header("location: zahlungsdaten_edit.php");
				exit();
            } else{
                echo "Etwas ist schief gelaufen.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
	
	}

    
}

// Generating table header
$sql = "SELECT * FROM zahlungsdaten $whereStmt";
$result = mysqli_query($link, $sql);
foreach($columnArr as $key => $var)

if( ($key !== 0)) {
    $outputColNames .= "<th>" .$var . "</th>";
}   

// output data of each row
while($row = mysqli_fetch_assoc($result)) {
	
	$valueDump = $row["$columnArr[0]"];

	foreach($columnArr as $key => $var)
	{
		if( ($key !== 0)) {
		if( ($key > 4) && ($key < 17) ) {
			if($row["$var"]=="bezahlt") {
				$output .= '<td><button type="submit" class="btn btn-success" name="toggle" value="' .$var .',' .$valueDump .',' .$row["$var"] . '">BEZAHLT</button></td>';
			} else if($row["$var"]=="nicht bezahlt") {
				$output .= '<td><button type="submit" class="btn btn-danger"  name="toggle"  value="' .$var .',' .$valueDump .',' .$row["$var"] . '">OFFEN</button></td>';
			} else {
			$output .= "<td>" . $row["$var"] . "</td>";
			}	
		} else {
			$output .= "<td>" . $row["$var"] . "</td>";
		}
		}

	}
    $output .= "</tr>";
}


// Creating searching fields
$outputTextField = "<div class='col-md-6'>
							<span>Vorname</span>
							<input type='text' name='vorname' class='form-control' value='$filterValue1'>
							<span class='help-block'><br></span>
						</div>
						<div class='col-md-6'>
							<span>Nachname</span>
							<input type='text' name='nachname' class='form-control' value='$filterValue2'>
							<span class='help-block'><br></span>
						</div>";

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
	<link rel="stylesheet" href="assets/css/table_data.css">
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
					<h3 class="page-title"><?php echo $tabellenName ?></h3>
					<div class="row">
						<!-- PANEL NO PADDING -->
						<div class='col-md-10'>
							<div class="panel">
								<div class="panel-heading">
									<h5 class="panel-title">Such Optionen</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">								
									<div class="padding-top-10">
									<form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
										<div class="row">	
											<div class='col-md-10'>					
												<?php  echo $outputTextField; ?>
											</div>	
										</div>				
										<button type="submit" name="dbName" class="btn btn-primary btn-block" value="<?php echo $tabellenName; ?>">Filtern</button>
									
									</form>
									</div>								
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                    
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Auflistung</h3>
								</div>
								<div class="tabellen">
								<div class="panel-body">
									<form class='form-auth-small' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='POST'>
										<table class="table table-hover">
											<thead>
												<tr>
													<?php echo $outputColNames;?>
												</tr>
											</thead>
											<tbody>
												<?php echo $output ?>
											</tbody>
										</table>
									</form>
								</div>
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