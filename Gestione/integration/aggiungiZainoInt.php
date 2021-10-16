<?php
    include '../business/zainiBusiness.php';

    function generaComboPosizioneZaino(){
        $finale='<option value="0">Magazzino</option>';
        $result = selezionaTuttiVeicoli();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<option value="'.$row["mezzo_id"].'">'.$row["tipo"].' - '.$row["codice_mezzo"].'</option>';
            }
        }
        return $finale;
    }

    function salvaZaino($nome,$mezzoId){
        if($nome=="" || $mezzoId == "")
            header('location: errore500.php'); 
        $id = memorizzaZaino($nome,$mezzoId);
        if($id!=0)
            header('location: modificaZaino.php?id='.$id);
        else
            header('location: errore500.php'); 

    }

?>