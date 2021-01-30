<html>
    <head> 
        <title> IMDB </title>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php
            require_once "film_klasa.php";
            session_start();
            if (isset($_SESSION['id']) && (isset($_POST['izabrani_film']) || isset($_SESSION['film_id']))) {
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
            }
            else {
                header("location: ../pocetna_strana/login-registracija.php");
                session_unset();
                exit();
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

        <div id="oceni_kontejner">
            <form action="oceni.php" method="post">
                <input type="range" id="ocena" name="ocena" min="1" max="10"> 
                <input type="submit" value="Oceni">
            </form>
        </div>
    </body>
</html>