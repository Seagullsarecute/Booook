-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2024 alle 19:07
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

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

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GeneraRecords` ()   BEGIN
  DECLARE i INT DEFAULT 1;
  WHILE i <= 50 DO
    INSERT INTO `copia_libri` (`fk_id_info_libro`, `fk_id_utente`) VALUES (FLOOR(1 + RAND() * 11), FLOOR(1 + RAND() * 12));
    SET i = i + 1;
  END WHILE;
END$$

DELIMITER ;

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
(1, 1, 1, 1),
(2, 5, 12, 9),
(3, 2, 39, 1),
(4, 2, 2, 7),
(5, 3, 50, 9),
(6, 6, 11, 2),
(8, 1, 40, 4),
(9, 1, 35, 10),
(10, 2, 52, 1);

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
(2, 'Splendido, mi ha cambiato la vita', 5, 2, 1),
(3, 'Ho cambiato idea', 2, 2, 1),
(4, 'Un libro molto coinvolgente, non riuscivo a smettere di leggerlo!', 5, 1, 3),
(5, 'Mi è piaciuto molto questo libro, lo consiglio vivamente a tutti gli amanti della fantascienza.', 5, 2, 7),
(6, 'Ho trovato questo libro abbastanza deludente, mi aspettavo di più.', 3, 3, 5),
(7, 'Una lettura piacevole e rilassante, ottima per staccare la mente dalla routine quotidiana.', 4, 4, 8),
(8, 'Non sono riuscito a capire il senso di questo libro, troppo confusionario.', 2, 5, 10),
(9, 'Questo è diventato il mio libro preferito, non vedo l\'ora di leggere altri lavori dell\'autore.', 5, 6, 2),
(10, 'Una storia commovente che mi ha fatto riflettere molto sulla vita.', 5, 7, 1),
(11, 'Consiglio questo libro a tutti coloro che cercano una lettura leggera ma interessante.', 4, 8, 6),
(12, 'Ho trovato questo libro estremamente noioso, non sono riuscito a finirlo.', 2, 9, 11),
(13, 'Un thriller avvincente che mi ha tenuto incollato alle pagine fino all\'ultima.', 5, 10, 4),
(14, 'Non riesco a smettere di pensare a questo libro, mi ha lasciato un\' impressione indelebile.', 5, 11, 9),
(15, 'Una storia toccante che mi ha emozionato profondamente, consigliatissimo', 5, 12, 3),
(16, 'Ho trovato questo libro molto educativo e informativo, lo consiglio a tutti.', 4, 1, 5),
(17, 'Una lettura leggera e divertente, perfetta per rilassarsi nel weekend.', 4, 2, 8),
(18, 'Questo libro mi ha deluso, non è riuscito a catturare la mia attenzione.', 3, 3, 11),
(19, 'Una storia avvincente che mi ha tenuto sveglio tutta la notte.', 5, 4, 7),
(20, 'Non vedo l\'ora di leggere altri libri dello stesso autore, mi ha conquistato completamente.', 5, 5, 2),
(21, 'Un romanzo emozionante che mi ha fatto ridere e piangere, un vero capolavoro.', 5, 6, 6),
(22, 'Ho apprezzato molto questo libro, la trama è ben costruita e i personaggi ben sviluppati.', 4, 7, 4),
(23, 'Una storia intrigante che mi ha tenuto con il fiato sospeso fino all\'ultima pagina.', 5, 8, 10),
(24, 'Questo libro non mi ha coinvolto affatto, l\'ho trovato piatto e poco interessante.', 2, 9, 1),
(25, 'Una lettura che consiglio a tutti, piena di suspense e colpi di scena.', 4, 10, 9),
(26, 'Mi ha sorpreso positivamente questo libro, non mi aspettavo una trama così avvincente.', 4, 11, 3),
(27, 'Una storia emozionante e profonda, mi ha fatto riflettere molto sulla natura umana.', 5, 12, 8),
(28, 'Ho trovato questo libro molto stimolante, mi ha aperto nuove prospettive di pensiero.', 4, 1, 2),
(29, 'Un libro che non consiglierei, la trama è poco credibile e i personaggi poco convincenti.', 2, 2, 11),
(30, 'Mi sono emozionato molto leggendo questo libro, una storia indimenticabile.', 5, 3, 7),
(31, 'Una lettura coinvolgente che consiglio a tutti gli amanti del genere.', 4, 4, 4),
(32, 'Questo libro mi ha deluso, mi aspettavo di più dalla trama e dai personaggi.', 3, 5, 6),
(33, 'BELLISSIMO, VIVA ROMA CITTA ETERNA DAJE', 5, 2, 11);

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
(1, 1, 1),
(2, 6, 2),
(3, 1, 11),
(4, 3, 6),
(5, 9, 6),
(6, 1, 10),
(7, 9, 8),
(8, 9, 10),
(9, 8, 2),
(10, 8, 2),
(11, 4, 6),
(12, 2, 5),
(13, 6, 7),
(14, 1, 6),
(15, 5, 9),
(16, 3, 11),
(17, 11, 12),
(18, 11, 11),
(19, 5, 7),
(20, 7, 4),
(21, 9, 9),
(22, 5, 10),
(23, 11, 3),
(24, 5, 3),
(25, 1, 5),
(26, 8, 4),
(27, 7, 2),
(28, 4, 8),
(29, 1, 3),
(30, 1, 6),
(31, 5, 8),
(32, 10, 6),
(33, 9, 8),
(34, 7, 2),
(35, 2, 1),
(36, 9, 10),
(37, 9, 7),
(38, 3, 8),
(39, 5, 2),
(40, 3, 1),
(41, 6, 7),
(42, 10, 1),
(43, 4, 8),
(44, 11, 3),
(45, 7, 7),
(46, 11, 2),
(47, 10, 10),
(48, 6, 3),
(49, 5, 6),
(50, 2, 3),
(51, 9, 12),
(52, 17, 2),
(53, 10, 1),
(54, 16, 1),
(55, 9, 1);

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
  `src` varchar(100) NOT NULL DEFAULT 'generic.png',
  `rating` double DEFAULT NULL,
  `casa_editrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `info_libri`
--

INSERT INTO `info_libri` (`id_info_libro`, `titolo`, `autore`, `genere`, `descrizione`, `src`, `rating`, `casa_editrice`) VALUES
(1, 'LE AVVENTUREH MIAOSE', 'erGatto', 'thriller', 'AO sto libbro è fichissimo, dovete leggerlo, parla del gatto no? E ha delle AVVENTUREH???? ziopera leggetelo.', 'LE AVVENTUREH MIAOSE.png', 3.7, 'Gattastico'),
(2, 'Il Segreto del Tempo', 'Luca Bianchi', 'fantascienza', 'Un viaggio straordinario attraverso le pieghe del tempo, dove ogni scelta può cambiare il destino dell\'umanità.', 'segreto-tempo.png', 4.7, 'Nuove Sfere'),
(3, 'I Sapori del Mediterraneo', 'Antonia Moretti', 'cucina', 'Esplora le ricette più gustose e i segreti culinari delle coste mediterranee, raccolti in un libro che è un vero e proprio viaggio sensoriale.', 'cibo_mediterraneo.png', 4.7, 'Gusto e Tradizione'),
(4, 'La Caduta degli Dei', 'Francesco Rossi', 'fantasy', 'In un mondo dove gli dei camminano tra gli uomini, una guerra celeste minaccia di distruggere ogni cosa. Segui le avventure di eroi e mortali nel tentativo di salvare il loro mondo.', 'la-caduta-degli-dei.png', 4.7, 'Fantasia Epica'),
(5, 'Voci Nascoste', 'Giulia Fiore', 'thriller', 'Un thriller psicologico che ti porterà nei meandri della mente umana, dove i segreti più oscuri si svelano pagina dopo pagina.', 'generic.png', 3.5, 'Suspense'),
(6, 'L\'Eredità Perduta', 'Marco Neri', 'avventura', 'Un romanzo d\'avventura che segue le orme di un antico mistero, portando il lettore in un viaggio mozzafiato attraverso continenti dimenticati.', 'eredita-perduta.png', 4, 'Avventura Storica'),
(7, 'Riflessi d\'Amore', 'Sofia Bianchi', 'romantico', 'Una storia d\'amore che sfida il tempo, raccontata attraverso le lettere di due amanti separati dalla guerra ma uniti dal destino.', 'generic.png', 5, 'Cuore e Passione'),
(8, 'Il Giardino delle Ombre', 'Claudio Verdi', 'horror', 'Scopri cosa si nasconde dietro le siepi di un antico giardino inglese, in un romanzo horror che ti farà dubitare di ogni ombra.', 'giardino_ombre.png', 4.3, 'Brividi Notturni'),
(9, 'Codice Millenario', 'Alessandra Gialli', 'giallo', 'Un enigma secolare è sul punto di essere risolto, ma ci sono forze oscure che faranno di tutto per mantenere il segreto. Un thriller storico che unisce mistero e azione.', 'generic.png', 4.5, 'Mistero Antico'),
(10, 'Sussurri del Passato', 'Elena Grigio', 'drammatico', 'La storia di una famiglia segnata da un passato doloroso, dove ogni rivelazione porta a nuove domande e antichi rimorsi.', 'generic.png', 3.5, 'Dramma Familiare'),
(11, 'Le Stelle di Roma', 'Giorgio Celeste', 'storico', 'Un romanzo storico che illumina le vite di coloro che hanno costruito l\'impero più grande del mondo antico, mostrando la grandezza e la caducità del potere.', 'roma.png', 3, 'Epica Romana'),
(16, 'test', 'test', 'test', 'ao', 'test.png', NULL, 'Unknown'),
(17, 'generic', 'generic', 'generic', 'descrizione generica ciao', 'generic.png', NULL, 'Unknown');

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

--
-- Dump dei dati per la tabella `scambi`
--

INSERT INTO `scambi` (`id_scambio`, `data`, `ora`, `fk_id_utente1`, `fk_id_utente2`, `fk_id_copia_libro1`, `fk_id_copia_libro2`) VALUES
(1, '2024-05-24', '17:19:58', 3, 2, 34, 44),
(2, '2024-05-24', '18:36:25', 1, 2, 27, 55);

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
  `tipo` varchar(50) NOT NULL,
  `srcUser` varchar(8) NOT NULL DEFAULT 'icon.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nome`, `cognome`, `email`, `pw`, `tipo`, `srcUser`) VALUES
(1, 'Luca', 'Donalduck', 'luca@a.a', 'ff377aff39a9345a9cca803fb5c5c081', 'user', 'icon.png'),
(2, 'Ash', 'Efficie', 'ash@a.a', '2852f697a9f8581725c6fc6a5472a2e5', 'admin', 'icon.png'),
(3, 'Marco', 'Bianchi', 'marco.bianchi@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(4, 'Giulia', 'Rossi', 'giulia.rossi@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(5, 'Alessandro', 'Verdi', 'alessandro.verdi@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(6, 'Sofia', 'Gialli', 'sofia.gialli@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(7, 'Matteo', 'Neri', 'matteo.neri@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(8, 'Francesca', 'Marrone', 'francesca.marrone@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(9, 'Luigi', 'Grigio', 'luigi.grigio@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(10, 'Chiara', 'Arancio', 'chiara.arancio@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(11, 'Gianni', 'Celeste', 'gianni.celeste@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png'),
(12, 'Anna', 'Rosa', 'anna.rosa@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'user', 'icon.png');

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
  MODIFY `id_annuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `copia_libri`
--
ALTER TABLE `copia_libri`
  MODIFY `id_copia_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT per la tabella `info_libri`
--
ALTER TABLE `info_libri`
  MODIFY `id_info_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `scambi`
--
ALTER TABLE `scambi`
  MODIFY `id_scambio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
