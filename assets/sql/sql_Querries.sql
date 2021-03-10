INSERT INTO `mydb`.`Standortdaten` (`StandortID`, `Bez. der Tageseinrichtung`, `Straße`, `Hausnummer`, `PLZ`, `Wohnort`, `Telefon`, `Faxnummer`, `Leitung`, `email`, `Bundesland`)
 VALUES (, 'testeinrichtung', 'musterstraße10', '1', 12342, 'musterstadt', '1234/12345', '1234/12345-2', 'Musterfrau', 'musterfrau@gmail.com', 'BaWü');
INSERT INTO `mydb`.`Standortdaten` (`StandortID`, `Bez. der Tageseinrichtung`, `Straße`, `Hausnummer`, `PLZ`, `Wohnort`, `Telefon`, `Faxnummer`, `Leitung`, `email`, `Bundesland`)
 VALUES (DEFAULT, 'testeinrichtung2', 'musterstraße', '20', 122509, 'musterstadt2', '2345/2345', '2358/2358-1', 'Mustermann', 'mustermann@gmail.com', 'NRW');

INSERT INTO `mydb`.`Kinderdaten` (`KindID`, `Nachname`, `Vorname`, `Geschlecht`, `Geburtsdatum`, `Einschulung`, `Aufnahme`, `Gruppe`, `Geburtsort`,
 `Konfession`, `Nationalität`, `vorrgesprochene_sprache_Deutsch`, `Strasse`, `Hausnummer`, `Telefon`, `PLZ`, `Ort`, `Standortdaten_StandortID`)
 VALUES (1, 'Neumann', 'Silvia', 'W', '6/6/14', '9/27/21', '7/1/17', 'rot', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Silviastrasse', '1', '0711/123456', '73728', 'Esslingen', 1);

/* INSERT QUERY NO: 1 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
default, 'Neumann', 'Silvia', 'W', '6/6/14', '9/27/21', '7/1/17', 'rot', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Silviastrasse', 1, '0711/123456', 73728, 'Esslingen', 1
);

/* INSERT QUERY NO: 2 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
default, 'Neumann', 'Peter', 'M', '6/6/14', '9/27/21', '7/1/17', 'rot', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Silviastrasse', 1, '0711/123456', 73728, 'Esslingen', 1
);

/* INSERT QUERY NO: 3 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
default, 'Schmidt', 'Markus', 'M', '9/8/15', '9/27/21', '7/1/17', 'blau', 'Esslingen', 'kath', 'Deutsch', 'ja', 'Neckarstr', 28, '0711/123456', 73728, 'Esslingen', 1
);

/* INSERT QUERY NO: 4 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
default, 'Müller', 'Hans', 'M', '2/3/15', '9/27/21', '7/1/17', 'gelb', 'Stuttgart', 'ev', 'Deutsch', 'ja', 'Beispielstr', 2, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 5 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Hrubesch', 'Horst', 'M', '10/5/14', '9/27/21', '7/1/17', 'grün', 'Esslingen', 'keine', 'Deutsch', 'ja', 'Beispielstr', 3, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 6 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Marschall', 'Chris', 'M', '1/2/13', '9/27/21', '7/1/17', 'gelb', 'Stuttgart', 'ev', 'Deutsch', 'ja', 'Beispielstr', 4, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 7 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Marek', 'Toni', 'M', '9/15/14', '9/27/21', '7/1/17', 'blau', 'Esslingen', 'ev', 'Italienisch', 'ja', 'Beispielstr', 5, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 8 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Weimer', 'Lara', 'W', '8/4/00', '9/27/21', '7/1/17', 'rot', 'Stuttgart', 'is', 'Deutsch', 'ja', 'Beispielstr', 6, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 9 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Lustig', 'Laura', 'W', '2/24/16', '9/27/21', '7/1/17', 'gelb', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Beispielstr', 7, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 10 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Seifert', 'Sandra', 'W', '10/3/15', '9/27/21', '7/1/17', 'rot', 'Stuttgart', 'ev', 'Deutsch', 'ja', 'Beispielstr', 8, '0711/123456', 70174, 'Stuttgart', 1
);

/* INSERT QUERY NO: 11 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Kilicci', 'Galip', 'M', '3/8/20', '9/27/21', '7/1/17', 'rot', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Beispielstr', 9, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 12 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Gesierich', 'Sven', 'M', '6/15/20', '9/27/21', '7/1/17', 'blau', 'Stuttgart', 'ev', 'Türkisch', 'nein', 'Beispielstr', 10, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 13 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Wagner', 'Harald', 'M', '5/5/14', '9/27/21', '7/1/17', 'blau', 'Esslingen', 'is', 'Deutsch', 'ja', 'Beispielstr', 11, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 14 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Kingsley', 'Jero', 'W', '11/23/02', '9/27/21', '7/1/17', 'gelb', 'Stuttgart', 'ev', 'Indisch', 'ja', 'Beispielstr', 12, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 15 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Mantas', 'Dimitrios', 'M', '8/24/15', '9/27/21', '7/1/17', 'grün ', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Beispielstr', 13, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 16 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Sinikoska', 'Kristina', 'W', '6/6/06', '9/27/21', '7/1/17', 'grün ', 'Stuttgart', 'ev', 'Deutsch', 'ja', 'Beispielstr', 14, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 17 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Chennai', 'Kuma', 'W', '5/8/18', '9/27/21', '7/1/17', 'grün', 'Esslingen', 'kath', 'Indisch', 'nein', 'Beispielstr', 15, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 18 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Sivan', 'Shirley', 'W', '3/19/17', '9/27/21', '7/1/17', 'blau', 'Stuttgart', 'ev', 'Israelisch', 'nein', 'Beispielstr', 16, '0711/123456', 70174, 'Stuttgart', 2
);

/* INSERT QUERY NO: 19 */
INSERT INTO `mydb`.`Kinderdaten`(KindID, Nachname, Vorname, Geschlecht, Geburtsdatum, Einschulung, Aufnahme, Gruppe, Geburtsort, Konfession, Nationalität, vorrgesprochene_sprache_Deutsch, Strasse, Hausnummer, Telefon, PLZ, Ort, Standortdaten_StandortID)
VALUES
(
  default, 'Black', 'Mister', 'M', '12/11/15', '9/27/21', '7/1/17', 'gelb', 'Esslingen', 'ev', 'Deutsch', 'ja', 'Beispielstr', 17, '0711/123456', 70174, 'Stuttgart', 2
);
