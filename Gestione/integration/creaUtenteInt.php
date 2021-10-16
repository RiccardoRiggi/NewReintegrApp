<?php

include '../business/utentiBusiness.php';

function generaComboComuni(){
    $result = getListaComuni();
    $esito = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito = $esito.'<option value="'.utf8_encode ($row["comune"]).'">'.utf8_encode ($row["comune"]).'</option>';  
        }
    }
    return $esito;    
}

function salvaUtenteInBaseDati($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$operatore){
    if($cognome=="" || $nome=="" || $numero_tessera =="" || $email =="")
        header('location: errore500.php');
    if($isCertificato=="No")
        $isCertificato=false;
    else
        $isCertificato=true;
    $data_di_nascita=substr($data_di_nascita,6,4)."-".substr($data_di_nascita,3,2)."-".substr($data_di_nascita,0,2);
    return salvaUtente($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$operatore);
}

?>