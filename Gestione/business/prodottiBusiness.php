<?php

include '../db_components/dbGestione.php';

function salvaProdotto($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti){
    $conn = apriConnessione();
    $sql = "INSERT INTO prodotti (nome,descrizione,totale_magazzino,totale_disposizione_militi,data_aggiornamento,operatore_aggiornamento,etichetta) VALUE ('".$nome."','".$descrizione."','".$totaleMagazzino."','".$totaleDisposizioneMiliti."', CURRENT_TIMESTAMP , AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), '".generaQrCode()."')";
    $conn->query($sql);
    $id=$conn->insert_id;
    chiudiConnessione($conn);
    generaLog($sql);
    return $id;      
}

function aggiornaProdottoInBaseDati($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti,$id){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti SET nome = ? , descrizione= ? , totale_magazzino= ? , totale_disposizione_militi= ? , operatore_aggiornamento= AES_ENCRYPT( ? ,'".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql." WHERE prodotto_id  = ? ";
    resultPreparedSei($conn,$sql,$nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti,$_SESSION["operatore"],$id);
    chiudiConnessione($conn);
}

function recuperaProdotto($id){
    $conn = apriConnessione();
    $sql = 'SELECT prodotto_id, nome, descrizione, totale_magazzino, totale_disposizione_militi, AES_DECRYPT(operatore_aggiornamento,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_aggiornamento, DATE_FORMAT(data_aggiornamento, "%H:%i del %d/%m/%Y") as data_aggiornamento FROM prodotti WHERE isEliminato = false AND prodotto_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result; 
}

function listaProdotti(){
    $conn = apriConnessione();
    $sql = 'SELECT prodotto_id, nome, totale_magazzino, totale_disposizione_militi FROM prodotti WHERE isEliminato = false ORDER BY nome ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getListaEtichette(){
    $conn = apriConnessione();
    $sql = 'SELECT prodotto_id, nome, descrizione, etichetta FROM prodotti WHERE isEliminato = false ORDER BY nome ';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function getEtichettaSingola($id){
    $conn = apriConnessione();
    $sql = 'SELECT prodotto_id, nome, descrizione, etichetta FROM prodotti WHERE isEliminato = false AND prodotto_id = ? ORDER BY nome ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

?>