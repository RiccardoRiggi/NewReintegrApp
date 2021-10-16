<?php

    include '../business/prodottiBusiness.php';

function memorizzaProdotto($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti){
    $idProdotto = salvaProdotto($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti);
    header('location: schedaProdotto.php?id='.$idProdotto);
}

function aggiornaProdotto($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti,$id){
    aggiornaProdottoInBaseDati($nome,$descrizione,$totaleMagazzino,$totaleDisposizioneMiliti,$id);
    header('location: schedaProdotto.php?id='.$id);
}

function getProdotto($id){
    $result = recuperaProdotto($id);
    if ($result->num_rows == 0)
        header('location: errore404.php');
    $row = $result->fetch_assoc();
    return $row;
}

function stampaTitolo($isModifica){
    if($isModifica)
        return "Modifica Prodotto";
    else
        return "Aggiungi Prodotto";       
}

function stampaDato($isModifica,$prodotto,$nomeAttributo){
    if($isModifica)
        return $prodotto[$nomeAttributo];
    else
        return "";
}

function stampaDataUltimaModifica($isModifica,$prodotto){
    if($isModifica){
        return '<small class="text-center form-text text-muted">Ultimo aggiornamento effettuato da '.$prodotto["operatore_aggiornamento"].' alle ore '.$prodotto["data_aggiornamento"].'</small>';
    }else{
        return "";
    }
}


?>