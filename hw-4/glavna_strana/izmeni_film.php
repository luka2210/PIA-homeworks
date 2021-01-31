<?php   
    require_once "../pocetna_strana/dbh.php";
    session_start();
    if (isset($_SESSION['id']) && isset($_SESSION['admin'])) {
        if ($_SESSION['admin'] === 0) {
            header("location: korisnik.php");
            exit();
        }

        $id = (int)$_SESSION['id_filma'];
        $naslov = $_POST['naslov'];
        $kraci_opis = $_POST['kraci_opis'];
        $zanr = $_POST['zanr'];
        $reziser = $_POST['reziser'];
        $prod_kuca = $_POST['prod_kuca'];
        $glumci = $_POST['glumci'];
        $god_izdanja = (int)$_POST['god_izdanja'];
        $slika = $_POST['slika'];
        $vreme_trajanja = (int)$_POST['vreme_trajanja'];

        if (nije_popunjeno($naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja) === true) {
            header("location: admin.php?error=nije_popunjeno");
            exit();
        }
        
        izmeni_film_u_bazi($conn, $id, $naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja);
    }
    else {
        header("location: ../pocetna_strana/login-registracija.php");
        session_unset();
        exit();
    }

    function nije_popunjeno($naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja) {
        if(empty($naslov) || empty($kraci_opis) || empty($zanr) || empty($reziser) || empty($prod_kuca) || empty($glumci) || empty($god_izdanja) || empty($slika) || empty($vreme_trajanja))
            return true;
        return false;
    }


    function izmeni_film_u_bazi($conn, $id, $naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja) {
		$sql = "UPDATE filmovi 
                SET naslov=?, kraci_opis=?, zanr=?, reziser=?, prod_kuca=?, glumci=?, god_izdanja=?, slika=?, vreme_trajanja=?
                WHERE id=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../pocetna_strana/login-registracija.php?error=stmt_fail");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "ssssssisii", $naslov, $kraci_opis, $zanr, $reziser, $prod_kuca, $glumci, $god_izdanja, $slika, $vreme_trajanja, $id);
		mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: admin.php");
		exit();
	}