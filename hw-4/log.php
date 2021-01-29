<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "baza_korisnici";

$conn =  mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ". mysqli_connect_error());
}

/*
*tabela korisnici*
CREATE TABLE korisnici( 
	id int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    kor_ime varchar(30) NOT NULL,
    lozinka varchar(20) NOT NULL, 
    ime varchar(30) NOT NULL,
    prezime varchar(30) NOT NULL,
    e_mail varchar(40) NOT NULL
);

*/