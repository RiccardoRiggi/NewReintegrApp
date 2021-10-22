# ReintegrApp
 FOTO_HOMEPAGE_CON_CLASSIFICA_POPOLATA_E_GRAFICO 

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
 - PHP puro
 - Servizio Google per la generazione dei QR code
 
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
FOTO_SCHERMATA_ESITO_BUON_FINE_INSTALLAZIONE
Dopo aver cliccato su Avvia installazione una schermata confermerà il buon esito dell'operazione. In automatico verrete ridiretti sulla schermata di autenticazione dove saranno richiesti indirizzo email e password dell'utente amministratore. La schermata home confermerà il buon esito dell'operazione.
Adesso è necessario cancellare la cartella ./installazione per impedire ad altri utenti di sovrascrivere il database. Si consiglia sempre di effettuare backup periodici, compreso il pacchetto appena scaricato.
---   
## Documentazione

FOTO_HOMEPAGE
Di seguito potete trovare una documentazione che illustra le funzionalità di quest'applicazione web. Dalla homepage è possibile vedere la classifica degli utenti più attivi, il grafico dei movimenti dell'ultima settimana e il menu rapido per i prodotti scaduti, in scadenza, da reintegrare o da ordinare perché esauriti. 
- -- 
### Anagrafica
#### Aggiungi utente
FOTO_AGGIUNGI_UTENTE
Sotto la voce anagrafica è disponibile la funzionalità per creare un nuovo utente. I campi obbligatori sono nome, cognome, numero di tessera, email e password (per consentirgli successivamente di accedere all'applicativo). I campi facoltativi sono il sesso, la data di nascita, il numero di abilitazione DAE, il possesso della certificazione per l'emergenza, il comune di residenza, l'indirizzo, il civico e l'interno. Dopo il salvataggio verrete portati nella pagina di modifica dell'utente.
#### Lista utenti
FOTO_LISTA_UTENTI
Dalla lista utenti è possibile accedere alla pagina di modifica, stampare il codice qr che permette l'autenticazione agli utenti dalla web app mobile ed eliminare la singola occorrenza. 

#### Gestione badge
FOTO_LISTA_GESTIONE_BADGE
Dalla pagina di gestione badge è possibile procedere alla stampa dei codici di accesso, vedere lo stato di attivazione di ogni singolo account, variarlo e rigenerare il qr code in caso di smarrimento o furto. 
#### Gestione ruoli
FOTO_GESTIONE_RUOLI
Dalla pagina di gestione ruoli è possibile variare il ruolo di ogni singolo utente. Durante la procedura di installazione vengono creati quattro ruoli con funzioni specifiche:

 - Volontario: può accedere solamente alla parte dell'applicativo adibita alla registrazione dei movimenti del magazzino
 - Caposquadra: può accedere al gestionale per stampare le checklist dei mezzi da compilare ad ogni inizio turno
 - Magazziniere: può accedere a tutta la gestione del magazzino, messaggi, notifiche
 - Super utente: ha tutti i privilegi

- ---
### Veicoli
#### Aggiungi veicolo
FOTO_AGGIUNGI_VEICOLO
Dalla pagina aggiungi veicolo è possibile inserire un nuovo mezzo nel sistema. Le informazioni richieste sono il nome, il codice di riconoscimento (identificativo radio), la targa e il tipo di veicolo. Ogni veicolo può contenere degli zaini, delle sacche e dei prodotti.

#### Lista veicoli
FOTO_LISTA_VEICOLI
In questa pagina è possibile vedere l'elenco dei veicoli, modificarne i dettagli ed eliminarli.
- -------
### Zaini
#### Aggiungi zaino
FOTO_AGGIUNGI_ZAINO
Grazie a questa pagina è possibile registrare dei nuovi zaini, bisogna inserire un nome e, necessariamente, associarlo ad un veicolo. Ogni zaino può contenere delle sacche e dei prodotti. 
#### Lista zaini
FOTO_LISTA_ZAINI
In questa pagina è possibile vedere l'elenco degli zaini, modificarne i dettagli ed eliminarli.
- ---
### Sacche
#### Aggiungi sacca
FOTO_AGGIUNGI_SACCA
Dalla pagina aggiungi sacca è possibile aggiungere l'oggetto al database. Bisogna inserire il nome, il colore e la posizione che può essere dentro uno zaino oppure dentro un veicolo. Ogni sacca può contenere una lista di prodotti. 
#### Lista sacche
FOTO_LISTA_SACCHE
In questa pagina è possibile vedere l'elenco delle sacche, modificarne i dettagli ed eliminarle.
- ---
### Prodotti
#### Aggiungi prodotto
FOTO_AGGIUNGI_PRODOTTO
Dalla pagina aggiungi prodotto è possibile inserire l'elenco dei presidi, materiali, attrezzatura e altro presente all'interno del magazzino. Bisogna inserire un nume, eventualmente una descrizione, il quantitativo totale presente attualmente nel magazzino e il quantitativo disponibile per il personale che addetto a reintegrare i mezzi. Ad ogni ripristino di mezzi i quantitativi verranno aggiornati automaticamente.
#### Lista prodotti
FOTO_LISTA_PRODOTTI
In questa pagina è possibile vedere l'elenco dei prodotti, modificarne le quantità ed eliminarli.

#### Lista etichette
FOTO_LISTA_ETICHETTE
Dalla lista delle etichette è possibile stampare i QR code identificativi dei singoli prodotti da applicare nei relativi scompartimenti del magazzino. Ogni singolo utente, tramite la web application mobile potrà scansionare il codice per identificare l'articolo e confermare il movimento.

#### Menu rapido per i prodotti
Dalla homepage, cliccando su una delle quattro card colorate è possibile accedere ad una lista filtrata per data di scadenza oppure quantitativo. Ogni singolo prodotto aggiunto ad un mezzo, zaino oppure sacca dispone di una data di scadenza per dare la possibilità al magazziniere di tenere traccia delle scadenze e sostituire per tempo gli articoli in scadenza.

### Checklist
#### Creazione di una checklist
FOTO_ESEMPIO_CHECKLIST
Configurando mezzi, zaini, sacche e prodotti il software è in grado in maniera automatica di generare una checklist per ogni singolo veicolo.

#### Stampare una checklist
FOTO_LISTA_CHECKLIST
Dalla pagina lista checklist è possibile selezionare un mezzo per stampare la relativa checklist. 

### Reintegri
### Reintegrare un mezzo
Per rendere più semplice e veloce l'operazione di tracciatura dei movimenti all'interno del magazzino viene utilizzata una web application progettata appositamente per dispositivi mobile. L'autenticazione può avvenire tramite l'inserimento di email e password oppure tramite la scansione del proprio token cartaceo. 
![Schermata con login via codice qr e login via email e password sull'applicazione web mobile](https://raw.githubusercontent.com/RiccardoRiggi/NewReintegrApp/main/screenshots/autenticazioneMobile.png)
Successivamente una schermata illustrerà alcune statistiche come la data dell'ultimo accesso, il numero di veicoli ripristinati, il numero di prodotti rimessi a posto e il numero di messaggi di segnalazione inviati.
![Schermata home dell'applicazione web mobile](https://raw.githubusercontent.com/RiccardoRiggi/NewReintegrApp/main/screenshots/homeMobile.png)
Cliccando su reintegra un mezzo è possibile scegliere il veicolo e successivamente inquadrare il codice qr del prodotto scelto. Per ogni prodotto possiamo scegliere la quantità e, in caso di numeri non congruenti (l'applicazione segnala 10 articoli, ma nel magazzino ne sono presenti solamente 7) è possibile notificare al responsabile questa discrepanza. 
![Schermata per la selezione e conferma del prodotto](https://raw.githubusercontent.com/RiccardoRiggi/NewReintegrApp/main/screenshots/sceltaProdottoMobile.png)
Terminata la lista dei materiali da ripristinare è possibile cliccare sul pulsante "Ho finito" per terminare l'operazione.
### Lista reintegri
FOTO_LISTA_REINTEGRI
Dalla pagina della lista reintegri è possibile vedere ogni singolo evento con la relativa lista di articoli movimentati. 
#### Classifica dei reintegri
La classifica dei reintegri mostra in ordine decrescente gli utenti in base al numero di movimenti.
- ---
### Messaggi
#### Invio messaggi
![Schermata per l'invio del messaggio](https://raw.githubusercontent.com/RiccardoRiggi/NewReintegrApp/main/screenshots/invioMessaggio.png)
Dalla web application mobile, tramite il menu di navigazione presente a fondo pagina, è possibile accedere alla pagina per poter inviare un messaggio ai magazzinieri. 
#### Lista messaggi
FOTO_LISTA_MESSAGGI
La lista messaggi offre la possibilità di leggere le comunicazioni inviate da parte degli utenti.
### Notifiche
#### Lista notifiche
FOTO_LISTA_NOTIFICHE
Da questa pagina è possibile vedere le segnalazioni di prodotti con quantità non corrispondenti. 

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
FOTO_SCHERMATA_BLOCCO
Per prevenire tentativi di attacco Brute Force è stato implementato un sistema di controllo delle autenticazioni fallite, dopo 10 tentativi l'applicazione bloccherà l'accesso a quel determinato indirizzo ip che potrà essere sbloccato manualmente. Ogni indirizzo ip prima di venire salvato viene elaborato con una funzione di hash che lo rende anonimo.

---
#### Blocco in tempo reale degli utenti
FOTO_BADGE_BLOCCATO
In qualunque momento è possibile bloccare l'accesso all'applicazione da parte di un utente, se autenticato, verrà disconnesso automaticamente.

---
#### Blocco in caso di inattività da parte dell'operatore
FOTO_SCHERMATA_BLOCCO_CON_PSW
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
Il nome deriva dalla classica frase "*Vai a reintegrare il mezzo*", detta da ogni soccorritore a fine intervento. Dopo ogni missione di soccorso bisogna "reintegrare", ovvero riportare nelle condizioni iniziali il mezzo andando a ripristinare il materiale usato.

Sono consapevole che il codice possa essere notevolmente migliorato. **Questo progetto è datato Aprile 2020**, realizzato con le conoscenze e l'esperienza dell'epoca.  In una prima versione avevo utilizzato Bootstrap Italia, solo ultimamente ho deciso di aggiornare l'interfaccia grafica e pubblicarlo su GitHub nella speranza che questo software possa essere utile anche a qualcuno.