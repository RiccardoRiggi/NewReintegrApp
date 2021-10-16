<?php

include '../db_components/dbGestione.php';

function selezionaPadri(){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM voci_menu, menu_voci_ruoli WHERE voci_menu.codice_padre = 0 AND menu_voci_ruoli.codice_ruolo = ? AND menu_voci_ruoli.codice_menu = voci_menu.voce_id';
    $result = resultPreparedUno($conn,$sql,$_SESSION["codice_ruolo"]);
    chiudiConnessione($conn);
    return $result;    
}

function selezionaFigli($padre){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM voci_menu WHERE codice_padre = ? ';
    $result = resultPreparedUno($conn,$sql,$padre);
    chiudiConnessione($conn);
    return $result;    
}





?>