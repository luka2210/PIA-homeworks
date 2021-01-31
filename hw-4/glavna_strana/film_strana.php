<html>
    <head> 
        <title> IMDB </title>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php
            require_once "film_klasa.php";
            require_once "../pocetna_strana/dbh.php";
            session_start();
            if (isset($_SESSION['id']) && isset($_SESSION['admin']) && (isset($_POST['izabrani_film']) || isset($_SESSION['film_id']))) {
                if ($_SESSION['admin'] === 1) {
                    header("location: admin.php");
                    exit();
                }
                $naslov_godina = explode(", ", $_POST['izabrani_film']);
                $naslov = $naslov_godina[0];
                $god_izdanja = (int)$naslov_godina[1];

                $filmovi = $_SESSION['filmovi'];


                $film_pronadjen = false;
                foreach ($filmovi as $film) 
                    if ($film->naslov === $naslov && $film->god_izdanja === $god_izdanja) {
                        $izabrani_film = $film;
                        $film_pronadjen = true;
                        break;
                    }
                
                if (!$film_pronadjen) {
                    header("location: korisnik.php?error=nije_pronadjen");
                    exit();
                }

                $_SESSION['film_id'] = $izabrani_film->id;
                $prosecna_ocena = pronadji_prosecnu_ocenu($conn, $_SESSION['film_id']);
                //echo $prosecna_ocena;
            }
            else {
                header("location: ../pocetna_strana/login-registracija.php");
                session_unset();
                exit();
            }

            function pronadji_prosecnu_ocenu($conn, $film_id) {
                $br=0;
                $zbir=0;
                $sql = "SELECT ocena FROM ocene WHERE film_id = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: login-registracija.php?error=stmt_fail");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "i", $film_id);
                mysqli_stmt_execute($stmt);
                $podaci = mysqli_stmt_get_result($stmt);
                while ($ocena = mysqli_fetch_assoc($podaci)) {
                    $zbir+=(int)$ocena['ocena'];
                    $br++;
                }
                if ($br === 0)
                    return "neocenjen";
                return ($zbir/$br);
                mysqli_stmt_close($stmt);
            }
        ?>

        <div id="nazad">
            <form method="post" action="korisnik.php">
                <input type="submit" value="Nazad">
            </form>
        </div>

        <div id="slika"> <img src="<?php echo $izabrani_film->slika ?>"> </div>
        <div id="naslov"> <?php echo $izabrani_film->naslov ?> </div>
        <div id="kraci_opis"> <?php echo $izabrani_film->kraci_opis ?> </div>
        <div id="zanr"> <?php echo implode(", ", $izabrani_film->zanr) ?> </div>
        <div id="reziser"> <?php echo $izabrani_film->reziser ?> </div>
        <div id="prod_kuca"> <?php echo $izabrani_film->prod_kuca ?> </div>
        <div id="glumci"> <?php echo $izabrani_film->glumci ?> </div>
        <div id="god_izdanja"> <?php echo $izabrani_film->god_izdanja ?> </div>
        <div id="vreme_trajanja"> <?php echo $izabrani_film->vreme_trajanja ?> </div>
        <div id="prosecna_ocena"> <?php echo $prosecna_ocena ?> </div>

        <div id="oceni_kontejner">
            <form action="oceni.php" method="post">
                <input type="range" id="ocena" name="ocena" min="1" max="10"> 
                <input type="submit" value="Oceni">
            </form>
        </div>
    </body>
</html>