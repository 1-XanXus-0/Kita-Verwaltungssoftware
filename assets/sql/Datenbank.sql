
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Standortdaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Standortdaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Standortdaten` (
  `StandortID` INT NOT NULL AUTO_INCREMENT,
  `Bez. der Tageseinrichtung` VARCHAR(45) NULL,
  `Straße` VARCHAR(45) NULL,
  `Hausnummer` VARCHAR(10) NULL,
  `PLZ` INT NULL,
  `Wohnort` VARCHAR(80) NULL,
  `Telefon` VARCHAR(45) NULL,
  `Faxnummer` VARCHAR(45) NULL,
  `Leitung` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `Bundesland` VARCHAR(45) NULL,
  PRIMARY KEY (`StandortID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Kinderdaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Kinderdaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Kinderdaten` (
  `KindID` INT NOT NULL AUTO_INCREMENT,
  `Nachname` VARCHAR(45) NULL,
  `Vorname` VARCHAR(45) NULL,
  `Geschlecht` VARCHAR(10) NULL,
  `Geburtsdatum` VARCHAR(45) NULL,
  `Einschulung` VARCHAR(45) NULL,
  `Aufnahme` VARCHAR(45) NULL,
  `Gruppe` VARCHAR(45) NULL,
  `Geburtsort` VARCHAR(45) NULL,
  `Konfession` VARCHAR(45) NULL,
  `Nationalität` VARCHAR(45) NULL,
  `vorr.gesprochene sprache Deutsch` VARCHAR(10) NULL,
  `Strasse` VARCHAR(45) NULL,
  `Hausnummer` VARCHAR(45) NULL,
  `Telefon` VARCHAR(45) NULL,
  `PLZ` VARCHAR(45) NULL,
  `Ort` VARCHAR(45) NULL,
  `StandortID` INT NULL,
  `ElternID` INT NULL,
  `Standortdaten_StandortID` INT NOT NULL,
  PRIMARY KEY (`KindID`),
  INDEX `fk_Kinderdaten_Standortdaten1_idx` (`Standortdaten_StandortID` ASC) ,
  CONSTRAINT `fk_Kinderdaten_Standortdaten1`
    FOREIGN KEY (`Standortdaten_StandortID`)
    REFERENCES `mydb`.`Standortdaten` (`StandortID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Elterndaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Elterndaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Elterndaten` (
  `ElternID` INT NOT NULL AUTO_INCREMENT,
  `Nachname` VARCHAR(45) NULL,
  `Vorname` VARCHAR(45) NULL,
  `telefon Privat` VARCHAR(45) NULL,
  `Telefon Mobil` VARCHAR(45) NULL,
  `Telefon Dienst` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `KindID` INT NULL,
  PRIMARY KEY (`ElternID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Medizinische infos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Medizinische infos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Medizinische infos` (
  `Krankenkasse` VARCHAR(45) NOT NULL,
  `Kinderarzt` VARCHAR(45) NULL,
  `ärtzlcihe untersuchungen` VARCHAR(5) NULL,
  `Vorerkrankungen` VARCHAR(100) NULL,
  `behinderung` VARCHAR(5) NULL,
  `Durchgeführte Impfungen` VARCHAR(255) NULL,
  `Kinderdaten_KindID` INT NOT NULL,
  INDEX `fk_Medizinische infos_Kinderdaten1_idx` (`Kinderdaten_KindID` ASC) ,
  CONSTRAINT `fk_Medizinische infos_Kinderdaten1`
    FOREIGN KEY (`Kinderdaten_KindID`)
    REFERENCES `mydb`.`Kinderdaten` (`KindID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Mitarbeiterdaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Mitarbeiterdaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Mitarbeiterdaten` (
  `MitarbeiterID` INT NOT NULL AUTO_INCREMENT,
  `Nachname` VARCHAR(45) NULL,
  `Vorname` VARCHAR(45) NULL,
  `Geburtsname` VARCHAR(45) NULL,
  `Geburtsdatum` VARCHAR(45) NULL,
  `Geschlecht` VARCHAR(45) NULL,
  `Geburtsort` VARCHAR(45) NULL,
  `Familienstand` VARCHAR(45) NULL,
  `Nationalität` VARCHAR(45) NULL,
  `Konfession` VARCHAR(45) NULL,
  `Anrede` VARCHAR(45) NULL,
  `Strasse` VARCHAR(45) NULL,
  `Hausnummer` VARCHAR(45) NULL,
  `PLZ` INT NULL,
  `Ort` VARCHAR(45) NULL,
  `Telefon` VARCHAR(45) NULL,
  `Telefon Mobil` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Einstelldatum` VARCHAR(45) NULL,
  `Position` VARCHAR(45) NULL,
  `Gruppe` VARCHAR(45) NULL,
  `StandortID` INT NULL,
  `Standortdaten_StandortID` INT NOT NULL,
  PRIMARY KEY (`MitarbeiterID`),
  INDEX `fk_Mitarbeiterdaten_Standortdaten1_idx` (`Standortdaten_StandortID` ASC) ,
  CONSTRAINT `fk_Mitarbeiterdaten_Standortdaten1`
    FOREIGN KEY (`Standortdaten_StandortID`)
    REFERENCES `mydb`.`Standortdaten` (`StandortID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Gruppendaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Gruppendaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Gruppendaten` (
  `Gruppenname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Gruppenname`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Kinderdaten_has_Elterndaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Kinderdaten_has_Elterndaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Kinderdaten_has_Elterndaten` (
  `Kinderdaten_KindID` INT NOT NULL,
  `Elterndaten_ElternID` INT NOT NULL,
  PRIMARY KEY (`Kinderdaten_KindID`, `Elterndaten_ElternID`),
  INDEX `fk_Kinderdaten_has_Elterndaten_Elterndaten1_idx` (`Elterndaten_ElternID` ASC) ,
  INDEX `fk_Kinderdaten_has_Elterndaten_Kinderdaten_idx` (`Kinderdaten_KindID` ASC) ,
  CONSTRAINT `fk_Kinderdaten_has_Elterndaten_Kinderdaten`
    FOREIGN KEY (`Kinderdaten_KindID`)
    REFERENCES `mydb`.`Kinderdaten` (`KindID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kinderdaten_has_Elterndaten_Elterndaten1`
    FOREIGN KEY (`Elterndaten_ElternID`)
    REFERENCES `mydb`.`Elterndaten` (`ElternID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Kinderdaten_has_Gruppendaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Kinderdaten_has_Gruppendaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Kinderdaten_has_Gruppendaten` (
  `Kinderdaten_KindID` INT NOT NULL,
  `Gruppendaten_Gruppenname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Kinderdaten_KindID`, `Gruppendaten_Gruppenname`),
  INDEX `fk_Kinderdaten_has_Gruppendaten_Gruppendaten1_idx` (`Gruppendaten_Gruppenname` ASC) ,
  INDEX `fk_Kinderdaten_has_Gruppendaten_Kinderdaten1_idx` (`Kinderdaten_KindID` ASC) ,
  CONSTRAINT `fk_Kinderdaten_has_Gruppendaten_Kinderdaten1`
    FOREIGN KEY (`Kinderdaten_KindID`)
    REFERENCES `mydb`.`Kinderdaten` (`KindID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kinderdaten_has_Gruppendaten_Gruppendaten1`
    FOREIGN KEY (`Gruppendaten_Gruppenname`)
    REFERENCES `mydb`.`Gruppendaten` (`Gruppenname`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Gruppendaten_has_Mitarbeiterdaten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Gruppendaten_has_Mitarbeiterdaten` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Gruppendaten_has_Mitarbeiterdaten` (
  `Gruppendaten_Gruppenname` VARCHAR(45) NOT NULL,
  `Mitarbeiterdaten_MitarbeiterID` INT NOT NULL,
  PRIMARY KEY (`Gruppendaten_Gruppenname`, `Mitarbeiterdaten_MitarbeiterID`),
  INDEX `fk_Gruppendaten_has_Mitarbeiterdaten_Mitarbeiterdaten1_idx` (`Mitarbeiterdaten_MitarbeiterID` ASC) ,
  INDEX `fk_Gruppendaten_has_Mitarbeiterdaten_Gruppendaten1_idx` (`Gruppendaten_Gruppenname` ASC) ,
  CONSTRAINT `fk_Gruppendaten_has_Mitarbeiterdaten_Gruppendaten1`
    FOREIGN KEY (`Gruppendaten_Gruppenname`)
    REFERENCES `mydb`.`Gruppendaten` (`Gruppenname`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gruppendaten_has_Mitarbeiterdaten_Mitarbeiterdaten1`
    FOREIGN KEY (`Mitarbeiterdaten_MitarbeiterID`)
    REFERENCES `mydb`.`Mitarbeiterdaten` (`MitarbeiterID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Benutzer_Anmeldedaten`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Benutzer_Anmeldedaten` (
  `userID` INT NOT NULL AUTO_INCREMENT,
  `benutzername` VARCHAR(25) NULL,
  `passwort` VARCHAR(25) NULL,
  `user_geloescht` TINYINT NULL,
  `letzter_login` DATETIME NULL,
  PRIMARY KEY (`userID`))
ENGINE = InnoDB

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
