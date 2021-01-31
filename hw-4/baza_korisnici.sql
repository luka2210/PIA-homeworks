-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 11:39 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza_korisnici`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE `filmovi` (
  `id` int(10) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `kraci_opis` varchar(1000) NOT NULL,
  `zanr` varchar(100) NOT NULL,
  `reziser` varchar(100) NOT NULL,
  `prod_kuca` varchar(100) NOT NULL,
  `glumci` varchar(1000) NOT NULL,
  `god_izdanja` int(5) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `vreme_trajanja` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`id`, `naslov`, `kraci_opis`, `zanr`, `reziser`, `prod_kuca`, `glumci`, `god_izdanja`, `slika`, `vreme_trajanja`) VALUES
(1, 'Tesla', 'O sadržaju ovog filma nije potrebno previše pisati. Životna priča čoveka koji je kako kažu “izmislio 20. vek“ će hronološki pratiti Tesline američke godine, nizanje njegovih ključnih otkrića i sukob s Tomasom Edisonom…', 'drama, dokumentarni', 'Michael Almereyda', 'Millennium Media', 'Ethan Hawke, Eve Hewson, Eli A. Smith, Josh Hamilton, Luna Jokic', 2020, '../slike/tesla.png', 102),
(2, 'Pawn Sacrifice', 'Tokom Hladnog rata, šahovski majstor Bobi Fišer kreće u meč protiv sovjetskog šampiona Borisa Spaskog. Iako Fišer želi normalan meč protiv svog rivala, Amerika želi tim putem pokazati koliko je ona nadmoćnija od Rusa u svakom pogledu. Uz sve to, situaciju dodatno komplikuje činjenica da Bobi pati od paranoje. Sve to dovešće do partije šaha kakvu još nikada niste videli.', 'drama', 'Edward Zwick', 'Gail Katz Productions', 'Tobey Maguire, Liev Schreiber, Michael Stuhlbarg, Peter Sarsgaard, Edward Zinoviev', 2014, '../slike/bobi.png', 115),
(3, 'Hereditary', 'Ovo je horor od kojeg će Vam se zalediti krv u žilama! Producenti filma \'Veštica\' napisali su priču o porodici koja ima svoje mračne tajne koje vode pravo u pakao. Nakon smrti Elen Grejem, njena porodica počinje da razotkriva zastrašujuće tajne o svome poreklu. Što više otkrivaju, to više pokušavaju da izbegnu strašnu sudbinu koju su nasledili.', 'drama, horor', 'Ari Aster', 'PalmStar Media', 'Alex Wolff, Gabriel Byrne, Toni Collette, Milly Shapiro, Christy Summerhays', 2018, '../slike/hereditary.png', 127),
(4, 'Diego Maradona', 'Dokumentarni film o najvećem i najkontroverznijem fudbaleru svih vremena…', 'dokumentarni', 'Asif Kapadia', 'Lorton Entertainment', 'Pelé, Diego Maradona', 2019, '../slike/maradona.png', 130),
(5, 'The Wolf of Wall Street', 'Početkom devedesetih godina prošlog veka Džordan Belfort sa svojim partnerom Donijem Azofom pokrenuo je brokersku firmu \'Stratford-Oakmont\'. Ona je ubrzo višestruko narasla, kao i njihov status na Vol Stritu. No, sa bogatstvom i slavom, počeli su rasti i problemi sa drogom, te laži. Njihove zabave i ludi provodi počinju privlačiti pažnju FBI-a, koji otkriva da njihovo poslovanje nije čisto. Belfort želi da prebaci svoj novac u evropsku banku kako bi izbegao moguće probleme, no pod budnim okom FBI-a, samo je pitanje dana kada će njihovom luksuznom životu doći kraj.', 'komedija', 'Martin Scorsese', 'Red Granite Pictures', 'Leonardo DiCaprio, Jonah Hill, Margot Robbie, Matthew McConaughey, Kyle Chandler', 2013, '../slike/vuk.png', 180),
(6, 'Aliens', 'Elen Ripli, poslednja preživela članica komercijalnog broda kojeg je napao gotovo nepobedivi vanzemaljac. Putujući svemirom, Ripley se bori sa depresijom dok je predstavnik njene kompanije ne informiše da je planeta na kojoj je njena posada otkrila vanzemaljca sada naseljena od strane kolonista. Kontakt s kolonijom je odjednom izgubljen, te je na mesto poslan odred marinaca. Pozvana zajedno sa njima na koloniju kao savetnica, Ripli predviđa katastrofu', 'akcija, horor, fantazija', 'James Cameron', 'Twentieth Century Fox', 'Sigourney Weaver, Carrie Henn, Michael Biehn, Paul Reiser, Lance Henriksen', 1986, '../slike/aliens.png', 137),
(7, 'This is the End', 'Džej je samo želeo dobar provod u Los Andjelesu sa svojim prijateljem Setom Roganom na žurci kojeg priređuje Džejms Franko. No, odjednom dođe propast sveta i apokalipsa. Sada se Džej i Set panično skrivaju u Džejmsovoj kući čekajući da dođe spas. Zajedno, oni se moraju udružiti kako bi preživeli kraj sveta.', 'fantazija, komedija', 'Evan Goldberg', 'Columbia Pictures', 'James Franco, Jonah Hill, Seth Rogen, Jay Baruchel, Michael Cera, Emma Watson, Rihanna', 2013, '../slike/kraj.png', 107),
(8, 'Despicable Me', 'U srećnom kvartu u predgrađu, punom belih kućica sa vrtovima prekrasnog cveća, stoji mračna kuća. Tamo se krije tajno skrovište Grua, koji uz pomoć svojih Miniona planira najveću pljačku u istoriji sveta – on želi da ukrade Mesec! Naoružan raznim oružjem, niko i ništa mu ne može stati na put – sve dok jednog dana ne upozna tri malene curice iz sirotišta, koje u njemu vide nešto što nitko nikada nije – potencijalnog tatu.', 'animirani', 'Pierre Coffin', 'Universal Pictures', 'Steve Carell, Jason Segel, Russell Brand, Miranda Cosgrove, Dana Gaier, Elsie Fisher', 2010, '../slike/gru.png', 105),
(9, 'Shutter Island', 'Federalni maršal Tedi i njegov partner Čak putuju na ostrvo na kojem se nalazi mentalna institucija. Razlog Tedijevog dolaska je istraga nestanka pacijentice Rejčel.  Dok Tedi i Čak kreću sve dublje u istragu kako bi saznali što se dogodilo sa Rejčel, oni otkrivaju mračne tajne ostrva.', 'triler', 'Martin Scorsese', 'Paramount Pictures', 'Leonardo DiCaprio, Mark Ruffalo, Ben Kingsley, Max von Sydow, Michelle Williams', 2010, '../slike/shutter.png', 138);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(10) NOT NULL,
  `kor_ime` varchar(100) NOT NULL,
  `lozinka` varchar(100) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `kor_ime`, `lozinka`, `ime`, `prezime`, `e_mail`, `admin`) VALUES
(1, 'luka123', 'luka123passwd', 'Luka', 'Momcilovic', 'lukamomcilovic221099@gmail.com', 1),
(2, 'admin2', 'admin2passwd', 'admin', 'adminovic', 'admin2@gmail.com', 1),
(5, 'korisnik1', 'korisnik1passwd', 'korisnik', 'korisnikovic', 'korisnik1@gmail.com', 0),
(6, 'korisnik2', 'korisnik2passwd', 'korisnik', 'korisnikovic', 'korisnik2@gmail.com', 0),
(7, 'korisnik3', 'korisnik3passwd', 'korisnik', 'korisnikovic', 'korisnik3@gmail.com', 0),
(8, 'korisnik4', 'korisnik4passwd', 'korisnik', 'korisnikovic', 'korisnik4@gmail.com', 0),
(9, 'korisnik5', 'lozinka5', 'kor', 'koric', 'kor5@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

CREATE TABLE `ocene` (
  `id` int(10) NOT NULL,
  `korisnik_id` int(10) NOT NULL,
  `film_id` int(10) NOT NULL,
  `ocena` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`id`, `korisnik_id`, `film_id`, `ocena`) VALUES
(1, 5, 1, 10),
(4, 5, 2, 6),
(5, 6, 2, 9),
(6, 6, 8, 2),
(7, 7, 8, 7),
(8, 8, 7, 7),
(9, 8, 6, 8),
(11, 5, 3, 3),
(12, 6, 9, 9),
(13, 5, 9, 4),
(14, 5, 5, 3),
(15, 5, 8, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocene`
--
ALTER TABLE `ocene`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmovi`
--
ALTER TABLE `filmovi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ocene`
--
ALTER TABLE `ocene`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
