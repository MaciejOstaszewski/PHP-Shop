-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Maj 2017, 12:34
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- mb4
-- Baza danych: `sklep_komputerowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--
DROP DATABASE IF EXISTS `sklep_komputerowy`;
CREATE DATABASE `sklep_komputerowy`;

USE `sklep_komputerowy`;


DROP TABLE IF EXISTS `kategorie`;
CREATE TABLE `kategorie` (
  `id_kategorii` int(11) NOT NULL,
  `nazwa_kategorii` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--
DROP TABLE IF EXISTS `klienci`;
CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(30) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `nr_telefonu` varchar(30) DEFAULT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--
DROP TABLE IF EXISTS `pracownicy`;
CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(30) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `nr_telefonu` varchar(12) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `pensja` decimal(10,2) NOT NULL,
  `uprawnienia` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzedaz`
--
DROP TABLE IF EXISTS `sprzedaz`;
CREATE TABLE `sprzedaz` (
  `id_sprzedazy` int(11) NOT NULL,
  `id_zamowienia_klienci` int(11) NOT NULL,
  `id_towaru` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `towary`
--
DROP TABLE IF EXISTS `towary`;
CREATE TABLE `towary` (
  `id_towaru` int(11) NOT NULL,
  `nazwa` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `marka` varchar(30) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `ilosc_w_magazynie` int(11) NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `id_typu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_towaru`
--
DROP TABLE IF EXISTS `typ_towaru`;
CREATE TABLE `typ_towaru` (
  `id_typu_towaru` int(11) NOT NULL,
  `nazwa_typu` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `id_kategorii` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zakup`
--
DROP TABLE IF EXISTS `zakup`;
CREATE TABLE `zakup` (
  `id_zakupu` int(11) NOT NULL,
  `id_towaru` int(11) NOT NULL,
  `id_zamowienia_sklep` int(11) NOT NULL,
  `ilosc_towaru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_klienci`
--
DROP TABLE IF EXISTS `zamowienia_klienci`;
CREATE TABLE `zamowienia_klienci` (
  `id_zamowienia` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `wartosc_zamowienia_klienci` decimal(10,2) NOT NULL,
  `data_zlorzenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_sklep`
--
DROP TABLE IF EXISTS `zamowienia_sklep`;
CREATE TABLE `zamowienia_sklep` (
  `id_zamowienia` int(11) NOT NULL,
  `data_zamowienia` date DEFAULT NULL,
  `wartosc_zamowienia_sklep` decimal(10,2) NOT NULL,
  `id_pracownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategorii`),
  ADD UNIQUE KEY `id_kategorii_UNIQUE` (`id_kategorii`);

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`),
  ADD UNIQUE KEY `id_klienta_UNIQUE` (`id_klienta`);

--
-- Indexes for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownika`),
  ADD UNIQUE KEY `id_pracownika_UNIQUE` (`id_pracownika`);

--
-- Indexes for table `sprzedaz`
--
ALTER TABLE `sprzedaz`
  ADD PRIMARY KEY (`id_sprzedazy`),
  ADD UNIQUE KEY `id_sprzedarzy_UNIQUE` (`id_sprzedazy`),
  ADD KEY `id_zamowienia_klienci` (`id_zamowienia_klienci`),
  ADD KEY `id_towaru` (`id_towaru`) USING BTREE;

--
-- Indexes for table `towary`
--
ALTER TABLE `towary`
  ADD PRIMARY KEY (`id_towaru`),
  ADD UNIQUE KEY `id_towaru_UNIQUE` (`id_towaru`),
  ADD KEY `id_typu` (`id_typu`),
  ADD KEY `id_kategorii` (`id_kategorii`) USING BTREE;

--
-- Indexes for table `typ_towaru`
--
ALTER TABLE `typ_towaru`
  ADD PRIMARY KEY (`id_typu_towaru`),
  ADD UNIQUE KEY `id_typu_towaru` (`id_typu_towaru`),
  ADD KEY `id_kategorii` (`id_kategorii`) USING BTREE;

--
-- Indexes for table `zakup`
--
ALTER TABLE `zakup`
  ADD PRIMARY KEY (`id_zakupu`),
  ADD UNIQUE KEY `id_zakupu` (`id_zakupu`),
  ADD KEY `id_zamowienia` (`id_zamowienia_sklep`) USING BTREE,
  ADD KEY `id_towaru` (`id_towaru`) USING BTREE;

--
-- Indexes for table `zamowienia_klienci`
--
ALTER TABLE `zamowienia_klienci`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD UNIQUE KEY `id_zamowienia` (`id_zamowienia`),
  ADD KEY `id_klienta` (`id_klienta`);

--
-- Indexes for table `zamowienia_sklep`
--
ALTER TABLE `zamowienia_sklep`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD UNIQUE KEY `id_zamowienia_UNIQUE` (`id_zamowienia`),
  ADD KEY `id_pracownika` (`id_pracownika`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategorii` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `sprzedaz`
--
ALTER TABLE `sprzedaz`
  MODIFY `id_sprzedazy` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `towary`
--
ALTER TABLE `towary`
  MODIFY `id_towaru` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `typ_towaru`
--
ALTER TABLE `typ_towaru`
  MODIFY `id_typu_towaru` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `zakup`
--
ALTER TABLE `zakup`
  MODIFY `id_zakupu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `zamowienia_klienci`
--
ALTER TABLE `zamowienia_klienci`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `zamowienia_sklep`
--
ALTER TABLE `zamowienia_sklep`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `sprzedaz`
--
ALTER TABLE `sprzedaz`
  ADD CONSTRAINT `sprzedaz_ibfk_1` FOREIGN KEY (`id_towaru`) REFERENCES `towary` (`id_towaru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sprzedaz_ibfk_2` FOREIGN KEY (`id_zamowienia_klienci`) REFERENCES `zamowienia_klienci` (`id_zamowienia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `towary`
--
ALTER TABLE `towary`
  ADD CONSTRAINT `towary_ibfk_1` FOREIGN KEY (`id_typu`) REFERENCES `typ_towaru` (`id_typu_towaru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `towary_ibfk_2` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie` (`id_kategorii`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `typ_towaru`
--
ALTER TABLE `typ_towaru`
  ADD CONSTRAINT `typ_towaru_ibfk_1` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie` (`id_kategorii`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zakup`
--
ALTER TABLE `zakup`
  ADD CONSTRAINT `zakup_ibfk_1` FOREIGN KEY (`id_zamowienia_sklep`) REFERENCES `zamowienia_sklep` (`id_zamowienia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zakup_ibfk_2` FOREIGN KEY (`id_towaru`) REFERENCES `towary` (`id_towaru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia_klienci`
--
ALTER TABLE `zamowienia_klienci`
  ADD CONSTRAINT `zamowienia_klienci_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia_sklep`
--
ALTER TABLE `zamowienia_sklep`
  ADD CONSTRAINT `zamowienia_sklep_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO pracownicy (`imie`, `nazwisko`, `nr_telefonu`, `Email`, `haslo`, `pensja`, `uprawnienia`) VALUES ('Jan','Kowalski','423546345','jan_kowalski@gmail.com','admin','4000.00','administrator');
INSERT INTO pracownicy (`imie`, `nazwisko`, `nr_telefonu`, `Email`, `haslo`, `pensja`, `uprawnienia`) VALUES ('Adam','Nowak','873252345','adam_nowak@gmail.com','qwerty','2500.00','pracownik');
INSERT INTO pracownicy (`imie`, `nazwisko`, `nr_telefonu`, `Email`, `haslo`, `pensja`, `uprawnienia`) VALUES ('Piotr','Wiśniewski','234665423','piotr_wisnieski@gmail.com','zaq12wsx','2500.00','pracownik');
INSERT INTO pracownicy (`imie`, `nazwisko`, `nr_telefonu`, `Email`, `haslo`, `pensja`, `uprawnienia`) VALUES ('Bartosz','Brzozowski','23454332','bartosz_brzozowski@gmail.com','12345','3000.00','pracownik');
INSERT INTO pracownicy (`imie`, `nazwisko`, `nr_telefonu`, `Email`, `haslo`, `pensja`, `uprawnienia`) VALUES ('Artur','Lewandowski','234322123','artur_lewandowski@gmail.com','ytrewq','3000.00','pracownik');

-- inserty ze storny www.mockaroo.com

insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Dannie', 'Elfleet', '219077922', 'delfleet0@bandcamp.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Blakeley', 'Madgewick', '795624575', 'bmadgewick1@slideshare.net');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Lotty', 'Benning', '855224208', 'lbenning2@ask.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Angelle', 'De Robertis', '836869363', 'aderobertis3@google.fr');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Marybelle', 'Danjoie', '416699233', 'mdanjoie4@hp.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Carly', 'Forsard', '448064958', 'cforsard5@skyrock.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Hermione', 'Accum', '005785277', 'haccum6@163.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Sonny', 'Kinahan', '624151560', 'skinahan7@bloglines.com');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Sabina', 'Minall', '190786126', 'sminall8@youtu.be');
insert into klienci (imie, nazwisko, nr_telefonu, Email) values ('Malva', 'Cicchinelli', '170948975', 'mcicchinelli9@cbsnews.com');

INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Myszki');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Monitory');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Klawiatury');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Słuchawki');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Głośniki');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Drukarki');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Dyski Twarde');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Karty Graficzne');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Zasilacze');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Płyty Główne');
INSERT INTO kategorie (`nazwa_kategorii`) VALUES ('Procesory');

INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Laserowe', '1');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Optyczne', '1');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('LCD', '2');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('OLED', '2');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Plazmowe', '2');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Mechaniczne', '3');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Membranowe', '3');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Zamknięte', '4');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Otwarte', '4');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Tunelowe', '4');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Wysokotonowe', '5');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Średniotonowe', '5');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Niskotonowe', '5');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Atramętowe', '6');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Laserowe', '6');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Igłowe', '6');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('HDD', '7');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('SSD', '7');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Hybrydowe', '7');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Zintegrowane', '8');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Nie zintegrowane', '8');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Impulsowe', '9');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Tradycyjne', '9');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('AT', '10');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('ATX', '10');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Jednordzeniwe', '11');
INSERT INTO typ_towaru (`nazwa_typu`, `id_kategorii`) VALUES ('Wielordyeniowe', '11');

INSERT INTO towary (`nazwa`, `model`, `marka`, `cena`, `ilosc_w_magazynie`, `id_kategorii`, `id_typu`) VALUES ('Zowie', 'FK1', 'BenQ', '220.99', '10', '1', '1');
INSERT INTO towary (`nazwa`, `model`, `marka`, `cena`, `ilosc_w_magazynie`, `id_kategorii`, `id_typu`) VALUES ('AccuSync', '223', 'NEC', '690.99', '5', '2', '3');
INSERT INTO towary (`nazwa`, `model`, `marka`, `cena`, `ilosc_w_magazynie`, `id_kategorii`, `id_typu`) VALUES ('Radeon', 'HD 7870', 'ATI', '820.99', '3', '8', '18');
