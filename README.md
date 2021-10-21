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
![Schermata di installazione](https://raw.githubusercontent.com/RiccardoRiggi/NewReintegrApp/main/screenshots/installazione.png)
Per avviare l'installazione bisogna entrare tramite il browser all'interno della cartella ./installazione. Per procedere sono richieste le seguenti informazioni:
 - Nome dell'ente/associazione
 - Indirizzo ip del database MySQL
 - Nome utente del database
 - Password per accedere al database
 - Chiave di cifratura per la crittografia delle informazioni personali
 - Indirizzo email dell'utente amministratore
 - Password dell'utente amministratore
FOTO_SCHERMATA ESITO BUON FINE INSTALLAZIONE
Dopo aver cliccato su Avvia installazione una schermata confermerà il buon esito dell'operazione. In automatico verrete ridiretti sulla schermata di autenticazione dove saranno richiesti indirizzo email e password dell'utente amministratore. La schermata home confermerà il buon esito dell'operazione.
Adesso è necessario cancellare la cartella ./installazione per impedire ad altri utenti di sovrascrivere il database. Si consiglia sempre di effettuare backup periodici, compreso il pacchetto appena scaricato.
---   
## Documentazione
Di seguito potete trovare una documentazione che illustra le funzionalità di quest'applicazione web. 

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

## In conclusione
Il nome deriva 
Sono consapevole che il codice possa essere notevolmente migliorato. Questo progetto è datato Aprile 2020 e in una prima versione avevo utilizzato Boostrap Italia, solo ultimamente ho deciso di aggiornare l'interfaccia grafica e pubblicarlo su GitHub nella speranza che questo software possa essere utile anche a qualcuno.