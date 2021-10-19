-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 03, 2020 alle 20:37
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reintegra`
--
CREATE DATABASE IF NOT EXISTS `reintegra` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `reintegra`;

-- --------------------------------------------------------

--
-- Struttura della tabella `elenco_indirizzi`
--

CREATE TABLE `elenco_indirizzi` (
  `id` int(10) NOT NULL,
  `indirizzo` varchar(255) COLLATE utf8_bin NOT NULL,
  `n_tentativi` int(11) NOT NULL DEFAULT '10',
  `is_bloccato` tinyint(4) NOT NULL DEFAULT '0',
  `codice_sblocco` varchar(6) COLLATE utf8_bin NOT NULL,
  `cookie_bloccato` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `menu_voci_ruoli`
--

CREATE TABLE `menu_voci_ruoli` (
  `codice_ruolo` int(10) NOT NULL,
  `codice_menu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `messaggio_id` int(10) NOT NULL,
  `utente_id` int(10) NOT NULL,
  `testo` longtext COLLATE utf8_bin NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `mezzi`
--

CREATE TABLE `mezzi` (
  `mezzo_id` int(10) NOT NULL,
  `codice_mezzo` varchar(50) COLLATE utf8_bin NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `targa` varchar(50) COLLATE utf8_bin NOT NULL,
  `tipo` varchar(255) COLLATE utf8_bin NOT NULL,
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `data_aggiornamento` datetime NOT NULL,
  `isEliminato` tinyint(1) NOT NULL DEFAULT '0',
  `data_eliminazione` timestamp NULL DEFAULT NULL,
  `operatore_eliminazione` varbinary(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `notifica_id` int(10) NOT NULL,
  `utente_id` int(10) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `testo` varchar(4096) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `prodotto_id` int(10) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `totale_magazzino` int(10) NOT NULL,
  `totale_disposizione_militi` int(10) NOT NULL,
  `data_aggiornamento` datetime NOT NULL,
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `etichetta` varchar(255) COLLATE utf8_bin NOT NULL,
  `isEliminato` tinyint(1) NOT NULL DEFAULT '0',
  `data_eliminazione` timestamp NULL DEFAULT NULL,
  `operatore_eliminazione` varbinary(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_negli_zaini`
--

CREATE TABLE `prodotti_negli_zaini` (
  `id_pnz` int(10) NOT NULL,
  `codice_prodotto` int(10) NOT NULL,
  `codice_zaino` int(10) NOT NULL,
  `quantita_attuale` int(10) NOT NULL,
  `quantita_totale` int(10) NOT NULL,
  `data_scadenza` timestamp NULL DEFAULT NULL,
  `isConvalidato` tinyint(1) NOT NULL DEFAULT '0',
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `data_aggiornamento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_nei_mezzi`
--

CREATE TABLE `prodotti_nei_mezzi` (
  `id_pnm` int(10) NOT NULL,
  `codice_prodotto` int(10) NOT NULL,
  `codice_mezzo` int(10) NOT NULL,
  `quantita_attuale` int(10) NOT NULL,
  `quantita_totale` int(10) NOT NULL,
  `data_scadenza` timestamp NULL DEFAULT NULL,
  `isConvalidato` tinyint(1) NOT NULL DEFAULT '0',
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `data_aggiornamento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_nelle_sacche`
--

CREATE TABLE `prodotti_nelle_sacche` (
  `id_pns` int(10) NOT NULL,
  `codice_prodotto` int(10) NOT NULL,
  `codice_sacca` int(10) NOT NULL,
  `quantita_attuale` int(10) NOT NULL,
  `quantita_totale` int(10) NOT NULL,
  `data_scadenza` date DEFAULT NULL,
  `isConvalidato` tinyint(1) NOT NULL DEFAULT '0',
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `data_aggiornamento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_reintegrati`
--

CREATE TABLE `prodotti_reintegrati` (
  `pr_id` int(10) NOT NULL,
  `reintegrazione_id` int(10) NOT NULL,
  `codice_prodotto` int(10) NOT NULL,
  `quantita` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `reintegrazioni`
--

CREATE TABLE `reintegrazioni` (
  `reintegrazione_id` int(10) NOT NULL,
  `utente_id` int(10) NOT NULL,
  `mezzo_id` int(10) NOT NULL,
  `data_reintegro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE `ruoli` (
  `codice_ruolo` int(10) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(255) COLLATE utf8_bin NOT NULL,
  `isOperativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `sacche`
--

CREATE TABLE `sacche` (
  `sacca_id` int(10) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `colore_sacca` varchar(255) COLLATE utf8_bin NOT NULL,
  `mezzo_id` int(10) DEFAULT NULL,
  `zaino_id` int(10) DEFAULT NULL,
  `colore_sigillo` varchar(255) COLLATE utf8_bin NOT NULL,
  `codice_sigillo` varchar(50) COLLATE utf8_bin NOT NULL,
  `data_sigillo` datetime NOT NULL,
  `operatore_sigillo` varbinary(1024) NOT NULL,
  `data_aggiornamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `isEliminato` tinyint(1) NOT NULL DEFAULT '0',
  `data_eliminazione` timestamp NULL DEFAULT NULL,
  `operatore_eliminazione` varbinary(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `storico_sigilli`
--

CREATE TABLE `storico_sigilli` (
  `id_sto_sig` int(10) NOT NULL,
  `codice_sigillo` varchar(50) COLLATE utf8_bin NOT NULL,
  `colore_sigillo` varchar(50) COLLATE utf8_bin NOT NULL,
  `operatore` varbinary(1024) NOT NULL,
  `data_sigillo` datetime NOT NULL,
  `codice_sacca` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `storico_token_accesso`
--

CREATE TABLE `storico_token_accesso` (
  `id_sta` int(10) NOT NULL,
  `codice_qr` varchar(255) COLLATE utf8_bin NOT NULL,
  `utente_id` int(10) NOT NULL,
  `data_assegnazione_token` datetime NOT NULL,
  `operatore_assegnazione_token` varbinary(1024) NOT NULL,
  `data_fine_validita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `t_comuni`
--

CREATE TABLE `t_comuni` (
  `istat` int(11) NOT NULL,
  `comune` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `regione` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `provincia` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `prefisso` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `cod_fisco` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `superficie` double DEFAULT NULL,
  `num_residenti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `utente_id` int(10) NOT NULL,
  `nome` varbinary(1024) NOT NULL,
  `cognome` varbinary(1024) NOT NULL,
  `sesso` varbinary(20) NOT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `numero_dae` varchar(50) COLLATE utf8_bin NOT NULL,
  `isCertificato` tinyint(1) NOT NULL DEFAULT '0',
  `comune_residenza` varbinary(1024) NOT NULL,
  `via` varbinary(1024) NOT NULL,
  `civico` varbinary(50) NOT NULL,
  `interno` varbinary(50) NOT NULL,
  `indirizzo_due` varbinary(255) NOT NULL,
  `numero_tessera` varchar(50) COLLATE utf8_bin NOT NULL,
  `codice_qr` varchar(255) COLLATE utf8_bin NOT NULL,
  `isQrBloccato` tinyint(1) NOT NULL DEFAULT '0',
  `data_ultimo_accesso` timestamp NULL DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_bin NOT NULL,
  `isEliminato` tinyint(1) NOT NULL DEFAULT '0',
  `isBloccato` tinyint(1) NOT NULL DEFAULT '0',
  `data_eliminazione` timestamp NULL DEFAULT NULL,
  `operatore_eliminazione` varchar(255) COLLATE utf8_bin NOT NULL,
  `data_qr_bloccato` timestamp NULL DEFAULT NULL,
  `codice_ruolo` int(10) NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `impronta` varchar(255) COLLATE utf8_bin NOT NULL,
  `data_primo_accesso` timestamp NULL DEFAULT NULL,
  `data_assegnazione_token` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operatore_assegnazione_token` varbinary(1024) NOT NULL,
  `email` varbinary(724) NOT NULL,
  `ultimo_accesso_notifiche` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimo_accesso_messaggi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `voci_menu`
--

CREATE TABLE `voci_menu` (
  `voce_id` int(10) NOT NULL,
  `etichetta` varchar(50) COLLATE utf8_bin NOT NULL,
  `icona` varchar(50) COLLATE utf8_bin NOT NULL,
  `tooltip` varchar(255) COLLATE utf8_bin NOT NULL,
  `codice_padre` int(10) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `isVisibile` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `zaini`
--

CREATE TABLE `zaini` (
  `zaino_id` int(10) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `mezzo_id` int(10) NOT NULL,
  `operatore_aggiornamento` varbinary(1024) NOT NULL,
  `data_aggiornamento` datetime NOT NULL,
  `isEliminato` tinyint(1) NOT NULL DEFAULT '0',
  `data_eliminazione` timestamp NULL DEFAULT NULL,
  `operatore_eliminazione` varbinary(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `elenco_indirizzi`
--
ALTER TABLE `elenco_indirizzi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `menu_voci_ruoli`
--
ALTER TABLE `menu_voci_ruoli`
  ADD PRIMARY KEY (`codice_ruolo`,`codice_menu`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`messaggio_id`);

--
-- Indici per le tabelle `mezzi`
--
ALTER TABLE `mezzi`
  ADD PRIMARY KEY (`mezzo_id`),
  ADD UNIQUE KEY `codice_mezzo` (`codice_mezzo`);

--
-- Indici per le tabelle `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`notifica_id`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`prodotto_id`),
  ADD UNIQUE KEY `etichetta` (`etichetta`);

--
-- Indici per le tabelle `prodotti_negli_zaini`
--
ALTER TABLE `prodotti_negli_zaini`
  ADD PRIMARY KEY (`id_pnz`);

--
-- Indici per le tabelle `prodotti_nei_mezzi`
--
ALTER TABLE `prodotti_nei_mezzi`
  ADD PRIMARY KEY (`id_pnm`);

--
-- Indici per le tabelle `prodotti_nelle_sacche`
--
ALTER TABLE `prodotti_nelle_sacche`
  ADD PRIMARY KEY (`id_pns`);

--
-- Indici per le tabelle `prodotti_reintegrati`
--
ALTER TABLE `prodotti_reintegrati`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indici per le tabelle `reintegrazioni`
--
ALTER TABLE `reintegrazioni`
  ADD PRIMARY KEY (`reintegrazione_id`);

--
-- Indici per le tabelle `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`codice_ruolo`);

--
-- Indici per le tabelle `sacche`
--
ALTER TABLE `sacche`
  ADD PRIMARY KEY (`sacca_id`);

--
-- Indici per le tabelle `storico_sigilli`
--
ALTER TABLE `storico_sigilli`
  ADD PRIMARY KEY (`id_sto_sig`);

--
-- Indici per le tabelle `storico_token_accesso`
--
ALTER TABLE `storico_token_accesso`
  ADD PRIMARY KEY (`id_sta`);

--
-- Indici per le tabelle `t_comuni`
--
ALTER TABLE `t_comuni`
  ADD PRIMARY KEY (`istat`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`utente_id`),
  ADD UNIQUE KEY `codice_qr` (`codice_qr`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `utente_id` (`utente_id`);

--
-- Indici per le tabelle `voci_menu`
--
ALTER TABLE `voci_menu`
  ADD PRIMARY KEY (`voce_id`);

--
-- Indici per le tabelle `zaini`
--
ALTER TABLE `zaini`
  ADD PRIMARY KEY (`zaino_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `elenco_indirizzi`
--
ALTER TABLE `elenco_indirizzi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `messaggio_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `mezzi`
--
ALTER TABLE `mezzi`
  MODIFY `mezzo_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `notifica_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `prodotto_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti_negli_zaini`
--
ALTER TABLE `prodotti_negli_zaini`
  MODIFY `id_pnz` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti_nei_mezzi`
--
ALTER TABLE `prodotti_nei_mezzi`
  MODIFY `id_pnm` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti_nelle_sacche`
--
ALTER TABLE `prodotti_nelle_sacche`
  MODIFY `id_pns` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotti_reintegrati`
--
ALTER TABLE `prodotti_reintegrati`
  MODIFY `pr_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `reintegrazioni`
--
ALTER TABLE `reintegrazioni`
  MODIFY `reintegrazione_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ruoli`
--
ALTER TABLE `ruoli`
  MODIFY `codice_ruolo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `sacche`
--
ALTER TABLE `sacche`
  MODIFY `sacca_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `storico_sigilli`
--
ALTER TABLE `storico_sigilli`
  MODIFY `id_sto_sig` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `storico_token_accesso`
--
ALTER TABLE `storico_token_accesso`
  MODIFY `id_sta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `utente_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `voci_menu`
--
ALTER TABLE `voci_menu`
  MODIFY `voce_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `zaini`
--
ALTER TABLE `zaini`
  MODIFY `zaino_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
