var pitanja = new Object();
var broj_bodova = 0;
var rb_pitanja = 0;
var ime_unos = document.getElementById("ime");
var pocni_kviz_dugme = document.getElementById("pocni_kviz");
var forma_0 = document.getElementById("forma0");
var forma_1 = document.getElementById("forma1");
forma_1.style.display = "none";
var ponudjeni_odgovori_true = document.getElementById("odgovori_true");
var ponudjeni_odgovori_false = document.getElementById("odgovori_false");
var dugme1 = document.getElementById("odgovorA");
var dugme2 = document.getElementById("odgovorB");
var dugme3 = document.getElementById("odgovorC");
var dugme4 = document.getElementById("odgovorD");
dugme1.onclick = function() { pritisnuto_dugme(1); };
dugme2.onclick = function() { pritisnuto_dugme(2); };
dugme3.onclick = function() { pritisnuto_dugme(3); };
dugme4.onclick = function() { pritisnuto_dugme(4); };
var tekst_pitanja = document.getElementById("pitanje");
var dugme_potvrdi = document.getElementById("potvrdi");
var odgovor_tekst = document.getElementById("odgovor_tekst");
dugme_potvrdi.onclick = function() { pritisnuto_dugme(0); };
var div_tajmer = document.getElementById("tajmer");
div_tajmer.style.display = "none";
var ukupno_vreme;
var tajmer;

fetch('kviz.json').then(function(response) {
	return response.json();
}).then(function(obj) {
	pitanja = obj;
})

pocni_kviz_dugme.onclick = function() {
	forma_0.style.display = "none";
	forma_1.style.display = "block";
	if (pitanja[0].ponudjeni_odgovori)
		fnc_true();
	else 
		fnc_false();
	ukupno_vreme = new Date().getTime() + 20000;
	tajmer = setInterval(function() {
		var sad = new Date().getTime();
		var preostalo_vreme = ukupno_vreme - sad;
		var sekunde = Math.floor((preostalo_vreme % (1000 * 60)) / 1000);
		document.getElementById("tajmer").innerHTML = sekunde + "s ";
		if (sekunde < 1) {
			document.getElementById("tajmer").innerHTML = "Истекло време!";
			pritisnuto_dugme(-1);
		}
	}, 100);
	div_tajmer.style.display = "block";
}

function fnc_true() {
	ponudjeni_odgovori_true.style.display = "block";
	ponudjeni_odgovori_false.style.display = "none";
	tekst_pitanja.innerHTML = pitanja[rb_pitanja].tekst;
	dugme1.value = pitanja[rb_pitanja].odgovor1;
	dugme2.value = pitanja[rb_pitanja].odgovor2;
	dugme3.value = pitanja[rb_pitanja].odgovor3;
	dugme4.value = pitanja[rb_pitanja].odgovor4;
}

function fnc_false() {
	ponudjeni_odgovori_true.style.display = "none";
	ponudjeni_odgovori_false.style.display = "block";
	tekst_pitanja.innerHTML = pitanja[rb_pitanja].tekst;
}

function pritisnuto_dugme(x) {
	if ( (pitanja[rb_pitanja].ponudjeni_odgovori && x==pitanja[rb_pitanja].tacan_odgovor)
	  || (!pitanja[rb_pitanja].ponudjeni_odgovori && odgovor_tekst.value==pitanja[rb_pitanja].tacan_odgovor) ) {
		broj_bodova+=1;
	}
	if (rb_pitanja == 3) 
	{
		kraj_kviza();
		return;
	}
	else if (pitanja[++rb_pitanja].ponudjeni_odgovori)
		fnc_true();
	else
		fnc_false();
	ukupno_vreme = new Date().getTime() + 20000;
}


function kraj_kviza() {
	clearInterval(tajmer);
	div_tajmer.style.display = "none";
	document.write(broj_bodova);
}