<?php
if(!defined("NOME_ASSOCIAZIONE"))
define("NOME_ASSOCIAZIONE","Croce Rossa Italiana - Comitato Val di Fassa");
if(!defined("SOGLIA_LOCKSCREEN"))
define("SOGLIA_LOCKSCREEN",300);
if(!defined("SOGLIA_PRODOTTI_IN_ESAURIMENTO"))
define("SOGLIA_PRODOTTI_IN_ESAURIMENTO",10);
if(!defined("IS_IN_PRODUZIONE"))
define("IS_IN_PRODUZIONE",false);
if(!defined("INDIRIZZO_SERVER_DATABASE"))
define("INDIRIZZO_SERVER_DATABASE","localhost");
if(!defined("NOME_ISTANZA_DATABASE"))
define("NOME_ISTANZA_DATABASE","reintegra");
if(!defined("USERNAME_DATABASE"))
define("USERNAME_DATABASE","root");
if(!defined("PASSWORD_DATABASE"))
define("PASSWORD_DATABASE","");
if(!defined("NUMERO_VERSIONE"))
define("NUMERO_VERSIONE","1.0.0");
if(!defined("CHIAVE_DI_CIFRATURA"))
define("CHIAVE_DI_CIFRATURA","CHIAVE_DI_CIFRATURA");

// SELECT AES_ENCRYPT("VALORE_DA_CIFRARE",'CHIAVE_DI_CIFRATURA');
?>
