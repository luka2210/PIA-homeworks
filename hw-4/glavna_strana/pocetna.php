<?php
    session_start();
    if (isset($_SESSION['id']) && isset($_SESSION['admin'])) {
        $admin = (int)$_SESSION['admin'];
        if ($admin === 1)
            header("location: admin.php");
        else if ($admin === 0)
            header("location: korisnik.php");
        exit();
    }
    else {
        header("location: ../pocetna_strana/login-registracija.php");
        session_unset();
        exit();
    }