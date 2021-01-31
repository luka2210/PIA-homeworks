<html>
    <head>
        <title> IMDB </title>
        <meta charset="UTF-8">
    </head>
    
    <body>

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
                    echo $_POST['izabrani_film'];
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

        <div id="izmeni_kontejner">
            <form action="izmeni_film.php" method="post">
                <input type="text" name="naslov" placeholder="Naslov"> <br>
                <input type="text" name="kraci_opis" placeholder="Kraći opis"> <br>
                <input type="text" name="zanr" placeholder="Žanr"> <br>
                <input type="text" name="reziser" placeholder="Režiser"> <br>     
                <input type="text" name="prod_kuca" placeholder="Producentska kuća"> <br>
                <input type="text" name="glumci" placeholder="Glumci"> <br>
                <input type="text" name="god_izdanja" placeholder="Godina izdanja"> <br>
                <input type="text" name="slika" placeholder="Slika"> <br>
                <input type="text" name="vreme_trajanja" placeholder="Vreme trajanja (u minutima)"> <br>
                <input type="submit" id="posalji" value="Potvrdi">
            </form>
        </div>

    </body>
</html>