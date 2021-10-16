<?php 

/*
    API CHE RESTITUISCE IL NUMERO DI NOTIFICHE NON LETTE

*/

include '../auth_components/apiControlloAutenticazione.php'; 
include '../db_components/dbGestione.php';
controllaAutenticazioneApi();

$conn = apriConnessione();
    $sql = 'SELECT count(*) as n FROM notifiche, utenti where timestamp > ultimo_accesso_notifiche AND impronta = "'.$_SESSION["impronta"].'"';
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