-- CREAZIONE DELLE VOCI DI MENU

INSERT INTO `voci_menu` (`voce_id`, `etichetta`, `icona`, `tooltip`, `codice_padre`, `url`, `isVisibile`) VALUES
(1, 'Anagrafica', 'fas fa-users', '', 0, 'anagrafica', 1),
(2, 'Aggiungi utente', '', '', 1, 'creaUtente.php', 1),
(3, 'Lista utenti', '', '', 1, 'listaUtenti.php', 1),
(4, 'Gestione badge', '', '', 1, 'listaBadgeAccesso.php', 1),
(5, 'Gestione ruoli', '', '', 1, 'gestioneRuoli.php', 1),
(6, 'Veicoli', 'fas fa-ambulance', '', 0, 'veicoli', 1),
(7, 'Aggiungi veicolo', 'fas fa-ambulance', '', 6, 'aggiungiVeicolo.php', 1),
(8, 'Lista veicoli', 'fas fa-ambulance', '', 6, 'listaVeicoli.php', 1),
(9, 'Zaini', 'fas fa-suitcase-rolling', '', 0, 'zaini', 1),
(10, 'Aggiungi zaino', 'fas fa-suitcase-rolling', '', 9, 'aggiungiZaino.php', 1),
(11, 'Lista zaini', '', '', 9, 'listaZaini.php', 1),
(12, 'Sacche', 'fas fa-suitcase', '', 0, 'sacche', 1),
(13, 'Aggiungi sacca', 'fas fa-suitcase', '', 12, 'aggiungiSacca.php', 1),
(14, 'Lista sacche', 'fas fa-suitcase', '', 12, 'listaSacche.php', 1),
(15, 'Prodotti', 'fas fa-notes-medical', '', 0, 'prodotti', 1),
(16, 'Aggiungi prodotto', 'fas fa-notes-medical', '', 15, 'schedaProdotto.php', 1),
(17, 'Lista prodotti', 'fas fa-notes-medical', '', 15, 'listaProdotti.php', 1),
(18, 'Lista etichette', 'fas fa-notes-medical', '', 15, 'listaQrProdotti.php', 1),
(19, 'Checklist', 'fas fa-clipboard-list', '', 0, 'checklist', 1),
(20, 'Lista checklist', 'fas fa-clipboard-list', '', 19, 'listaCheckList.php', 1),
(21, 'Reintegri', 'fas fa-people-carry', '', 0, 'reintegri', 1),
(22, 'Lista reintegri', 'fas fa-people-carry', '', 21, 'listaReintegri.php', 1),
(23, 'Classifica', 'fas fa-people-carry', '', 21, 'classificaReintegri.php', 1),
(24, 'Notifiche', 'fas fa-bell', '', 0, 'notifiche', 1),
(25, 'Lista notifiche', 'fas fa-bell', '', 24, 'listaNotifiche.php', 1),
(26, 'Messaggi', 'fas fa-envelope', '', 0, 'messaggi', 1),
(27, 'Lista messaggi', 'fas fa-envelope', '', 26, 'listaMessaggi.php', 1),
(28, 'Supporto tecnico', 'fas fa-cogs', '', 0, 'supporto', 1),
(29, 'Crediti', 'fas fa-cogs', '', 28, 'crediti.php', 1),
(30, 'Documentazione', 'fas fa-cogs', '', 28, 'https://github.com/RiccardoRiggi/NewReintegrApp', 1),
(31, 'Homepage', '', '', 28, 'index.php', 0),
(32, 'Modifica Utente', '', '', 1, 'modificaUtente.php', 0),
(33, 'Stampa Badge Singolo', '', '', 1, 'stampaBadgeAccessoSingolo.php', 0),
(34, 'Stampa Badge Gruppo', '', '', 1, 'stampaBadgeAccessoDiGruppo.php', 0),
(35, 'Modifica Veicolo', '', '', 6, 'modificaVeicolo.php', 0),
(36, 'Modifica Zaino', '', '', 9, 'modificaZaino.php', 0),
(37, 'Modifica Sacca', '', '', 12, 'modificaSacca.php', 0),
(38, 'Stampa Etichetta', '', '', 15, 'stampaQrProdottiDiGruppo.php', 0),
(39, 'Scheda Checklist', '', '', 19, 'schedaCheckList.php', 0),
(40, 'Scheda Reintegro', '', '', 21, 'schedaReintegro.php', 0),
(41, 'Lista Prodotti Strategica', '', '', 15, 'listaStrategica.php', 0);

-- CREAZIONE UTENTE INIZIALE SUPERUSER CON LE SEGUENTI CREDENZIALI
-- info@ghiroinformatico.net - Alice02
INSERT INTO `utenti` (`utente_id`, `nome`, `cognome`, `sesso`, `data_di_nascita`, `numero_dae`, `isCertificato`, `comune_residenza`, `via`, `civico`, `interno`, `indirizzo_due`, `numero_tessera`, `codice_qr`, `isQrBloccato`, `data_ultimo_accesso`, `note`, `isEliminato`, `isBloccato`, `data_eliminazione`, `operatore_eliminazione`, `data_qr_bloccato`, `codice_ruolo`, `password`, `impronta`, `data_primo_accesso`, `data_assegnazione_token`, `operatore_assegnazione_token`, `email`, `ultimo_accesso_notifiche`, `ultimo_accesso_messaggi`) VALUES
(1, 0x6dc53dd0186b937d407cacbca198d0a0, 0x66f19da4135db8c732832c548d8746df, 0xe9a975df15987420d602602c512929e4, '0000-00-00', '', 0, 0x052765a910bca55e7381162e7500e627, 0x052765a910bca55e7381162e7500e627, 0x052765a910bca55e7381162e7500e627, 0x052765a910bca55e7381162e7500e627, '', '4205', 'lm2eXPgBX52toAGPuECoLLm9r3Yb7fo1vxFlmaFGOXl8dgtnkJ', 0, '2021-10-16 18:11:36', '', 0, 0, NULL, '', NULL, 9, 'a22eafe5c39809b291f7b289bdf07521', 'hAFS3jJVSFSuxql8nSC6yEWH467TSHRJvxg', '2021-10-16 17:16:04', '2021-10-16 17:09:34', 0x052765a910bca55e7381162e7500e627, 0x6d5502b202e0e2950af5334e3929bede2184a40fd76945932210b5f304f6f792, '2021-10-16 20:06:38', '2021-10-16 19:09:34');

-- USANDO QUESTA QUERY POSSIAMO SCEGLIERE UNA CHIAVE CRITTOGRAFICA DIVERSA (DEVE ESSERE AGGIORNATA NEI FILE DI CONFIGURAZIONE) - LA PSW DEVE ESSERE HASHATA IN MD5 MEDIANTE UN SERVIZIO ESTERNO
INSERT INTO utenti (nome,cognome,sesso,data_di_nascita,numero_dae,isCertificato,comune_residenza,via,civico,interno,numero_tessera,email,password,codice_qr,operatore_assegnazione_token) VALUE (AES_ENCRYPT('Nome','CHIAVE_DI_CIFRATURA') ,AES_ENCRYPT('Cognome','CHIAVE_DI_CIFRATURA'),AES_ENCRYPT('donna','CHIAVE_DI_CIFRATURA'),'2000-01-01','0000/00','1',AES_ENCRYPT('','CHIAVE_DI_CIFRATURA'),AES_ENCRYPT('','CHIAVE_DI_CIFRATURA'),AES_ENCRYPT('','CHIAVE_DI_CIFRATURA'),AES_ENCRYPT('','CHIAVE_DI_CIFRATURA'),'4205',AES_ENCRYPT('indirizzoemail@provider.dominio','CHIAVE_DI_CIFRATURA'),'PASSWORD_HASHATA_IN_MD5','',AES_ENCRYPT('','CHIAVE_DI_CIFRATURA'))


-- RUOLI
INSERT INTO `ruoli` (`codice_ruolo`, `nome`, `descrizione`, `isOperativo`) VALUES
(0, 'Volontario', 'Volontario semplice', 1),
(1, 'Caposquadra', 'Colui che ha la responsabilità del mezzo', 1),
(2, 'Magazziniere', '', 1),
(9, 'Super utente', 'Profilo con privilegi elevati', 1);

-- ASSOCIAZIONE VOCI DI MENU A RUOLI
INSERT INTO `menu_voci_ruoli` (`codice_ruolo`, `codice_menu`) VALUES
(1, 19),
(1, 28),
(2, 6),
(2, 9),
(2, 12),
(2, 15),
(2, 21),
(2, 24),
(2, 26),
(2, 28),
(9, 1),
(9, 6),
(9, 9),
(9, 12),
(9, 15),
(9, 19),
(9, 21),
(9, 24),
(9, 26),
(9, 28);
