<?php

include '../db_components/dbGestione.php';


function selezionaListaUtenti(){
    $conn = apriConnessione();
    $sql = 'SELECT isQrBloccato, utente_id a, AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, (SELECT count(*) FROM reintegrazioni WHERE utente_id = a) as reintegri, DATE_FORMAT(data_ultimo_accesso, "%H:%i - %d/%m/%Y") as data_ultimo_accesso, numero_tessera FROM utenti WHERE isEliminato = false ORDER BY cognome, nome DESC';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;    
}

function selezionaListaBadgeUtenti(){
    $conn = apriConnessione();
    $sql = 'SELECT isQrBloccato, utente_id as codiceUtente, AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, DATE_FORMAT(data_qr_bloccato, "%H:%i del %d/%m/%Y") as data_qr_bloccato, DATE_FORMAT(data_assegnazione_token, "%d/%m/%Y") as data_assegnazione_token, AES_DECRYPT(operatore_assegnazione_token,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_assegnazione_token FROM utenti WHERE isEliminato = false ORDER BY cognome, nome DESC';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;    
}

function selezionaUtente($id){
    $conn = apriConnessione();
    $sql = 'SELECT utente_id a, AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, (SELECT count(*) FROM reintegrazioni WHERE utente_id = a) as reintegri, DATE_FORMAT(data_ultimo_accesso, "%H:%i - %d/%m/%Y") as data_ultimo_accesso, numero_tessera, AES_DECRYPT(sesso,\''.CHIAVE_DI_CIFRATURA.'\') as sesso, DATE_FORMAT(data_di_nascita,"%d/%m/%Y") as data_di_nascita, numero_dae, isCertificato, AES_DECRYPT(comune_residenza,\''.CHIAVE_DI_CIFRATURA.'\') as comune_residenza, AES_DECRYPT(via,\''.CHIAVE_DI_CIFRATURA.'\') as via, AES_DECRYPT(civico,\''.CHIAVE_DI_CIFRATURA.'\') as civico, AES_DECRYPT(interno,\''.CHIAVE_DI_CIFRATURA.'\') as interno, codice_qr, isQrBloccato, note, DATE_FORMAT(data_qr_bloccato,"%H:%i del %d/%m/%Y") as data_qr_bloccato, codice_ruolo, DATE_FORMAT(data_primo_accesso,"%d/%m/%Y") as data_primo_accesso, DATE_FORMAT(data_assegnazione_token,"%d/%m/%Y") as data_assegnazione_token, AES_DECRYPT(operatore_assegnazione_token,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_assegnazione_token, AES_DECRYPT(email,\''.CHIAVE_DI_CIFRATURA.'\') as email FROM utenti WHERE isEliminato = false AND utente_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;    
}

function getListaComuni(){
    $conn = apriConnessione();
    $sql = 'SELECT DISTINCT comune from t_comuni ORDER BY comune ASC';
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;    
}

function salvaUtente($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$operatore){
    $conn = apriConnessione();
    $sql = "INSERT INTO utenti (nome,cognome,sesso,data_di_nascita,numero_dae,isCertificato,comune_residenza,via,civico,interno,numero_tessera,email,password,codice_qr,operatore_assegnazione_token) VALUE (AES_ENCRYPT('".$nome."','".CHIAVE_DI_CIFRATURA."') ,AES_ENCRYPT('".$cognome."','".CHIAVE_DI_CIFRATURA."'),AES_ENCRYPT('".$sesso."','".CHIAVE_DI_CIFRATURA."'),'".$data_di_nascita."','".$numero_dae."','".$isCertificato."',AES_ENCRYPT('".$comune_residenza."','".CHIAVE_DI_CIFRATURA."'),AES_ENCRYPT('".$via."','".CHIAVE_DI_CIFRATURA."'),AES_ENCRYPT('".$civico."','".CHIAVE_DI_CIFRATURA."'),AES_ENCRYPT('".$interno."','".CHIAVE_DI_CIFRATURA."'),'".$numero_tessera."',AES_ENCRYPT('".$email."','".CHIAVE_DI_CIFRATURA."'),'".$password."','".generaQrCode()."',AES_ENCRYPT('".$operatore."','".CHIAVE_DI_CIFRATURA."'))";
    $conn->query($sql);
    $id=$conn->insert_id;
    chiudiConnessione($conn);
    generaLog($sql);
    return $id;    
}

function aggiornaUtente($nome,$cognome,$sesso,$data_di_nascita,$numero_dae,$isCertificato,$comune_residenza,$via,$civico,$interno,$numero_tessera,$email,$password,$id){
    $conn = apriConnessione();
    $sql = "UPDATE utenti SET nome= AES_ENCRYPT( ? ,'".CHIAVE_DI_CIFRATURA."'), cognome= AES_ENCRYPT( ? ,'".CHIAVE_DI_CIFRATURA."'), sesso= AES_ENCRYPT('".$sesso."','".CHIAVE_DI_CIFRATURA."'), data_di_nascita= '".$data_di_nascita."', numero_dae= '".$numero_dae."', isCertificato= '".$isCertificato."', comune_residenza= AES_ENCRYPT('".$comune_residenza."','".CHIAVE_DI_CIFRATURA."'), via= AES_ENCRYPT('".$via."','".CHIAVE_DI_CIFRATURA."'), civico= AES_ENCRYPT('".$civico."','".CHIAVE_DI_CIFRATURA."'), interno= AES_ENCRYPT('".$interno."','".CHIAVE_DI_CIFRATURA."'), numero_tessera= ? , email= AES_ENCRYPT(?,'".CHIAVE_DI_CIFRATURA."') ";
    if($password!="")
        $sql = $sql." , password = '".$password."'";
    $sql = $sql." WHERE utente_id = ? ";
    resultPreparedCinque($conn,$sql,$nome,$cognome,$numero_tessera,$email,$id);
    chiudiConnessione($conn);
}

function getBadgeAccesso($id){
    $conn = apriConnessione();
    $sql = 'SELECT AES_DECRYPT(utenti.nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, codice_qr, AES_DECRYPT(operatore_assegnazione_token,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_assegnazione_token, DATE_FORMAT(data_assegnazione_token,"%d/%m/%Y") as data_assegnazione_token, DATE_FORMAT(CURRENT_TIMESTAMP,"%d/%m/%Y") as data_attuale, AES_DECRYPT(operatore_assegnazione_token,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_assegnazione_token, ruoli.nome as ruolo FROM utenti, ruoli WHERE ruoli.codice_ruolo = utenti.codice_ruolo AND isEliminato = false AND utente_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function getListaBadgeAccesso(){
    $conn = apriConnessione();
    $sql = 'SELECT utente_id FROM utenti WHERE isEliminato = false ORDER BY cognome, nome';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function selezionaListaRuoli(){
    $conn = apriConnessione();
    $sql = 'SELECT codice_ruolo, nome FROM ruoli WHERE isOperativo = true ORDER BY codice_ruolo';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;    
}

function selezionaListaUtentiRuoli(){
    $conn = apriConnessione();
    $sql = 'SELECT utente_id, AES_DECRYPT(nome,\''.CHIAVE_DI_CIFRATURA.'\') as nome, AES_DECRYPT(cognome,\''.CHIAVE_DI_CIFRATURA.'\') as cognome, codice_ruolo FROM utenti WHERE isEliminato = false ORDER BY cognome';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;    
}

?>