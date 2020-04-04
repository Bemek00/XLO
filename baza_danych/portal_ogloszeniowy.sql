-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Kwi 2020, 20:57
-- Wersja serwera: 10.4.6-MariaDB
-- Wersja PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `portal ogloszeniowy`
--
CREATE DATABASE IF NOT EXISTS `portal ogloszeniowy` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `portal ogloszeniowy`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `id_ogloszenia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `tytul` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `cena` int(10) DEFAULT NULL,
  `zdjcie` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `typ` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` date NOT NULL,
  `kategoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `stan` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`id_ogloszenia`, `id_uzytkownika`, `tytul`, `opis`, `cena`, `zdjcie`, `typ`, `data_dodania`, `kategoria`, `stan`) VALUES
(1, 1, 'Volkswagen Golf 6', 'Auto w pełni sprawne. Brak wycieków z silnika', 9000, 'zdjecia/volkswagengolf6.jpg', 'sprzedaz', '2019-11-15', 'Motoryzacja', 'aktywny'),
(2, 1, 'Samsung Galaxy a6', 'Nowy telefon, opakowanie nieotwarte. Gwarancja na 2 lata. Kolor do wyboru. W zestawie słuchawki.', 950, 'zdjecia/samsunggalaxya6.jpg', 'sprzedaz', '2019-11-16', 'Elektronika', 'aktywny'),
(3, 1, 'Polonez', 'Mam do sprzedania uszkodzonego poloneza. Jestem właścicielem auta od samego początku.', 1500, 'zdjecia/polonaz.jpg', 'sprzedaz', '2019-11-17', 'Motoryzacja', 'aktywny'),
(4, 3, 'Klawiatura mechaniczna', 'Bardzo fajna klawiatura. Jest podświetlana. ', 250, 'zdjecia/klawmech.jpg', 'sprzedaz', '2019-11-17', 'Elektronika', 'aktywny'),
(5, 6, 'Lodówka z żywnością', 'Pełna lodówka z jedzonkiem.', 699, 'zdjecia/lodowka.jpg', 'sprzedaz', '2019-11-17', 'Elektronika', 'aktywny'),
(6, 7, 'Procesor Intel i9', 'Nowy procesor. Z gwarancją na 24 miesiące.', 1200, 'zdjecia/i9.jpg', 'sprzedaz', '2019-11-19', 'Elektronika', 'aktywny'),
(7, 1, 'Toster', 'Toster w pełni sprawny. Używany 2 razy dziennie.', 199, 'zdjecia/toster.jpg', 'sprzedaz', '2019-11-19', 'Elektronika', 'aktywny'),
(8, 1, 'Fiat 126p', 'Sprzedam działającego malucha. Syn gratis.', 3576, 'zdjecia/126p.jpg', 'sprzedaz', '2019-11-19', 'Motoryzacja', 'aktywny'),
(9, 8, 'Bluzka damska ', 'Biała bluzka. jak nowa', 95, 'zdjecia/bluzka.jpg', 'sprzedaz', '2019-11-19', 'Moda', 'aktywny'),
(10, 8, 'Owczarek niemiecki długowłosy', 'Owczarek urodził się w hodowli \"Pod Marklowicami\". Szczeniak jest odrobaczony i zaszczepiony, jest w pełni samodzielny.  ', 1200, 'zdjecia/owczrek.jpg', 'sprzedaz', '2019-11-19', 'Zwierzęta', 'aktywny'),
(12, 9, 'Geralt z Rivii', 'Wiedźmin do wynajęcia. Poradzi się z każdym twoim problemem. Nie ma uczuć.', 9999, 'zdjecia/download.jpg', 'sprzedaz', '2020-04-02', 'Praca', 'aktywny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id_uzytkownika` int(11) NOT NULL,
  `imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id_uzytkownika`, `imie`, `nazwisko`, `email`, `telefon`, `haslo`) VALUES
(1, 'Patryk', 'Bohm', 'patrykbohm1@onet.pl', '557106600', 'bemek123'),
(2, 'Izabela', 'Polnik', 'bella07@gmail.com', '324546387', 'izka123'),
(3, 'Łukasz', 'Bohm', 'lukiibohm123@gmail.com', '515353117', 'bemek1234'),
(4, 'Roman', 'Bzdek', 'Bzdeczek@onet.com', '645892896', 'bzdek123'),
(5, 'Amadeusz', 'Krzyżanowski', 'Krzyższ@wp.pl', '958357936', 'nowski'),
(6, 'Mateusz', 'Balawajder', 'mateuszbalawajder@gmail.com', '987789321', 'mateuszbalawajder'),
(7, 'Szymon', 'Jędrzejwski', 'szymek2000@gmail.com', '456767391', 'szymek'),
(8, 'Ada', 'Barteczko', 'k.barteczko@wp.pl', '123456789', 'ada'),
(9, 'Waldemar', 'Dzinks', 'zst@gmail.com', '564539956', 'zst');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`id_ogloszenia`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `id_ogloszenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD CONSTRAINT `ogloszenia_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownik` (`id_uzytkownika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
