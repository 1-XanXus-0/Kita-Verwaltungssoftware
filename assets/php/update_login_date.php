<?php

// Update last login date
$sql_update = "UPDATE Benutzer_Anmeldedaten SET letzter_login = NOW() WHERE userID = ?";
        
if($stmt = mysqli_prepare($link, $sql_update)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "s", $param_id);

// Set parameters
$param_id = $_SESSION["userID"];

// Attempt to execute the prepared statement
mysqli_stmt_execute($stmt)
?>