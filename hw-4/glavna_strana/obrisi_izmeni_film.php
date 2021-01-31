<html>
    <head>
        <title> IMDB </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="admin.css">
    </head>
    
    <body>
        <?php require_once "header.php" ?>  
        <?php
            require_once "../pocetna_strana/dbh.php";
            require_once "film_klasa.php";
            session_start();
            if (isset($_SESSION['id']) && isset($_SESSION['admin']) && isset($_POST['akcija'])) {
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
                    header("location: admin.php?error=nije_pronadjen");
                    exit();
                }
                if ($_POST['akcija'] === "obrisi") { 
                    izbrisi_film($conn, (int)$izabrani_film->id);
                }
                else if ($_POST['akcija'] === "izmeni") {
                    $_SESSION['id_filma'] = $izabrani_film->id;
                }
                else {
                    header("location: admin.php");
                    exit();
                }
            }
            else {
                header("location: ../pocetna_strana/login-registracija.php");
                session_unset();
                exit();
            }

            function izbrisi_film($conn, $id) {
                $sql = "DELETE FROM filmovi WHERE id=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../pocetna_strana/login-registracija.php?error=stmt_fail");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header("location: admin.php");
                exit();
            }
        ?>

        <div id="osnovni_kontejner">
        <div id="izmeni_kontejner">
            <form action="izmeni_film.php" method="post">
                <input value="<?php echo $izabrani_film->naslov; ?>" class="textbox" type="text" name="naslov" placeholder="Naslov"> <br>
                <input value="<?php echo $izabrani_film->kraci_opis; ?>" class="textbox" type="text" name="kraci_opis" placeholder="Kraći opis"> <br>
                <input value="<?php echo implode(", ", $izabrani_film->zanr); ?>" class="textbox" type="text" name="zanr" placeholder="Žanr"> <br>
                <input value="<?php echo $izabrani_film->reziser; ?>"class="textbox" type="text" name="reziser" placeholder="Režiser"> <br>     
                <input value="<?php echo $izabrani_film->prod_kuca; ?>" class="textbox" type="text" name="prod_kuca" placeholder="Producentska kuća"> <br>
                <input value="<?php echo $izabrani_film->glumci; ?>" class="textbox" type="text" name="glumci" placeholder="Glumci"> <br>
                <input value="<?php echo $izabrani_film->god_izdanja; ?>" class="textbox" type="text" name="god_izdanja" placeholder="Godina izdanja"> <br>
                <input value="<?php echo $izabrani_film->slika; ?>" class="textbox" type="text" name="slika" placeholder="Slika"> <br>
                <input value="<?php echo $izabrani_film->vreme_trajanja; ?>" class="textbox" type="text" name="vreme_trajanja" placeholder="Vreme trajanja (u minutima)"> <br>
                <input class="dugme2" type="submit" id="posalji" value="Potvrdi">
            </form>
        </div>
        </div>

    </body>
</html>