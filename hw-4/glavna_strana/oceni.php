<?php
    session_start();
    if (isset($_SESSION['id']) && isset($_SESSION['film_id'])) {
        $korisnik_id = (int)$_SESSION['id'];
        $film_id = (int)$_SESSION['film_id'];
        $ocena = (int)$_POST['ocena'];

        require_once "../pocetna_strana/dbh.php";

        if (ocena_postoji($conn, $korisnik_id, $film_id)) {
            header("location: korisnik.php?error=nije_ocenjen");
            exit();
        }

        upisi_ocenu($conn, $korisnik_id, $film_id, $ocena);
    }
    else {
        header("location: ../pocetna_strana/login-registracija.php");
        session_unset();
        exit();
    }

    function ocena_postoji($conn, $korisnik_id, $film_id) {
        $sql = "SELECT * FROM ocene WHERE korisnik_id = ? AND film_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: login-registracija.php?error=stmt_fail");
			exit();
        }
        mysqli_stmt_bind_param($stmt, "ii", $korisnik_id, $film_id);
        mysqli_stmt_execute($stmt);
        $podaci = mysqli_stmt_get_result($stmt);
        if (mysqli_fetch_assoc($podaci))
            return true;
        return false;
        mysqli_stmt_close($stmt);
    }

    function upisi_ocenu($conn, $korisnik_id, $film_id, $ocena) {
        $sql = "INSERT INTO ocene (korisnik_id, film_id, ocena) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: login-registracija.php?error=stmt_fail");
			exit();
        }
        mysqli_stmt_bind_param($stmt, "iii", $korisnik_id, $film_id, $ocena);
		mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: korisnik.php?error=ocenjen");
        exit();
    }