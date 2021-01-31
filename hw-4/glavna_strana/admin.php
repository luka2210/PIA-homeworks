<html>
    <head>
    <title> IMDB </title>
		<meta charset="UTF-8">
	</head>

    <body>
    <input type="button" id="dodaj_dugme" value="Dodaj film">
    <input type="button" id="obrisi_izmeni_dugme" value="Izmeni/obriši film">

    <div id="obrisi_izmeni_kontejner">
        <form action="" method="post">
            <label for="svi_filmovi_lista"> Izaberite film: </label>
            <input list="filmovi" name="izabrani_film" id="svi_filmovi_lista"> <br>
            <label for="izmeni"> Izmeni: </label>
            <input type="radio" name="akcija" value="izmeni" id="izmeni">
            <label for="obrisi"> Obriši: </label>
            <input type="radio" name="akcija" value="obrisi" id="obrisi"> <br>
            <input type="submit" value="Potvrdi" id="posalji"> 
        </form>
    </div>

    <div id="dodaj_kontejner">
        <form action="" method="post">
            <input type="text" id="naslov" placeholder="Naslov">
            <input type="text" id="kraci_opis" placeholder="Kraći opis">
            <input type="text" id="zanr" placeholder="Žanr">
            <input type="text" id="reziser" placeholder="Režiser">
            <input type="text" id="prod_kuca" placeholder="Producentska kuća">
            <input type="text" id="glumci" placeholder="Glumci">
            <input type="text" id="god_izdanja" placeholder="Godina izdanja">
            <input type="text" id="slika" placeholder="Slika">
            <input type="text" id="vreme_trajanja" placeholder="Vreme trajanja (u minutima)">
        </form>
    </div>

    <?php 
        session_start();
        if (isset($_SESSION['id'])) {
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
    ?>

    <script src="admin.js"> </script>
    </body>
</html>
