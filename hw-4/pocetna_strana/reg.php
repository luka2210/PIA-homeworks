<?php
	if (isset($_POST['posalji'])) {
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = $_POST['lozinka'];
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$e_mail = $_POST['e-mail'];
		
		require_once "dbh.php";
		require_once "logreg_funkcije.php";
		
		if (korisnicko_ime_invalid($korisnicko_ime) !== false) {
			header("location: login-registracija.php?error=korisnicko_ime_invalid");
			exit();
		}

		if (e_mail_invalid($e_mail) !== false) {
			header("location: login-registracija.php?error=e_mail_invalid");
			exit();
		}

		if (duzina($lozinka, 5, 30) !== false) {
			header("location: login-registracija.php?error=lozinka_invalid");
			exit();
		}

		if (duzina($ime, 2, 100) !== false) {
			header("location: login-registracija.php?error=ime_invalid");
			exit();
		}

		if (duzina($prezime, 2, 100) !== false) {
			header("location: login-registracija.php?error=prezime_invalid");
			exit();
		}

		if (korisnicko_ime_postoji($conn, $korisnicko_ime) !== false) {
			header("location: login-registracija.php?error=korisnicko_ime_postoji");
			exit();
		}

		if (e_mail_postoji($conn, $e_mail) !== false) {
			header("location: login-registracija.php?error=e_mail_postoji");
			exit();
		}

		dodaj_korisnika($conn, $korisnicko_ime, $lozinka, $ime, $prezime, $e_mail);
	}
	else {
		header("location: login-registracija.php");
		exit();
	}
	

	function dodaj_korisnika($conn, $korisnicko_ime, $lozinka, $ime, $prezime, $e_mail) {
		$sql = "INSERT INTO korisnici (kor_ime, lozinka, ime, prezime, e_mail, admin) VALUES (?, ?, ?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: login-registracija.php?error=stmt_fail");
			exit();
		}
		$admin = 0;
		mysqli_stmt_bind_param($stmt, "sssssi", $korisnicko_ime, $lozinka, $ime, $prezime, $e_mail, $admin);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		//header("location: login-registracija.php?error=none");
		require_once 'log.php';
		exit();
	}