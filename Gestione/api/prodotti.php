<?php 

/*
    COMANDI
    d=cancella

*/

include '../auth_components/apiControlloAutenticazione.php'; 
controllaAutenticazioneApi();
if(!isset($_GET["id"],$_GET["c"])){
    http_response_code(500);
    exit("ERROR");  
}else{
    if($_GET["c"]=="d"){
        cancellaProdottoAPI($_GET["id"]);
    }
    
}


function cancellaProdottoAPI($id){
    include '../db_components/dbGestione.php';
    $conn = apriConnessione();
    $sql = "UPDATE prodotti SET isEliminato = true, data_eliminazione = CURRENT_TIMESTAMP, operatore_eliminazione= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."')";
    $sql = $sql." WHERE prodotto_id = ".$id." ";
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

?>
