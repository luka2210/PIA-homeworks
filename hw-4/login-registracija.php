<html>
	<head>
		<title> IMDB </title>
		<meta charset="UTF-8">
	</head>

	<body>
		<form method="post" action="log.php" id="glavna_forma">
			<input type="button" id="prijava" name="prijava" value="Prijava"> 
			<input type="button" id="registracija" name="registracija" value="Registracija"> <br>
			<input type="text" name="korisnicko_ime" id="korisnicko_ime" placeholder="Korisničko ime ili e-mail"> <br>
			<input type="password" name="lozinka" id="lozinka" placeholder="Lozinka"> <br>
			<div id="registracija_forma">
				<input type="text" name="ime" id="ime" placeholder="Ime"> <br>
				<input type="text" name="prezime" id="prezime" placeholder="Prezime"> <br>
				<input type="text" name="e-mail" id="e-mail" placeholder="E-mail adresa"> <br>
			</div>
			<input type="submit" value="Prijavite se" name="posalji" id="posalji"> 
		</form>
		<script src="logreg.js"> </script>
	</body>
</html>