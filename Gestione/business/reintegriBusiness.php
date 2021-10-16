<?php

include '../db_components/dbGestione.php';

function getListaReintegri(){
    $conn = apriConnessione();
    $sql = 'SELECT r.reintegrazione_id, r.utente_id, r.mezzo_id, m.tipo, m.codice_mezzo, AES_DECRYPT(u.nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(u.cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, DATE_FORMAT(r.data_reintegro, "%H:%i - %d/%m/%Y") as data_reintegro FROM reintegrazioni r, utenti u, mezzi m WHERE m.mezzo_id = r.mezzo_id AND r.utente_id = u.utente_id ORDER BY data_reintegro ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getListaProdottiReintegrati($id){
    $conn = apriConnessione();
    $sql = 'SELECT nome, quantita FROM prodotti, prodotti_reintegrati WHERE prodotti.prodotto_id = prodotti_reintegrati.codice_prodotto AND prodotti_reintegrati.reintegrazione_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function getIntestazioneDettaglioReintegro($id){
    $conn = apriConnessione();
    $sql = 'SELECT r.reintegrazione_id, r.utente_id, r.mezzo_id, m.tipo, m.codice_mezzo, AES_DECRYPT(u.nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(u.cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, DATE_FORMAT(r.data_reintegro, "%H:%i del %d/%m/%Y") as data_reintegro FROM reintegrazioni r, utenti u, mezzi m WHERE m.mezzo_id = r.mezzo_id AND r.utente_id = u.utente_id AND r.reintegrazione_id = ? ORDER BY data_reintegro ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function getClassificaReintegri(){
    $conn = apriConnessione();
    $sql = 'SELECT count(r.reintegrazione_id) as n, AES_DECRYPT(u.nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(u.cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome FROM utenti u LEFT OUTER JOIN reintegrazioni r ON r.utente_id = u.utente_id GROUP BY u.utente_id ORDER BY n DESC ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

?>