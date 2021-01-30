<?php
$server = "localhost";
$db_korisnik = "root";
$db_lozinka = "";
$db_ime = "baza_korisnici";

$conn =  mysqli_connect($server, $db_korisnik, $db_lozinka, $db_ime);

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