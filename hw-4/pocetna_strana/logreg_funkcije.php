<?php
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

	function duzina($arg, $min_len, $max_len) {
		if (strlen($arg) < $min_len || strlen($arg) > $max_len) 
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
		mysqli_stmt_close($stmt);		
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
		mysqli_stmt_close($stmt);
	}