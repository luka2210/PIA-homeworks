<?php
    session_start();
    if (isset($_SESSION['id'])) {
        echo $_SESSION['id'];
    }
    else {
        header("location: ../pocetna_strana/login-registracija.php");
        session_unset();
        exit();
    }
