<?php

include '../db_components/dbGestione.php';

function selezionaTuttiVeicoli(){
    $conn = apriConnessione();
    $sql = "SELECT * FROM mezzi WHERE isEliminato = false AND mezzo_id != 0 ORDER BY tipo, codice_mezzo";
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

?>

