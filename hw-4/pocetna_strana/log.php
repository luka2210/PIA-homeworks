<?php
    if (isset($_POST['posalji'])) {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];

        require_once 'dbh.php';
        require_once 'logreg_funkcije.php';

        uloguj_korisnika($conn, $korisnicko_ime, $lozinka);
    }
    else {
		header("location: login-registracija.php");
		exit();
    }
    
    function uloguj_korisnika($conn, $korisnicko_ime, $lozinka) {
        $nadjeno_ime = korisnicko_ime_postoji($conn, $korisnicko_ime);
        $nadjen_mail = e_mail_postoji($conn, $korisnicko_ime);
        $postoji = ($nadjeno_ime || $nadjen_mail);
        if ($postoji === false) {
            header("location: login-registracija.php?error=ne_postoji");
            exit();
        }

        if ($nadjeno_ime !== false)
            $nadjena_lozinka = $nadjeno_ime['lozinka'];
        else 
            $nadjena_lozinka = $nadjen_mail['lozinka'];
        $lozinke_se_poklapaju  = $lozinka == $nadjena_lozinka;
        if ($lozinke_se_poklapaju !== true) {
            header("location: login-registracija.php?error=pogresna_lozinka");
            exit();
        }
        echo "jeste";
    }
