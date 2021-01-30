<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        require_once "../pocetna_strana/dbh.php";

        if (vrsta_korisnika($conn, $id) === 0) {
            header('location: korisnik.php');
            exit();
        }
        else if (vrsta_korisnika($conn, $id) === 1) {
            header('location: admin.php');
            exit();
        }
        session_unset();
        header("location: login-registracija.php?error=stmt_fail");
        exit();
    }
    else {
        header("location: ../pocetna_strana/login-registracija.php");
        session_unset();
        exit();
    }
    
    function vrsta_korisnika($conn, $id) {
        $sql = "SELECT * FROM korisnici WHERE id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: login-registracija.php?error=stmt_fail");
            session_unset();
			exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $podaci = mysqli_stmt_get_result($stmt);
        $podaci_assoc = mysqli_fetch_assoc($podaci);
        return $podaci_assoc['admin'];
    }