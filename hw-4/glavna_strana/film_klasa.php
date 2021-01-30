<?php
    class Film {
        public $id, $naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja;

        function __construct($id, $naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja) {
            $this->id = $id;
            $this->naslov = $naslov;
            $this->kraci_opis = $kraci_opis;
            $this->zanr = explode(", ", $zanr);
            $this->reziser = $reziser;
            $this->prod_kuca = $prod_kuca;
            $this->glumci = $glumci;
            $this->god_izdanja = $god_izdanja;
            $this->slika = $slika;
            $this->vreme_trajanja = $vreme_trajanja;
        }

        public function __toString() {
            return $this->id . " " . $this->naslov . " " . $this->kraci_opis . " " . $this->zanr . " " .
                   $this->reziser . " " . $this->prod_kuca . " " . $this->glumci . " " . $this->god_izdanja . " " . $this->slika . " " . $this->vreme_trajanja;
        }
    }