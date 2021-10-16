<?php

include '../db_components/dbGestione.php';


/*

Funzione che crea la reintegrazione

*/
function creaNuovaReintegrazione($mezzoId){
    $conn = apriConnessione();
    $sql = "INSERT INTO reintegrazioni (utente_id,mezzo_id,data_reintegro)  VALUE (?,?,CURRENT_TIMESTAMP)";
    $utenteId = mysqli_real_escape_string($conn,$_SESSION["utente_id"]);
    $mezzoId = mysqli_real_escape_string($conn,$mezzoId);
    generaLog($sql);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $utenteId,$mezzoId);
    $stmt->execute();
    $id=$conn->insert_id;
    generaLog($stmt->error);
    $stmt->close();
    chiudiConnessione($conn);
    return $id; 
}

/*

Funzione che recupera un prodotto dato il suo codice qrcode

*/
function recuperaProdotto($id){
    $conn = apriConnessione();
    $sql = 'SELECT prodotto_id, nome, descrizione, totale_disposizione_militi FROM prodotti WHERE isEliminato = false AND etichetta = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row;
        }
    }else{
        header('location: selezionaProdotto.php?error=404');
    }
}

/*

Funzione che aggiorna la quantità di un prodotto a magazzino

*/
function aggiornaQuantitaInMagazzino($valoreDaSottrarre,$codiceProdotto){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti SET totale_magazzino = totale_magazzino-?, totale_disposizione_militi = totale_disposizione_militi-?";
    $sql = $sql . " WHERE prodotto_id  = ? ";
    resultPreparedTre($conn,$sql,$valoreDaSottrarre,$valoreDaSottrarre,$codiceProdotto);
    chiudiConnessione($conn);
}

/*

Funzione che registra il prodotto prelevato e la sua quantità

*/
function registraPrelevamento($reintegrazioneId,$quantita,$codiceProdotto){
    $conn = apriConnessione();
    $sql = "INSERT INTO prodotti_reintegrati (reintegrazione_id,codice_prodotto,quantita)  VALUE (?,?,?)";
    resultPreparedTre($conn,$sql,$reintegrazioneId,$codiceProdotto,$quantita);
    chiudiConnessione($conn);
}

?>

