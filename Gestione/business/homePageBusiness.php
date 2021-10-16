<?php

include '../db_components/dbGestione.php';

function getUltimiSetteGiorni(){
    $conn = apriConnessione();
    $sql = '(SELECT DATE(NOW())  - INTERVAL 0 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 0 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 1 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 1 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 2 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 2 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 3 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 3 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 4 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 4 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 5 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 5 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 6 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 6 DAY, "%d/%m/%Y") as dataLabel ) UNION (SELECT DATE(NOW())  - INTERVAL 7 DAY as giorno, DATE_FORMAT(DATE(NOW())  - INTERVAL 7 DAY, "%d/%m/%Y") as dataLabel )';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getUltimiSetteGiorniReintegri(){
    $conn = apriConnessione();
    $sql = 'SELECT count(*) as n, DATE_FORMAT(data_reintegro, "%d/%m/%Y") as dataLabel, DATE(data_reintegro) as data_reintegro FROM `reintegrazioni` WHERE 1 GROUP BY DATE(data_reintegro) ORDER by data_reintegro DESC LIMIT 7';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getNumeroProdottiEsauritiInMagazzinoMiliti(){
    $conn = apriConnessione();
    $sql = 'SELECT COUNT(*) as n FROM prodotti WHERE totale_disposizione_militi = 0';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getProdottiEsauritiInMagazzinoMiliti(){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM prodotti WHERE totale_disposizione_militi = 0';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getNumeroProdottiEsauritiInMagazzino(){
    $conn = apriConnessione();
    $sql = 'SELECT COUNT(*) as n FROM prodotti WHERE totale_magazzino = 0';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getProdottiEsauritiInMagazzino(){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM prodotti WHERE totale_magazzino = 0';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getNumeroProdottiScaduti(){
    $conn = apriConnessione();
    $sql = 'SELECT (SELECT count(*) FROM prodotti_negli_zaini WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) ) + (SELECT count(*) FROM prodotti_nei_mezzi WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) ) + (SELECT count(*) FROM prodotti_nelle_sacche WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) ) as n ';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getNumeroProdottiInScadenza(){
    $conn = apriConnessione();
    $sql = 'SELECT (SELECT count(*) FROM prodotti_negli_zaini WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) ) ) + (SELECT count(*) FROM prodotti_nei_mezzi WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) ) ) + (SELECT count(*) FROM prodotti_nelle_sacche WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) )  ) as n ';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getClassificaReintegri(){
    $conn = apriConnessione();
    $sql = 'SELECT count(r.reintegrazione_id) as n, AES_DECRYPT(u.nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(u.cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome FROM utenti u LEFT OUTER JOIN reintegrazioni r ON r.utente_id = u.utente_id GROUP BY u.utente_id ORDER BY n DESC LIMIT 7';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getProdottiScaduti(){
    $conn = apriConnessione();
    $sql = '(SELECT CONCAT("Z",codice_zaino) as id, nome FROM prodotti_negli_zaini INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) ) UNION (SELECT CONCAT("M",codice_mezzo) as id, nome FROM prodotti_nei_mezzi INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) ) UNION (SELECT CONCAT("S",codice_sacca) as id, nome FROM prodotti_nelle_sacche INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) < MONTH(CURRENT_TIMESTAMP) ) OR YEAR(data_scadenza) < YEAR(CURRENT_TIMESTAMP) )';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getProdottiInScadenza(){
    $conn = apriConnessione();
    $sql = '(SELECT CONCAT("Z",codice_zaino) as id, nome FROM prodotti_negli_zaini INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) ) ) UNION (SELECT CONCAT("M",codice_mezzo) as id, nome FROM prodotti_nei_mezzi INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) ) ) UNION (SELECT CONCAT("S",codice_sacca) as id, nome FROM prodotti_nelle_sacche INNER JOIN prodotti ON codice_prodotto = prodotto_id WHERE ( YEAR(data_scadenza) = YEAR(CURRENT_TIMESTAMP) AND MONTH(data_scadenza) = MONTH(CURRENT_TIMESTAMP) )  ) ';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

 

?>





