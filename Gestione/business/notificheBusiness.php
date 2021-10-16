<?php

include '../db_components/dbGestione.php';

function getListaNotifiche(){
    $conn = apriConnessione();
    $sql = 'SELECT AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, testo, notifica_id, DATE_FORMAT(timestamp, "%H:%i del %d/%m/%Y") as data_notifica FROM notifiche JOIN utenti ON notifiche.utente_id = utenti.utente_id ORDER BY timestamp DESC ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaTimeStampNotifiche();
    return $result; 
}

function aggiornaTimeStampNotifiche(){
    $conn = apriConnessione();
    $sql = 'UPDATE utenti SET ultimo_accesso_notifiche = CURRENT_TIMESTAMP WHERE impronta = ? ';
    resultPreparedUno($conn,$sql,$_SESSION["impronta"]);
    chiudiConnessione($conn);
}


?>