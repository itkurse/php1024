-- DDL: Data Definition Language

CREATE DATABASE 20241028_abteilungpersonen;
USE 20241028_abteilungpersonen;

CREATE TABLE abteilung 
(
    id INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(320) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE person 
(
    id INT AUTO_INCREMENT,
    vorname VARCHAR(100) NOT NULL,
    nachname VARCHAR(100) NOT NULL,
    geburtsdatum DATE NOT NULL,
    gehalt DECIMAL(10, 2) NOT NULL,
    abteilung_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (abteilung_id) REFERENCES abteilung(id)
);

ALTER TABLE person 
ADD COLUMN date_removed TIMESTAMP NULL DEFAULT NULL;