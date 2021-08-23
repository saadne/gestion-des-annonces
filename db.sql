CREATE DATABASE gestion_annoces;
USE gestion_annoces;
CREATE TABLE  personne (
    numero_personne INT PRIMARY KEY,
    nom VARCHAR(40),
    prenom VARCHAR(40),
    tel INT,
    email VARCHAR(40),
    adress VARCHAR(40)
);

CREATE TABLE annoce(
    numero_annoce INT  PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(40),
    description TEXT,
    prix FLOAT,
    image_annonce VARCHAR(255),
    deposer_par INT,
    FOREIGN KEY(deposer_par) REFERENCES personne(numero_personne) ON DELETE SET NULL
);

CREATE TABLE users(
    id = INT PRIMARY KEY AUTO_INCREMENT,
    username = VARCHAR(50),
    passcode = VARCHAR(50)
)