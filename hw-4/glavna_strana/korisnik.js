svi_filmovi_dugme = document.getElementById("svi_filmovi_dugme");
zanrovi_dugme = document.getElementById("zanrovi_dugme");

svi_filmovi_kontejner = document.getElementById("svi_filmovi_kontejner");
svi_filmovi_kontejner.style.display = "none";
zanrovi_kontejner = document.getElementById("zanrovi_kontejner");
zanrovi_kontejner.style.display = "none";

dugme_akcija = document.getElementById("dugme_akcija");
dugme_akcija.class = "dugme3";
dugme_animirani = document.getElementById("dugme_animirani");
dugme_dokumentarni = document.getElementById("dugme_dokumentarni");
dugme_drama = document.getElementById("dugme_drama");
dugme_fantazija = document.getElementById("dugme_fantazija");
dugme_horor = document.getElementById("dugme_horor");
dugme_komedija = document.getElementById("dugme_komedija");
dugme_triler = document.getElementById("dugme_triler");
medija = document.getElementById("komedija");
triler = document.getElementById("triler");

svi_filmovi_dugme.onclick = function() {
    svi_filmovi_kontejner.style.display = "block";
    zanrovi_kontejner.style.display = "none";
}

zanrovi_dugme.onclick = function() {
    svi_filmovi_kontejner.style.display = "none";
    zanrovi_kontejner.style.display = "block";
    sakrij_zanrove();
}

akcija = document.getElementById("akcija");
animirani = document.getElementById("animirani");
dokumentarni = document.getElementById("dokumentarni");
drama = document.getElementById("drama");
fantazija = document.getElementById("fantazija");
horor = document.getElementById("horor");
komedija = document.getElementById("komedija");
triler = document.getElementById("triler");

function sakrij_zanrove() {
    akcija.style.display = "none";
    animirani.style.display = "none";
    dokumentarni.style.display = "none";
    drama.style.display = "none";
    fantazija.style.display = "none";
    horor.style.display = "none";
    komedija.style.display = "none";
    triler.style.display = "none";
}

dugme_akcija.onclick = function() {
    sakrij_zanrove();
    akcija.style.display = "block";
}

dugme_animirani.onclick = function() {
    sakrij_zanrove();
    animirani.style.display = "block";
}

dugme_dokumentarni.onclick = function() {
    sakrij_zanrove();
    dokumentarni.style.display = "block";
}

dugme_drama.onclick = function() {
    sakrij_zanrove();
    drama.style.display = "block";
}

dugme_fantazija.onclick = function() {
    sakrij_zanrove();
    fantazija.style.display = "block";
}

dugme_horor.onclick = function() {
    sakrij_zanrove();
    horor.style.display = "block";
}

dugme_komedija.onclick = function() {
    sakrij_zanrove();
    komedija.style.display = "block";
}

dugme_triler.onclick = function() {
    sakrij_zanrove();
    triler.style.display = "block";
}