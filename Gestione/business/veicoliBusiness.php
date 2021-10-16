<?php

include '../db_components/dbGestione.php';

function salvaVeicolo($nome,$codiceMezzo,$targa,$tipo){
    $conn = apriConnessione();
    $sql = "INSERT INTO mezzi (nome,codice_mezzo,targa,tipo) VALUE ('".$nome."','".$codiceMezzo."','".$targa."','".$tipo."')";
    $conn->query($sql);
    $id=$conn->insert_id;
    chiudiConnessione($conn);
    generaLog($sql);
    return $id;      
}

function selezionaVeicoloDaCodiceMezzo($id){
    $conn = apriConnessione();
    $sql = "SELECT * FROM mezzi WHERE codice_mezzo = ? ";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function selezionaVeicolo($id){
    $conn = apriConnessione();
    $sql = "SELECT *, AES_DECRYPT(operatore_aggiornamento,'".CHIAVE_DI_CIFRATURA."') as operatore_aggiornamento , DATE_FORMAT(data_aggiornamento, '%H:%i del %d/%m/%Y') as data_aggiornamento FROM mezzi WHERE mezzo_id = ? ";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function selezionaTuttiVeicoli(){
    $conn = apriConnessione();
    $sql = "SELECT * FROM mezzi WHERE isEliminato = false AND mezzo_id != 0 ORDER BY codice_mezzo";
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function aggiornaVeicoloInBaseDati($mezzoId,$codiceMezzo,$nome,$targa,$tipo){
    $conn = apriConnessione();
    $sql = "UPDATE mezzi SET nome = ? , codice_mezzo = ? , targa = ? , tipo = ? , operatore_aggiornamento= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE mezzo_id  = ? ";
    resultPreparedCinque($conn,$sql,$nome,$codiceMezzo,$targa,$tipo,$mezzoId);
    chiudiConnessione($conn);
    convalidaProdottiVeicolo($mezzoId);
}

function convalidaProdottiVeicolo($codiceMezzo){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti_nei_mezzi SET isConvalidato = true";
    $sql = $sql . " WHERE codice_mezzo  = ? ";
    resultPreparedUno($conn,$sql,$codiceMezzo);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function getListaSacche($id)
{
    $conn = apriConnessione();
    $sql = "SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome FROM sacche WHERE sacche.mezzo_id= ? ";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function selezionaListaZaini($id){
    $conn = apriConnessione();
    $sql = "SELECT zaini.zaino_id, zaini.nome as nome FROM zaini LEFT JOIN mezzi ON zaini.mezzo_id = mezzi.mezzo_id WHERE mezzi.mezzo_id = ? AND zaini.isEliminato = false ORDER BY nome";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}
?>