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
    kor_ime varchar(100) NOT NULL,
    lozinka varchar(100) NOT NULL, 
    ime varchar(100) NOT NULL,
    prezime varchar(100) NOT NULL,
    e_mail varchar(100) NOT NULL,
    admin int(1) NOT NULL
);

*tabela filmovi*
CREATE TABLE filmovi( 
	id int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    naslov varchar(100) NOT NULL,
    kraci_opis varchar(1000) NOT NULL, 
    zanr varchar(100) NOT NULL,
    reziser varchar(100) NOT NULL,
    prod_kuca varchar(100) NOT NULL,
    glumci varchar(1000) NOT NULL,
    god_izdanja int(5) NOT NULL,
    slika varchar(100) NOT NULL,
    vreme_trajanja int(4) NOT NULL
);
INSERT INTO filmovi (naslov, kraci_opis, zanr, reziser, prod_kuca, glumci, god_izdanja, slika, vreme_trajanja) 
VALUES ("", "", "", "", "", "", 0, "../slike/.png", 0);

*/