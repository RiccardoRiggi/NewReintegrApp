<?php 

/*
    API CHE RESTITUISCE IL NUMERO DI MESSAGGI NON LETTI

*/

include '../auth_components/apiControlloAutenticazione.php'; 
include '../db_components/dbGestione.php';
controllaAutenticazioneApi();

$conn = apriConnessione();
    $sql = 'SELECT count(*) as n FROM messaggi, utenti where timestamp > ultimo_accesso_messaggi AND impronta = "'.$_SESSION["impronta"].'"';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["n"];
        }
    }else{
        echo "0";
    }

?>