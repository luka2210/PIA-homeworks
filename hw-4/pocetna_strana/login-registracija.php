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

		<?php 
			if (isset($_GET['error'])) {
				$greska = $_GET['error'];
				if ($greska === 'korisnicko_ime_invalid') 
					echo '<div id="greska"> Korisničko ime mora imati izmedju 5 i 25 karaktera i sme sadržati samo brojeve i slova engleskog alfabeta. </div>';
				else if ($greska === 'lozinka_invalid') 
					echo '<div id="greska"> Unesite lozinku koja ima izmedju 5 i 30 karaktera (dozvoljeni su svi karakteri). </div>';
				else if ($greska === 'ime_invalid') 
					echo '<div id="greska"> Niste uneli ime! </div>';
				else if ($greska === 'prezime_invalid') 
					echo '<div id="greska"> Niste uneli prezime! </div>';
				else if ($greska === 'e_mail_invalid') 
					echo '<div id="greska"> Niste uneli e-mail u odgovarajućem formatu. </div>';
				else if ($greska === 'korisnicko_ime_postoji')
					echo '<div id="greska"> Korisničko ime koje ste uneli već postoji. </div>';
				else if ($greska === 'e_mail_postoji')
					echo '<div id="greska"> Unetu e-mail adresu već koristi neki drugi nalog. </div>';
				else if ($greska === 'stmt_fail')
					echo '<div id="greska"> Dogodila se serverska greška, probajte ponovo. </div>';
				else if ($greska === 'ne_postoji')
					echo '<div id="greska"> Korisničko ime ili e-mail koji ste uneli ne pripada ni jednom nalogu. </div>';
				else if ($greska === 'pogresna_lozinka')
					echo '<div id="greska"> Pogrešna lozinka. </div>';
			}
		?>
	</body>
</html>