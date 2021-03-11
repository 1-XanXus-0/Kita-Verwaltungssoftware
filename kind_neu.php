<?php
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
$sex = "";
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

    v


    
    // Check input errors before inserting in database
    if(empty($vorname_err) && empty($nachname_err) && empty($geb_err) && empty($gebort_err) && empty($aufnahme_err) && empty($konfession_err) && empty($nationalität_err) && empty($deutsch_err) && empty($strasse) && empty($hausnr_err) && empty($plz_err) && empty($ort_err) && empty($tel_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO `mydb`.`Kinderdaten` (KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Herkunftsland, SprichtDeutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
                VALUES (default, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_Vorname = $vorname;
            $param_Nachname = $nachname;
            $param_Geschlecht = $sex;
            $param_Geburtsdatum = $geb;
            $param_Geburtsort = $gebort;
            $param_Aufnahme = $aufnahme;
            $param_Konfession = $konfession;
            $param_Nationalität = $nationalität;
            $param_SprichtDeutsch = $deutsch;
            $param_Strasse = $strasse;
            $param_Hausnr = $hausnr;
            $param_PLZ = $plz;
            $param_Ort = $ort;
            $param_Tel = $tel;
            $param_Einschulung = $einschulung;
            $param_Gruppe = $gruppe;
            $param_StandortID = $standort;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect
                echo "Kind erfolgreich in die Datenbank aufgenommen.";
                header("location: kind_main.php");
            } else{
                echo "Ein Fehler ist aufgetreten. Kind konnte nicht erstellt werden.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>  