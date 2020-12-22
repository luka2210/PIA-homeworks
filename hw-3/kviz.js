var pitanja = new Object();
var ime_unos = document.getElementById("ime");
var pocni_kviz_dugme = document.getElementById("pocni_kviz");

fetch('kviz.json').then(function(response) {
	return response.json();
}).then(function(obj) {
	pitanja = obj;
})

pocni_kviz_dugme.onclick = function() {
	console.log(pitanja[0]);
}
