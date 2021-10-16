<?php include '../business/veicoliBusiness.php'; ?>


<?php

function memorizzaVeicolo($nome,$codiceMezzo,$targa,$tipo){
    $result = selezionaVeicoloDaCodiceMezzo($codiceMezzo);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('location: modificaVeicolo.php?id='.$row["mezzo_id"]);
    }else{
        if($nome== "" || $codiceMezzo == "" || $targa == "")
            header('location: errore500.php');
        return  salvaVeicolo($nome,$codiceMezzo,$targa,$tipo);
    }    
}

?>