var pitanja = new Object();
var ime_unos = document.getElementById("ime");
var pocni_kviz_dugme = document.getElementById("pocni_kviz");
var forma_0 = document.getElementById("forma0");
//forma_0.style.display = "none";
var forma_1 = document.getElementById("forma1");
forma_1.style.display = "none";
var ponudjeni_odgovori_true = document.getElementById("odgovori_true");
var ponudjeni_odgovori_false = document.getElementById("odgovori_false");

fetch('kviz.json').then(function(response) {
	return response.json();
}).then(function(obj) {
	pitanja = obj;
})

pocni_kviz_dugme.onclick = function() {
	console.log(pitanja[0]);
}
