<?php

// Include logged in state check
require("assets/php/checkLogInState.php");
 
// Include config file
require_once "assets/php/config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tabellenName = $_POST['dbName'];
} else{
    $tabellenName = "Kinderdaten";
}


   

// Query to get columns from table
$query = $link->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'mydb' AND TABLE_NAME = '$tabellenName'");

//output variablen
$outputColNames = '';
$output = '<tr>';
$outputCheckBox = '';
$outputTextField = '';
$outputComboBox = "	<div class='col-md-12'>
						<span>Sortieren</span>
						<div class='row'>
							<div class='col-md-8'>
								<select class='form-control' name='list'>";

$checkedColArr = array();
$isChecked = 'checked';
$count = 0;
$whereStmt = '';
$sortStmt = '';

$filterValue1 = '';
$filterValue2 = '';
$selectedValue = '';

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');
  

// Check which Checkboxes are Checked
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(!empty($_POST['check_list'])){	
	// Loop to store values of individual checked checkbox.
	foreach($_POST['check_list'] as $selected) {
		array_push($checkedColArr, $selected);
		}
	}
	else{
		$checkedColArr = $columnArr;
	}
	
	if($tabellenName == "Standortdaten" && !empty($_POST["bezeichnung"]))
	{
		
		$whereStmt = "WHERE Bez_der_Tageseinrichtung = '" .$_POST["bezeichnung"] . "'";
		$filterValue1 = $_POST['bezeichnung'];
	}
	else if(!empty($_POST["vorname"]) && !empty($_POST["nachname"]))
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

	if(!empty($_POST["list"]))
	{
		if(!empty($_POST["radio"]))
		{
			if($_POST["radio"] == "DESC")
			{
				$sortStmt = "ORDER BY " .$_POST['list'] . " DESC"; 				
			} else {
				$sortStmt = "ORDER BY " .$_POST['list'] . " ASC";
			}
		} 
		else if(empty($_POST["radio"]))
		{
			$sortStmt = "ORDER BY " .$_POST['list'] . " ASC"; 	
		}
		
	}
		
		
}
else{
	$checkedColArr = $columnArr;
}

// Generating table header
$sql = "SELECT * FROM $tabellenName $whereStmt $sortStmt";
$result = mysqli_query($link, $sql);

foreach($checkedColArr as $key => $var)
{
    $outputColNames .= "<th>" .$var . "</th>";
}   

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        foreach($checkedColArr as $key => $var)
        {
            $output .= "<td>" . $row["$var"] . "</td>";
        }  
        $output .= "</tr>";
    }
} 

// Creating the Checkboxes
foreach($columnArr as $key => $var)
{
	if(in_array("$var", $checkedColArr) || empty($checkedColArr))
	{
		$isChecked = 'checked';
	}else{
		$isChecked = '';
	}		
	if($count == 6)
	{
		$outputCheckBox .= "</div>";
		$count = 0;
	}
	if($count == 0)
	{
		$outputCheckBox .= "<div class='row'>";
	}
	$count = $count + 1;
	$outputCheckBox .= "<div class='col-md-2'>
							<label class='fancy-checkbox'>
								<input type='checkbox' name='check_list[]' value='$var' $isChecked>
								<span>" .$var ."</span>
							</label>
						</div>";
}
if($count != 6 || $count != 0)
{
	$outputCheckBox .= "</div>";
}


// Creating searching fields
if($tabellenName == "Standortdaten")
{
	$outputTextField = "<div class='col-md-12'>
							<span>Standortbezeichnung</span>
							<input type='text' name='bezeichnung' class='form-control' value='$filterValue1'>
							<span class='help-block'><br></span>
						</div>";
}
else {
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
}

//Creating ComboBox for sorting

foreach($columnArr as $key => $var)
{
	if(!empty($_POST['list']))
	{
		if($var == $_POST["list"])
		{
			$selectedValue = "selected";
		}
		else {
			$selectedValue = "";
		}
	}
	$outputComboBox .= "<option value='$var' $selectedValue>$var</option>";
}
$outputComboBox .= "</select>
					</div>
					<div class='col-md-1'>
						<label class='fancy-radio'>
							<input name='radio' value='ASC' type='radio'>
							<span><i></i>ASC</span>
						</label>
					</div>
					<div class='col-md-1'>
						<label class='fancy-radio'>
							<input name='radio' value='DESC' type='radio'>
							<span><i></i>DESC</span>
						</label>
					</div>
					</div>
					<span class='help-block'><br></span>	
					</div>";

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
						<li><a href="tabellendaten_auflisten.php" class="active"><i class="lnr lnr-dice"></i> <span>Daten</span></a></li>
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
					<h3 class="page-title"><?php echo $tabellenName ?></h3>
					<!-- TABLE SELECTION -->
                    <form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <button type="submit" name="dbName" class="btn btn-primary btn-lg" value="Kinderdaten">Kinderdaten</button>
                        <button type="submit" name="dbName" class="btn btn-primary btn-lg" value="Elterndaten">Elterndaten</button>
                        <button type="submit" name="dbName" class="btn btn-primary btn-lg" value="Mitarbeiterdaten">Mitarbeiterdaten</button>
                        <button type="submit" name="dbName" class="btn btn-primary btn-lg" value="Standortdaten">Standortdaten</button>						
					</form>
					<div class="row">
						<!-- PANEL NO PADDING -->
						<div class='col-md-10'>
							<div class="panel">
								<div class="panel-heading">
									<h5 class="panel-title">Filter Optionen</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">								
									<div class="padding-top-10">
									<form class="form-auth-small" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
									<div class="row">
										<div class='col-md-10'>
											<?php echo $outputCheckBox; ?>
										</div>										
									</div>
									<div class="row">	
										<div class='col-md-10'>					
											<?php  echo $outputTextField; ?>
										</div>	
									</div>
									<div class="row">	
										<div class='col-md-10'>					
											<?php echo $outputComboBox; ?>
										</div>
									</div>
										
														
										<button type="submit" name="dbName" class="btn btn-primary btn-block" value="<?php echo $tabellenName; ?>">Filtern</button>
									
										
									</form>
									</div>								
								</div>
							</div>
						</div>
					</div>
							<!-- END PANEL NO PADDING -->
                    
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Auflistung</h3>
								</div>
								<div class="tabellen">
								<div class="panel-body">
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