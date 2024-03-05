DROP DATABASE IF EXISTS Bricool;
CREATE DATABASE Bricool;
USE Bricool;

CREATE TABLE prestataire (
    idprestataire INT(10) NOT NULL AUTO_INCREMENT,
    image_prestataire VARCHAR(100),
    nomprestataire VARCHAR(100),
    adresse VARCHAR(100),
    numero_telephone VARCHAR(20),
    email VARCHAR(50),
    mdp VARCHAR(50),
    competences TEXT,
    experience TEXT,
    tarifs int(5),
    disponibilite TEXT,
    zone_couverture TEXT,
    evaluations TEXT,
    certifications TEXT,
    idservice INT(10) NOT NULL,
    PRIMARY KEY (idprestataire),
    FOREIGN KEY (idservice) REFERENCES services(idservice)
);




CREATE TABLE services (
    idservice INT(10) NOT NULL AUTO_INCREMENT,
    libelleservice VARCHAR(100),
    nom_image VARCHAR(255), 
    PRIMARY KEY (idservice)
);

CREATE TABLE prestations (
    idprestation INT(10) NOT NULL AUTO_INCREMENT,
    libelleprestation VARCHAR(100),
    idservice INT(10),
    PRIMARY KEY (idprestation),
    FOREIGN KEY (idservice) REFERENCES services(idservice)
);

CREATE TABLE client (
    idclient INT(3) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    PRIMARY KEY (idclient)
);

CREATE TABLE user (
    iduser INT(3) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(255),
    role ENUM('user', 'admin'),
    PRIMARY KEY (iduser)
);

CREATE TABLE reservation (
    idreservation INT(10) NOT NULL AUTO_INCREMENT,
    idclient INT(3) NOT NULL,
    idprestataire INT(10) NOT NULL,
    idprestation INT(10) NOT NULL,
    date_reservation DATE,
    heure_reservation TIME,
    nbr_heure INT(1),
    tarif_total FLOAT,
    etat ENUM('en_attente', 'confirme', 'annule'),
    commentaire TEXT,
    PRIMARY KEY (idreservation),
    FOREIGN KEY (idclient) REFERENCES client(idclient),
    FOREIGN KEY (idprestataire) REFERENCES prestataire(idprestataire),
    FOREIGN KEY (idprestation) REFERENCES prestations(idprestation)
);


INSERT INTO user VALUES 
    (null, 'Adam', 'Anes', 'a@gmail.com', '123', 'user'), 
    (null, 'Christina', 'Ibtissam', 'b@gmail.com', '456', 'admin');












