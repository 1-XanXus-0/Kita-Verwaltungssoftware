# Kita-Verwaltungssoftware

Content Management System für KiTas.
Webinterface mit Datenbankanbindung zum auslesen und verändern von Daten.

* Pflege der Standortdaten
* Pflege der Kinderdaten
* Pflege der Mitarbeiterdaten               
* Pflege der Kinder-Gruppendaten            
* Durchführung einer Mitarbeiterplanung     
* Buchen der Mitarbeiterplanung             
* Auswerten der Mitarbeiterplanung          
* Listen Zahlungshistorie                   
* Listen Kinderdaten                        
* Maximale Kapazität 20 Gruppen, 30 Mitarbeiter, 10.000 Kinder und 20.000 Eltern/Vormunde.

## Getting Started

Diese Anweisungen helfen dir dabei das Projekt auf einem lokalen gerät lauffähig zu machen für Entwicklungs- und Testzwecken.

### Grundvoraussetzungen
* XAMPP oder änliches für das aufsetzten der Datenbank
* IDE deiner Wahl - wir haben VS Code benutzt

### Instalation
XAMPP öffnen und Apache + MySQL starten
Admin Bereich von PHPMyAdmin öffnen und Datenbank.sql ausführen damit die Datenbank erstellt wird.
In der Datenbank einen beliebigen benutzer erstellen.
auf page-login.php die 59. Zeile auskommentieren und die 60. wieder reinhollen.
Config.php Datei anpassen.
Nach dem erfolgreichen Einlogen einen neuen benutzer anlegen und die 59. Zeile wieder reinhollen und die 60. auskommentieren.
Dies geschieht um das neue benutzerpasswort mit einem HASH zu verschlüsseln. 

# Projekt noch in Arbeit



