<?php  
    session_start();
    header("location: ../pocetna_strana/login-registracija.php");
    session_unset();
    exit();