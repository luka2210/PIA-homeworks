dugme_reg = document.getElementById("registracija");
dugme_log = document.getElementById("prijava");
dugme_log.style.backgroundColor = "rgb(0, 153, 76)";
forma_reg = document.getElementById("registracija_forma");
forma_reg.style.display = "none";
dugme_posalji = document.getElementById("posalji");
kor_ime = document.getElementById("korisnicko_ime");
glavna_forma = document.getElementById("glavna_forma");

dugme_reg.onclick = function() {
	dugme_reg.style.backgroundColor = "rgb(0, 153, 76)";
	dugme_log.style.backgroundColor = "rgb(128, 128, 128)";
	forma_reg.style.display = "block";
	dugme_posalji.value = "Registrujte se";
	kor_ime.placeholder = "Korisničko ime";
	glavna_forma.action = "reg.php";
}

dugme_log.onclick = function() {
	dugme_log.style.backgroundColor = "rgb(0, 153, 76)";
	dugme_reg.style.backgroundColor = "rgb(128, 128, 128)";
	forma_reg.style.display = "none";
	dugme_posalji.value = "Prijavite se";
	kor_ime.placeholder = "Korisničko ime ili e-mail";
	glavna_forma.action = "log.php";
}