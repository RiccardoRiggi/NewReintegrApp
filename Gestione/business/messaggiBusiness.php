<?php

include '../db_components/dbGestione.php';

function getListaMessaggi(){
    $conn = apriConnessione();
    $sql = 'SELECT AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, testo, messaggio_id, DATE_FORMAT(timestamp, "%H:%i del %d/%m/%Y") as data_notifica FROM messaggi JOIN utenti ON messaggi.utente_id = utenti.utente_id ORDER BY timestamp DESC ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaTimeStampMessaggi();
    return $result; 
}

function aggiornaTimeStampMessaggi(){
    $conn = apriConnessione();
    $sql = 'UPDATE utenti SET ultimo_accesso_messaggi = CURRENT_TIMESTAMP WHERE impronta = ? ';
    resultPreparedUno($conn,$sql,$_SESSION["impronta"]);
    chiudiConnessione($conn);
}


?>