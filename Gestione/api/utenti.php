<?php 

//COMANDI ?c=x
/*
d=cancellaUtente
b=blocca
s=Sblocca
r=rigeneraTokenUtente
rr=rigeneraTokenUtente senza cambiare stato bloccato/sbloccato
t=token
vp=verifica password
ct=cambia token
*/

include '../auth_components/apiControlloAutenticazione.php'; 
controllaAutenticazioneApi();
if(!isset($_GET["id"],$_GET["c"])){
    http_response_code(500);
    exit("ERROR");  
}else{
    if($_GET["c"]=="d"){
        cancellaUtenteAPI($_GET["id"]);
    }
    if($_GET["c"]=="r"){
        rigeneraTokenDiAccesso($_GET["id"]);
    }
    if($_GET["c"]=="t"){
        generaAvvisoTokenBloccato($_GET["id"]);
    }
    if($_GET["c"]=="b"){
        bloccaBadgeAccessoAPI($_GET["id"]);
    }
    if($_GET["c"]=="s"){
        sbloccaBadgeAccessoAPI($_GET["id"]);
    }
    if($_GET["c"]=="vp"){
        isPasswordNull($_GET["id"]);
    }
    if($_GET["c"]=="ct"){
        aggiornaRuolo($_GET["id"],$_GET["codR"]);
    }
}


function cancellaUtenteAPI($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "UPDATE utenti SET isEliminato = true, data_eliminazione = CURRENT_TIMESTAMP, operatore_eliminazione = AES_ENCRYPT('".$_SESSION["operatore"]."','".CHIAVE_DI_CIFRATURA."')";
    $sql = $sql." WHERE utente_id = ".$id." ";
    generaLog($sql);
    $conn->query($sql);
    if($conn->affected_rows==1){
        http_response_code(200);
    }else{
        http_response_code(500);
    }
    chiudiConnessione($conn);
    exit();
}

function bloccaBadgeAccessoAPI($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "UPDATE utenti SET isQrBloccato = true, data_qr_bloccato = CURRENT_TIMESTAMP ";
    $sql = $sql." WHERE utente_id = ".$id." ";
    $conn->query($sql);
    if($conn->affected_rows==1){
        http_response_code(200);
    }else{
        http_response_code(500);
    }
    chiudiConnessione($conn);
    exit();
}

function sbloccaBadgeAccessoAPI($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "UPDATE utenti SET isQrBloccato = false, data_qr_bloccato = NULL ";
    $sql = $sql." WHERE utente_id = ".$id." ";
    $conn->query($sql);
    if($conn->affected_rows==1){
        http_response_code(200);
    }else{
        http_response_code(500);
    }
    chiudiConnessione($conn);
    exit();
}

function rigeneraTokenDiAccesso($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $qr = generaQrCode();
    $sql = "INSERT INTO storico_token_accesso (codice_qr,utente_id,data_assegnazione_token,operatore_assegnazione_token,data_fine_validita) SELECT codice_qr, utente_id, data_assegnazione_token, AES_ENCRYPT('operatore_assegnazione_token','".CHIAVE_DI_CIFRATURA."'), CURRENT_TIMESTAMP as data_fine_validita FROM utenti WHERE utente_id = ".$id;
    generaLog($sql);
    $conn->query($sql);
    if($conn->affected_rows!=1){
        http_response_code(500);
        chiudiConnessione($conn);
        exit("ERROR");
    }
    $sql = "UPDATE utenti SET codice_qr = '".$qr."', data_qr_bloccato = NULL, isQrBloccato = FALSE, data_assegnazione_token = CURRENT_TIMESTAMP, operatore_assegnazione_token = AES_ENCRYPT('".$_SESSION["operatore"]."','".CHIAVE_DI_CIFRATURA."')  ";
    generaLog($sql);
    $sql = $sql." WHERE utente_id = ".$id." ";
    $conn->query($sql);
    if($conn->affected_rows==1){
        http_response_code(200);
    }else{
        http_response_code(500);
        chiudiConnessione($conn);
        exit("ERROR");
    }
    chiudiConnessione($conn);
    exit($qr);
}

function generaAvvisoTokenBloccato($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = 'SELECT isQrBloccato, DATE_FORMAT(data_qr_bloccato,"%H:%i del %d/%m/%Y") as data_qr_bloccato  FROM utenti';
    $sql = $sql." WHERE isBloccato = false AND utente_id = ".$id." ";
    generaLog($sql);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row["isQrBloccato"]){
        exit('<div class="row pt-5">
                                                <div class="col">
                                                    <div class="alert alert-danger pl-2 text-center" role="alert">
                                                        Attenzione! Il badge risulta essere stato bloccato alle ore '.$row["data_qr_bloccato"].' 
                                                    </div>
                                                </div>
                                                
                                            </div>');
        
            
    }else
        exit("");
}

function isPasswordNull($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "SELECT LENGTH(password) as p FROM utenti ";
    $sql = $sql." WHERE utente_id = ".$id." AND isEliminato = false";
    generaLog($sql);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row["p"]!=null){
        http_response_code(200);
    }else{
        http_response_code(500);
    }
    chiudiConnessione($conn);
    exit($row["p"]);
}

function aggiornaRuolo($id,$codiceRuolo){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "UPDATE utenti SET codice_ruolo = ".$codiceRuolo;
    $sql = $sql." WHERE utente_id = ".$id." ";
    $conn->query($sql);
    if($conn->affected_rows==1){
        aggiornaImpronta($id,$conn);
        http_response_code(200);
    }else{
        http_response_code(500);
    }
    chiudiConnessione($conn);
    exit();
}



?>
