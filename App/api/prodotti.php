<?php

include '../auth_components/apiControlloAutenticazione.php';
controllaAutenticazioneApi();
if (!isset($_GET["id"], $_GET["c"])) {
    http_response_code(500);
    exit("ERROR");
} else {
    if ($_GET["c"] == "tnc") {
        exit(notificaTotaleNonCongruente($_GET["id"]));
    }
}

function notificaTotaleNonCongruente($id)
{
    $conn = apriConnessione();
    $sql = "INSERT INTO notifiche (utente_id, timestamp, testo) VALUES ( " . $_SESSION["utente_id"] . ",CURRENT_TIMESTAMP,'Quantità massima non congruente! Controllare in magazzino militi la quantità di questo <a href=\"schedaProdotto.php?id=".$id."\">prodotto</a>')";
    $conn->query($sql);
    chiudiConnessione($conn);
    return("OK");
}
