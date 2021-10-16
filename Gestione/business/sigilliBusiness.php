<?php

include '../db_components/dbGestione.php';

function getListaSigilli($id){
    $conn = apriConnessione();
    $sql = 'SELECT codice_sigillo, colore_sigillo, AES_DECRYPT(operatore,\''.CHIAVE_DI_CIFRATURA.'\') as operatore, DATE_FORMAT(data_sigillo, "%H:%i del %d/%m/%Y") as data_sigillo FROM storico_sigilli WHERE codice_sacca = ? AND codice_sigillo != "" ORDER BY id_sto_sig DESC ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result; 
}

?>