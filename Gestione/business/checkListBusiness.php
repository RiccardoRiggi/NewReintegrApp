<?php

include '../db_components/dbGestione.php';

function selezionaProdottiNelVeicolo($codiceVeicolo){
    $conn = apriConnessione();
    $sql = 'SELECT *, totale_magazzino-totale_disposizione_militi as disponibilie_in_magazzino , DATE_FORMAT(data_scadenza,"%m/%Y") as data_scadenza FROM prodotti_nei_mezzi, prodotti WHERE prodotti.prodotto_id = prodotti_nei_mezzi.codice_prodotto AND codice_mezzo = ? ';
    $result = resultPreparedUno($conn,$sql,$codiceVeicolo);
    chiudiConnessione($conn);
    return $result;

}

function selezionaProdottiNellaSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT *, totale_magazzino-totale_disposizione_militi as disponibilie_in_magazzino , DATE_FORMAT(data_scadenza,"%m/%Y") as data_scadenza FROM prodotti_nelle_sacche, prodotti WHERE prodotti.prodotto_id = prodotti_nelle_sacche.codice_prodotto AND codice_sacca = ? ';
    $result = resultPreparedUno($conn,$sql,$codiceSacca);
    chiudiConnessione($conn);
    return $result;

}

function selezionaProdottiNelloZaino($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT *, totale_magazzino-totale_disposizione_militi as disponibilie_in_magazzino , DATE_FORMAT(data_scadenza,"%m/%Y") as data_scadenza FROM prodotti_negli_zaini, prodotti WHERE prodotti.prodotto_id = prodotti_negli_zaini.codice_prodotto AND codice_zaino = ? ';
    $result = resultPreparedUno($conn,$sql,$codiceSacca);
    chiudiConnessione($conn);
    return $result;

}


function getListaSacche($id)
{
    $conn = apriConnessione();
    $sql = "SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome FROM sacche WHERE sacche.mezzo_id= ? AND sacche.isEliminato = false";
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

function getListaSaccheNelloZaino($id)
{
    $conn = apriConnessione();
    $sql = "SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome FROM sacche WHERE sacche.zaino_id= ? AND sacche.isEliminato = false";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function selezionaVeicolo($id){
    $conn = apriConnessione();
    $sql = "SELECT *, DATE_FORMAT(CURRENT_TIMESTAMP, '%H:%i del %d/%m/%Y') as data_attuale FROM mezzi WHERE mezzo_id = ? AND isEliminato = false";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

?>