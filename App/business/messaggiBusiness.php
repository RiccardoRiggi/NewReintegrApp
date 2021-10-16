<?php

include '../db_components/dbGestione.php';

function inviaMessaggio($contenuto){
    $conn = apriConnessione();
    $sql = "INSERT INTO messaggi (utente_id,testo,timestamp) VALUES (?,?,CURRENT_TIMESTAMP)";
    resultPreparedDue($conn,$sql,$_SESSION["utente_id"],$contenuto);
    chiudiConnessione($conn);
}

?>