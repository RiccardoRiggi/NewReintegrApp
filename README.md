# ReintegrApp

ReintegrApp è una Web Application gestionale sviluppata senza fini di lucro da [Riccardo Riggi](https://www.riccardoriggi.it/) per organizzazioni di volontariato che operano nel campo dell'emergenza/urgenza

  

## Bom / Diba
#### Database
 - MySQL
#### Linguaggi/Framework/Librerie/Tecnologie
 - HTML
 - CSS
 - JavaScript
 - AJAX
 - Jquery
 - SBAdmin 2
 - ChartJs
 - Bootstrap & Bootstrap Italia
 - FontAwesome
 - DataTables.js
 - PHP
 
## Installazione

  

## Documentazione

#### Menu rapido per i prodotti

#### Aggiungi utente

#### Lista utenti

#### Gestione badge

#### Gestione ruoli

### Veicoli
#### Aggiungi veicolo

#### Lista veicoli

#### Aggiungi zaino

#### Lista zaini

### Sacche
#### Aggiungi sacca

#### Lista sacche

### Prodotti
#### Aggiungi prodotto

#### Lista prodotti

#### Lista etichette

### Checklist
#### Creazione di una checklist

#### Stampare una checklist

### Reintegri
### Reintegrare un mezzo

### Lista reintegri

#### Classifica dei reintegri

### Messaggi
#### Invio messaggi

#### Lista messaggi

### Notifiche
#### Invio notifiche

#### Lista notifiche
  

## Privacy - Sicurezza - GDPR
#### Crittografia dei dati personali
I dati personali degli utenti sono cifrati in banca dati
mediante l'algoritmo di cifratura AES con chiave a 128 bit. In fase di installazione è possibile scegliere la chiave di cifratura.

---
#### Password non salvate in chiaro
Le password degli utenti vengono cifrate mediante una
funzione crittografica di hash irreversibile. La password, se
dimenticata, può essere reimpostata, ma non recuperata

---
#### Protezione contro tentativi di Brute Force
Per prevenire tentativi di attacco Brute Force è stato implementato un sistema di controllo delle autenticazioni fallite, dopo 10 tentativi l'applicazione bloccherà l'accesso a quel determinato indirizzo ip che potrà essere sbloccato manualmente. Ogni indirizzo ip prima di venire salvato viene elaborato con una funzione di hash che lo rende anonimo.

---
#### Blocco in tempo reale degli utenti
In qualunque momento è possibile bloccare l'accesso all'applicazione da parte di un utente, se autenticato, verrà disconnesso automaticamente.

---
#### Blocco in caso di inattività da parte dell'operatore
Lasciando l'applicazione ferma sulla stessa pagina per un determinato periodo, variabile dal file di configurazione, entrerà in automatico un sistema di protezione che bloccherà la sessione e la farà proseguire solamente previo inserimento di password.

---
#### Logout automatico dalle altre postazioni
Il software è progettato in maniera tale da permettere una sola sessione attiva per utente. Ad ogni nuova autenticazione le sessioni precedenti verranno disconnesse.

---
#### Ulteriori obblighi del GDPR
Spetta alla singola associazione adempire agli obblighi di legge imposti dal regolamento generale sulla protezione dei dati n. 2016/679 dell'Unione Europea.

 

## Licenza
Il codice sorgente viene rilasciato con licenza [MIT](https://github.com/RiccardoRiggi/NewReintegrApp/blob/main/LICENSE). Framework, temi, librerie e tutte le tecnologie mantengono le loro relative licenze.
  

## Garanzia limitata ed esclusioni di responsabilità

Il software viene fornito "così com'è", senza garanzie. Riccardo Riggi non concede alcuna garanzia per il software e la relativa documentazione in termini di correttezza, accuratezza, affidabilità o altro. L'utente si assume totalmente il rischio utilizzando questo applicativo.