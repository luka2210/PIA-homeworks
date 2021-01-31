<html>
    <head>
    <title> IMDB </title>
		<meta charset="UTF-8">
	</head>

    <body>
    <?php require_once "header.php" ?>  
    <input type="button" id="svi_filmovi_dugme" value="Svi filmovi"> 
    <input type="button" id="zanrovi_dugme" value="Izaberi žanr">

    <div id="svi_filmovi_kontejner">
        <form action="film_strana.php" method="post">
            <label for="svi_filmovi_lista"> Izaberite film iz liste svih filmova: </label>
            <input list="filmovi" name="izabrani_film" id="svi_filmovi_lista">
            <input type="submit" value="Potvrdi"> <br>
        </form>
    </div>

    <div id="zanrovi_kontejner">
        <div id="dugmici">
            <input type="button" value="Akcija" id="dugme_akcija">
            <input type="button" value="Animirani" id="dugme_animirani">
            <input type="button" value="Dokumentarni" id="dugme_dokumentarni">
            <input type="button" value="Drama" id="dugme_drama">
            <input type="button" value="Fantazija" id="dugme_fantazija">
            <input type="button" value="Horor" id="dugme_horor">
            <input type="button" value="Komedija" id="dugme_komedija">
            <input type="button" value="Triler" id="dugme_triler">
        </div>

        <div id="akcija">
            <form action="film_strana.php" method="post">
                <input list="filmovi_akcija" name="izabrani_film" id="akcija_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="animirani">
            <form action="film_strana.php" method="post">
                <input list="filmovi_animirani" name="izabrani_film" id="animirani_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="dokumentarni">
            <form action="film_strana.php" method="post">
                <input list="filmovi_dokumentarni" name="izabrani_film" id="dokumentarni_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="drama">
            <form action="film_strana.php" method="post">
                <input list="filmovi_drama" name="izabrani_film" id="drama_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="fantazija">
            <form action="film_strana.php" method="post">
                <input list="filmovi_fantazija" name="izabrani_film" id="fantazija_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="horor">
            <form action="film_strana.php" method="post">
                <input list="filmovi_horor" name="izabrani_film" id="horor_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="komedija">
            <form action="film_strana.php" method="post">
                <input list="filmovi_komedija" name="izabrani_film" id="komedija_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>

        <div id="triler">
            <form action="film_strana.php" method="post">
                <input list="filmovi_triler" name="izabrani_film" id="triler_filmovi_lista">
                <input type="submit" value="Potvrdi">
            </form>
        </div>
    </div>


    <?php 
        session_start();
        if (isset($_SESSION['id']) && isset($_SESSION['admin'])) {
            if ($_SESSION['admin'] === 1) {
                header("location: admin.php");
                exit();
            }
            //echo $_SESSION['id'];
            require_once "../pocetna_strana/dbh.php";
            require_once "film_klasa.php";

            $filmovi_assoc = preuzmi_filmove_iz_baze($conn);
            $filmovi = array();

            for ($i=0; $i<count($filmovi_assoc); $i++) {
                $film = new Film($filmovi_assoc[$i]['id'], $filmovi_assoc[$i]['naslov'], 
                                $filmovi_assoc[$i]['kraci_opis'], $filmovi_assoc[$i]['zanr'],
                                $filmovi_assoc[$i]['reziser'], $filmovi_assoc[$i]['prod_kuca'],
                                $filmovi_assoc[$i]['glumci'], $filmovi_assoc[$i]['god_izdanja'],
                                $filmovi_assoc[$i]['slika'], $filmovi_assoc[$i]['vreme_trajanja']);
                array_push($filmovi, $film);
            }

            $_SESSION['filmovi'] = $filmovi;

            ispisi_sve_filmove($filmovi);
            ispisi_zanr($filmovi, 'akcija');
            ispisi_zanr($filmovi, 'animirani');
            ispisi_zanr($filmovi, 'dokumentarni');
            ispisi_zanr($filmovi, 'drama');
            ispisi_zanr($filmovi, 'horor');
            ispisi_zanr($filmovi, 'komedija');
            ispisi_zanr($filmovi, 'fantazija');
            ispisi_zanr($filmovi, 'triler');
        }
        else {
            header("location: ../pocetna_strana/login-registracija.php");
            session_unset();
            exit();
        }

        function preuzmi_filmove_iz_baze($conn) {
            $sql = "SELECT * FROM filmovi";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: login-registracija.php?error=stmt_fail");
                session_unset();
                exit();
            }
            //mysqli_stmt_bind_param($stmt);
            mysqli_stmt_execute($stmt);
            $podaci = mysqli_stmt_get_result($stmt);
            $podaci_assoc = array();
            while ($red = mysqli_fetch_assoc($podaci)) {
                array_push($podaci_assoc, $red);
            }
            return $podaci_assoc;
            mysqli_stmt_close($stmt);
        }

        function ispisi_sve_filmove($filmovi) {
            echo "<datalist id='filmovi'>";
            foreach($filmovi as $film) 
                echo "<option value='" . $film->naslov . ", " . $film->god_izdanja . "'>";
            echo "</datalist>";
        }

        function ispisi_zanr($filmovi, $zanr) {
            echo "<datalist id='filmovi_" . $zanr . "'>";
            foreach($filmovi as $film) 
                foreach ($film->zanr as $podzanr)
                    if ($podzanr === $zanr)
                        echo "<option value='" . $film->naslov . ", " . $film->god_izdanja . "'>";
            echo "</datalist>";
        }
    ?>

    <div id="greska"> <?php if (isset($_GET['error'])) if ($_GET['error'] === "nije_pronadjen") echo "Film nije pronadjen.";
                            else if ($_GET['error'] === "nije_ocenjen") echo "Ocena nije zabeležena jer ste već ocenili film."; 
                            else if ($_GET['error'] === "ocenjen") echo "Film je uspešno ocenjen." ?> </div>

    <script src="korisnik.js"> </script>
    </body>
</html>