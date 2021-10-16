<?php

include '../business/utentiBusiness.php';

function generaTabella(){
    $elencoRuoli = selezionaListaRuoli();
    $elencoUtenti = selezionaListaUtentiRuoli();
    $numeroRuoli = $elencoRuoli->num_rows;

    $finale = '<table id="tabellaRuoli" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Cognome</th>
            <th scope="col">Nome</th>';

            $finale=$finale.generaIntestazioneRuoli($elencoRuoli);

            $finale=$finale.'<th scope="col" class="text-center">Salva</th>
            </tr>
        </thead>
        <tbody>';

        $finale=$finale.generaElencoUtenti($elencoUtenti,$elencoRuoli);

        $finale=$finale.'</tbody>
        </table>';
        return $finale;
}

function generaIntestazioneRuoli($elencoRuoli){
    $finale="";
    if ($elencoRuoli->num_rows > 0) {
        while($row = $elencoRuoli->fetch_assoc()) {
            $finale=$finale.'<th scope="col">'.$row["nome"].'</th>';
        }
    }
    return $finale;
}

function generaColonneRuoli($elencoRuoli,$idUtente,$idRuoloIniziale){
    $finale="";
    $elencoRuoli = selezionaListaRuoli();
    if ($elencoRuoli->num_rows > 0) {
        while($row = $elencoRuoli->fetch_assoc()) {
            $finale=$finale.'<td class="align-middle text-center">
            <div class="form-check form-check-inline">
                <input onclick=\'aggiornaModifica("'.$idUtente.'","'.$row["codice_ruolo"].'");\' name="gruppo'.$idUtente.'" type="radio" id="'.$row["codice_ruolo"].'radio'.$idUtente.'" '.isChecked($idRuoloIniziale,$row["codice_ruolo"]).'>
                <label for="'.$row["codice_ruolo"].'radio'.$idUtente.'"></label>
            </div>
        </td>';
        }   
    }else{
        
    }
    return $finale;
}

function isChecked($a,$b){
    if($a==$b){
        return "checked";
    }else{
        return "";
    }
}

function generaElencoUtenti($elencoUtenti,$elencoRuoli){
    $finale="";
    if ($elencoUtenti->num_rows > 0) {
        while($row = $elencoUtenti->fetch_assoc()) {
            $finale=$finale.'<tr><td class="align-middle ">'.$row["cognome"].'</td>
            <td class="align-middle ">'.$row["nome"].'</td>';
            
           $finale=$finale.generaColonneRuoli($elencoRuoli,$row["utente_id"],$row["codice_ruolo"]);
            
            $finale=$finale.'<td class="align-middle text-center"><button disabled id="pulsanteSalva'.$row["utente_id"].'" type="button" onclick="salvaNuovoRuolo(\''.$row["utente_id"].'\',\''.$row["nome"].'\',\''.$row["cognome"].'\')" class="btn btn-danger">
                <i class="fas fa-save"></i>
            </button><input type="hidden" id="modifica'.$row["utente_id"].'"</td><input type="hidden" value="'.$row["codice_ruolo"].'" id="ruoloOriginale'.$row["utente_id"].'"</td></tr>';
        }
        return $finale;
    }

}

?>