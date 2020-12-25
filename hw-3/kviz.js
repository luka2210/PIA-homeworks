var pitanja = new Object();
var broj_bodova = 0;
var rb_pitanja = 0;
var ime_unos = document.getElementById("ime");
var pocni_kviz_dugme = document.getElementById("pocni_kviz");
var forma_0 = document.getElementById("forma0");
var forma_1 = document.getElementById("forma1");
forma_1.style.display = "none";
var forma_2 = document.getElementById("forma2");
forma_2.style.display = "none";
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
var odustani = document.getElementById("dugme_odustani");
var preskoci_pitanje = document.getElementById("dugme_preskoci");
var takmicari = [];

fetch('kviz.json').then(function(response) {
	return response.json();
}).then(function(obj) {
	pitanja = obj;
})

function tajmer_funkcija() {
	if (forma_1.style.display == "none") 
		clearInterval(tajmer);
	var sad = new Date().getTime();
	var preostalo_vreme = ukupno_vreme - sad;
	var sekunde = Math.floor((preostalo_vreme % (1000 * 60)) / 1000);
	document.getElementById("tajmer").innerHTML = sekunde;
	if (sekunde < 1) {
		document.getElementById("tajmer").innerHTML = "Истекло време!";
		pritisnuto_dugme(-1);
	}
}

pocni_kviz_dugme.onclick = function() {
	rb_pitanja = 0;
	if (ime_unos.value == "") {
		window.alert("Нисте унесли име!");
		return;
	}	
	forma_0.style.display = "none";
	forma_1.style.display = "block";
	if (pitanja[0].ponudjeni_odgovori)
		fnc_true();
	else 
		fnc_false();
	ukupno_vreme = new Date().getTime() + 21000;
	tajmer = setInterval(tajmer_funkcija, 100);
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
	clearInterval(tajmer);
	if ( (pitanja[rb_pitanja].ponudjeni_odgovori && x==pitanja[rb_pitanja].tacan_odgovor)
	  || (x!=-1 && !pitanja[rb_pitanja].ponudjeni_odgovori && odgovor_tekst.value.toLowerCase()==pitanja[rb_pitanja].tacan_odgovor))
		tacan_odgovor();
	else 
		netacan_odgovor();
}

function tacan_odgovor() {
	document.body.style.backgroundColor = "green";
	broj_bodova += pitanja[rb_pitanja].broj_bodova;
	promeni_boje();
}

function netacan_odgovor() {
	document.body.style.backgroundColor = "red";
	odgovor_tekst.value = pitanja[rb_pitanja].tacan_odgovor;
	odgovor_tekst.style.fontWeight = "bold";
	promeni_boje();
}

function promeni_boje() {
	dugme1.disabled = true;
	dugme2.disabled = true;
	dugme3.disabled = true;
	dugme4.disabled = true;
	preskoci_pitanje.disabled = true;
	dugme_potvrdi.disabled = true;
	dugme1.style.borderColor = "black";
	dugme2.style.borderColor = "black";
	dugme3.style.borderColor = "black";
	dugme4.style.borderColor = "black";
	if (pitanja[rb_pitanja].tacan_odgovor == 1)
		dugme1.style.backgroundColor = "green";
	else 
		dugme1.style.backgroundColor = "red";
	if (pitanja[rb_pitanja].tacan_odgovor == 2)
		dugme2.style.backgroundColor = "green";
	else 
		dugme2.style.backgroundColor = "red";
	if (pitanja[rb_pitanja].tacan_odgovor == 3)
		dugme3.style.backgroundColor = "green";
	else 
		dugme3.style.backgroundColor = "red";
	if (pitanja[rb_pitanja].tacan_odgovor == 4)
		dugme4.style.backgroundColor = "green";
	else 
		dugme4.style.backgroundColor = "red";
	var cekaj = setTimeout(function() {
		vrati_boje();
		sledece_pitanje();
	}, 2000);
}

function vrati_boje() {
	dugme1.disabled = false;
	dugme2.disabled = false;
	dugme3.disabled = false;
	dugme4.disabled = false;
	dugme_potvrdi.disabled = false;
	preskoci_pitanje.disabled = false;
	dugme1.style.borderColor = "rgb(0, 128, 255)";
	dugme2.style.borderColor = "rgb(0, 128, 255)";
	dugme3.style.borderColor = "rgb(0, 128, 255)";
	dugme4.style.borderColor = "rgb(0, 128, 255)";
	dugme_potvrdi.style.borderColor = "rgb(0, 128, 255)";
	dugme1.style.backgroundColor = "rgb(0,191,255)";
	dugme2.style.backgroundColor = "rgb(0,191,255)";
	dugme3.style.backgroundColor = "rgb(0,191,255)";
	dugme4.style.backgroundColor = "rgb(0,191,255)";
	document.body.style.backgroundColor = "rgb(105, 105, 241)";
	odgovor_tekst.value = "";
	odgovor_tekst.style.fontWeight = "normal";
}

function sledece_pitanje() {
	if (rb_pitanja == 9) 
	{
		kraj_kviza();
		return;
	}
	else if (pitanja[++rb_pitanja].ponudjeni_odgovori)
		fnc_true();
	else
		fnc_false();
	ukupno_vreme = new Date().getTime() + 21000;
	tajmer = setInterval(tajmer_funkcija, 100);
}

odustani.onclick = function() {
	kraj_kviza();
}

preskoci_pitanje.onclick = function() {
	pritisnuto_dugme(-1);
}

function kraj_kviza() {
	let takmicar = new Object();
	takmicar.ime = ime_unos.value;
	takmicar.bodovi = broj_bodova;
	takmicari.push(takmicar);
	takmicari.sort(compare);
	if (takmicari.length > 10)
		takmicari.pop();
	vrati_boje();
	clearInterval(tajmer);
	div_tajmer.style.display = "none";
	forma_1.style.display = "none";
	forma_2.style.display = "block";
	document.getElementById("rezultat").innerHTML = "Освојени бодови:" + broj_bodova; 
	let tabela = document.getElementById("takmicar");
	let sadrzaj_tabele = "<table> <tr> <th> Такмичар </th> <th> Бодови </th> </tr>";
	for (let i=0;i<takmicari.length;i++) { 
		sadrzaj_tabele += "<tr>";
		sadrzaj_tabele += "<td>" + takmicari[i].ime + "</td>";
		sadrzaj_tabele += "<td>" + takmicari[i].bodovi; + "</td>";
		sadrzaj_tabele += "</tr>";
	}
	sadrzaj_tabele += "</table>";
	tabela.innerHTML = sadrzaj_tabele;
	document.getElementById("opet").onclick = function() {
		pocni_opet();
	}
}

function pocni_opet() {
	forma_0.style.display = "block";
	forma_1.style.display = "none";
	forma_2.style.display = "none";
	ime_unos.value = "";
	rb_pitanja = 0;
	broj_bodova = 0;
}

function compare(a, b) {
	if (a.bodovi < b.bodovi)
		return 1;
	if (a.bodovi > b.bodovi)
		return -1;
	if (a.ime < b.ime)
		return -1;
	if (a.ime > b.ime)
		return 1;
	return 0;
}