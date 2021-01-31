dodaj_dugme = document.getElementById("dodaj_dugme");
obrisi_izmeni_dugme = document.getElementById("obrisi_izmeni_dugme");

obrisi_izmeni_kontejner = document.getElementById("obrisi_izmeni_kontejner");
dodaj_kontejner = document.getElementById("dodaj_kontejner");
obrisi_izmeni_kontejner.style.display = "none";
dodaj_kontejner.style.display = "none";

dodaj_dugme.onclick = function() {
    dodaj_kontejner.style.display = "block";
    obrisi_izmeni_kontejner.style.display = "none";
}

obrisi_izmeni_dugme.onclick = function() {
    dodaj_kontejner.style.display = "none";
    obrisi_izmeni_kontejner.style.display = "block";
}

radio_izmeni = document.getElementById("izmeni");
radio_obrisi = document.getElementById("obrisi");

dugme_posalji = document.getElementById("posalji");
dugme_posalji.style.display = "none";

radio_izmeni.onclick = function() { prikazi_submit(); }
radio_obrisi.onclick = function() { prikazi_submit(); }

function prikazi_submit() {
    if (radio_izmeni.checked || radio_obrisi.checked)
        dugme_posalji.style.display = "block";
}
