-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 20, 2024 alle 12:22
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booook`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annunci`
--

CREATE TABLE `annunci` (
  `id_annuncio` int(11) NOT NULL,
  `fk_id_utente` int(11) NOT NULL,
  `fk_id_copia_libro_scambiato` int(11) NOT NULL,
  `fk_id_info_libro_richiesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `annunci`
--

INSERT INTO `annunci` (`id_annuncio`, `fk_id_utente`, `fk_id_copia_libro_scambiato`, `fk_id_info_libro_richiesto`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `id_commento` int(11) NOT NULL,
  `testo` varchar(1000) NOT NULL,
  `rating` float NOT NULL,
  `fk_id_utente` int(11) NOT NULL,
  `fk_id_info_libro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `commenti`
--

INSERT INTO `commenti` (`id_commento`, `testo`, `rating`, `fk_id_utente`, `fk_id_info_libro`) VALUES
(1, 'OOOOOOOOOO MEOW', 4, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `copia_libri`
--

CREATE TABLE `copia_libri` (
  `id_copia_libro` int(11) NOT NULL,
  `fk_id_info_libro` int(11) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `copia_libri`
--

INSERT INTO `copia_libri` (`id_copia_libro`, `fk_id_info_libro`, `fk_id_utente`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `info_libri`
--

CREATE TABLE `info_libri` (
  `id_info_libro` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `autore` varchar(50) NOT NULL,
  `genere` varchar(50) NOT NULL,
  `descrizione` varchar(1024) NOT NULL,
  `src` varchar(100) DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `casa_editrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `info_libri`
--

INSERT INTO `info_libri` (`id_info_libro`, `titolo`, `autore`, `genere`, `descrizione`, `src`, `rating`, `casa_editrice`) VALUES
(1, 'LE AVVENTUREH MIAOSE', 'erGatto', 'thriller', 'AO sto libbro è fichissimo, dovete leggerlo, parla del gatto no? E ha delle AVVENTUREH???? ziopera leggetelo.', '', 0, 'Gattastico');

-- --------------------------------------------------------

--
-- Struttura della tabella `scambi`
--

CREATE TABLE `scambi` (
  `id_scambio` int(11) NOT NULL,
  `data` varchar(30) NOT NULL,
  `ora` varchar(30) NOT NULL,
  `fk_id_utente1` int(11) NOT NULL,
  `fk_id_utente2` int(11) NOT NULL,
  `fk_id_copia_libro1` int(11) NOT NULL,
  `fk_id_copia_libro2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pw` varchar(70) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nome`, `cognome`, `email`, `pw`, `tipo`) VALUES
(1, 'Luca', 'Donalduck', 'luca@a.a', 'ff377aff39a9345a9cca803fb5c5c081', 'user'),
(2, 'Ash', 'Efficie', 'ash@a.a', '2852f697a9f8581725c6fc6a5472a2e5', 'admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `annunci`
--
ALTER TABLE `annunci`
  ADD PRIMARY KEY (`id_annuncio`),
  ADD KEY `fkUtenteAnnuncio` (`fk_id_utente`),
  ADD KEY `fkCopiaLibroScambiato` (`fk_id_copia_libro_scambiato`),
  ADD KEY `fkInfoLibroRichiesto` (`fk_id_info_libro_richiesto`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`id_commento`),
  ADD KEY `fkUtente` (`fk_id_utente`),
  ADD KEY `fkInfoLibroCommento` (`fk_id_info_libro`);

--
-- Indici per le tabelle `copia_libri`
--
ALTER TABLE `copia_libri`
  ADD PRIMARY KEY (`id_copia_libro`),
  ADD KEY `fkInfoLibro` (`fk_id_info_libro`),
  ADD KEY `fkUtente` (`fk_id_utente`);

--
-- Indici per le tabelle `info_libri`
--
ALTER TABLE `info_libri`
  ADD PRIMARY KEY (`id_info_libro`);

--
-- Indici per le tabelle `scambi`
--
ALTER TABLE `scambi`
  ADD PRIMARY KEY (`id_scambio`),
  ADD KEY `fkUtente1` (`fk_id_utente1`),
  ADD KEY `fkUtente2` (`fk_id_utente2`),
  ADD KEY `fkCopiaLibro1` (`fk_id_copia_libro1`),
  ADD KEY `fkCopiaLibro2` (`fk_id_copia_libro2`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `annunci`
--
ALTER TABLE `annunci`
  MODIFY `id_annuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `copia_libri`
--
ALTER TABLE `copia_libri`
  MODIFY `id_copia_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `info_libri`
--
ALTER TABLE `info_libri`
  MODIFY `id_info_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `scambi`
--
ALTER TABLE `scambi`
  MODIFY `id_scambio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `annunci`
--
ALTER TABLE `annunci`
  ADD CONSTRAINT `annunci_ibfk_1` FOREIGN KEY (`fk_id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `annunci_ibfk_2` FOREIGN KEY (`fk_id_copia_libro_scambiato`) REFERENCES `copia_libri` (`id_copia_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `annunci_ibfk_3` FOREIGN KEY (`fk_id_info_libro_richiesto`) REFERENCES `info_libri` (`id_info_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`fk_id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`fk_id_info_libro`) REFERENCES `info_libri` (`id_info_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `copia_libri`
--
ALTER TABLE `copia_libri`
  ADD CONSTRAINT `copia_libri_ibfk_1` FOREIGN KEY (`fk_id_info_libro`) REFERENCES `info_libri` (`id_info_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `copia_libri_ibfk_2` FOREIGN KEY (`fk_id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `scambi`
--
ALTER TABLE `scambi`
  ADD CONSTRAINT `scambi_ibfk_1` FOREIGN KEY (`fk_id_utente1`) REFERENCES `utenti` (`id_utente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scambi_ibfk_2` FOREIGN KEY (`fk_id_utente2`) REFERENCES `utenti` (`id_utente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scambi_ibfk_3` FOREIGN KEY (`fk_id_copia_libro1`) REFERENCES `copia_libri` (`id_copia_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scambi_ibfk_4` FOREIGN KEY (`fk_id_copia_libro2`) REFERENCES `copia_libri` (`id_copia_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
