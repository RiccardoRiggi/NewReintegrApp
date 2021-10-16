<?php

include '../business/utentiBusiness.php';

function aggiornaUtenteInBaseDati($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$id){
    if($isCertificato=="No")
        $isCertificato=false;
    else
        $isCertificato=true;
    
    generaLog($data_di_nascita);
    $data_di_nascita=substr($data_di_nascita,6,4)."-".substr($data_di_nascita,3,2)."-".substr($data_di_nascita,0,2);
    generaLog($data_di_nascita);
   
    if($cognome=="" || $nome=="" || $numero_tessera =="" || $email =="")
        header('location: errore500.php');
    aggiornaUtente($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$id);
}


function cercaUtente($id){
    $result = selezionaUtente($id);
    if ($result->num_rows == 0)
        header('location: errore404.php');
    $row = $result->fetch_assoc();
    return $row;        
}

function selezionato($a,$b){
    if($a==$b)
        return "selected";
    else
        return "";
}

function generaComboComuni($comune){
    $result = getListaComuni();
    $esito = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito = $esito.'<option '.selezionato($comune,$row["comune"]).' value="'.utf8_encode ($row["comune"]).'">'.utf8_encode ($row["comune"]).'</option>';  
        }
    }
    return $esito;    
}

function generaAvvisoTokenBloccato($isBloccato,$data){
    if($isBloccato){
        return '<div class="row pt-5">
                                                <div class="col">
                                                    <div class="alert alert-danger pl-2 text-center" role="alert">
                                                        Attenzione! Il badge risulta essere stato bloccato alle ore '.$data.' 
                                                    </div>
                                                </div>
                                                
                                            </div>';
        
            
    }else
        return "";
}

function generaPulsanteToken($isBloccato){
    if($isBloccato)
        return '
                                                            <button id="pulsanteBloccoSblocco" onclick="devoBloccare(false)" type="button" class="btn btn-danger">
                                                                <i class="fas fa-unlock"></i> Sblocca Badge
                                                            </button>';
    else
        return '
                                                            <button id="pulsanteBloccoSblocco" type="button" onclick="devoBloccare(true)" class="btn btn-danger">
                                                                <i class="fas fa-lock"></i> Blocca Badge
                                                            </button>';
}

function stampaDataUltimoAccesso($data){
    if($data!="00/00/0000" && $data != null)
        return $data;
    else
        return"Non ancora effettuato";
}


?>