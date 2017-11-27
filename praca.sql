-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Lis 2017, 12:16
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `praca`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dni`
--

CREATE TABLE `dni` (
  `Id` int(11) NOT NULL,
  `Id_osoby` int(11) NOT NULL,
  `Dzien` date NOT NULL,
  `Od` time NOT NULL,
  `Do` time NOT NULL,
  `Opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `dni`
--

INSERT INTO `dni` (`Id`, `Id_osoby`, `Dzien`, `Od`, `Do`, `Opis`) VALUES
(1, 1, '2017-11-27', '03:25:00', '11:25:00', 'Wyjazd sÅ‚uÅ¼bowy.'),
(2, 1, '2017-11-28', '12:00:00', '16:00:00', 'Czyszczenie dyskÃ³w.'),
(3, 1, '2017-12-01', '09:00:00', '15:00:00', 'Nauka PHP.'),
(4, 2, '2017-11-27', '06:00:00', '12:00:00', 'Wyjazd sÅ‚uÅ¼bowy.'),
(5, 2, '2017-11-27', '03:41:00', '07:41:00', 'Test.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(1) NOT NULL,
  `imie` varchar(20) COLLATE utf8_bin NOT NULL,
  `nazwisko` varchar(20) COLLATE utf8_bin NOT NULL,
  `login` varchar(32) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `imie`, `nazwisko`, `login`, `password`, `email`, `admin`) VALUES
(1, 'Marcin', 'Chwedoruk', 'admin', '$2y$10$hSR84N.6jJaFlWNfX2UpYeNCjFYIQs1FoZJ4ukZjL3wu1udC4MfNi', 'admin123@wp.pl', 1),
(2, 'Adam', 'ÅšlotaÅ‚a', 'admin2', '$2y$10$h8kndKsQRE8/kVjvkO8eOexAhtnX7tvpf/dqpSP69L3huRbi1bCwy', 'admin@wp.pl', 0),
(3, 'Bartosz', 'Kupka', 'bartosz852', '$2y$10$P9q5tmpgITgn07Cqjb2sIe1MKik3f6mqihQrJBcijDjLLRwo82v1q', 'bartekkupka222@gmail.com', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `dni`
--
ALTER TABLE `dni`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dni`
--
ALTER TABLE `dni`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
