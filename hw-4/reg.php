<?php
	echo "radireg";
	
	if (isset($_POST['posalji'])) {
		$korisnicko_ime = $_POST['korisnicko_ime'];
		$lozinka = $_POST['lozinka'];
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$e_mail = $_POST['e-mail'];
		
		require_once "dbh.php";
		
		if (korisnicko_ime_invalid($korisnicko_ime) !== false) {
			header("location: login-registracija.php?error=korisnicko_ime_invalid");
			exit();
		}

		if (e_mail_invalid($e_mail) !== false) {
			header("location: login-registracija.php?error=e_mail_invalid");
			exit();
		}

		if (korisnicko_ime_postoji($conn, $korisnicko_ime)) {
			header("location: login-registracija.php?error=korisnicko_ime_postoji");
			exit();
		}

		if (e_mail_postoji($conn, $e_mail)) {
			header("location: login-registracija.php?error=e_mail_postoji");
			exit();
		}
	}
	else {
		header("location: login-registracija.php");
		exit();
	}
	
	function korisnicko_ime_invalid($korisnicko_ime) {
		if (strlen($korisnicko_ime) < 5 || strlen($korisnicko_ime) > 25)
			return true;
		$pattern = "/^[a-zA-Z0-9]*$/";
		if (!preg_match($pattern, $korisnicko_ime))
			return true;
		return false;
	}

	function e_mail_invalid($e_mail) {
		if (!filter_var($e_mail, FILTER_VALIDATE_EMAIL)) 
			return true;
		return false;
	}

	function korisnicko_ime_postoji($conn, $korisnicko_ime) {
		$sql = "SELECT * FROM korisnici WHERE kor_ime = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: login-registracija.php?error=stmt_fail");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "s", $korisnicko_ime);
		mysqli_stmt_execute($stmt);
		$podaci = mysqli_stmt_get_result($stmt);
		if ($var1 = mysqli_fetch_assoc($podaci))
			return $var1;
		else
			return false;
	}

	function e_mail_postoji($conn, $e_mail) {
		$sql = "SELECT * FROM korisnici WHERE e_mail = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: login-registracija.php?error=stmt_fail");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "s", $e_mail);
		mysqli_stmt_execute($stmt);
		$podaci = mysqli_stmt_get_result($stmt);
		if ($var2 = mysqli_fetch_assoc($podaci))
			return $var2;
		else
			return false;
	}