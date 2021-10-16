<?php

include '../business/utentiBusiness.php';

function generaListaBadgeUtenti(){
    $result = selezionaListaBadgeUtenti();

    $esito = '<table id="tabellaListaBadgeAccesso" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Seleziona</th>
                                            <th scope="col">Cognome</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Data Generazione</th>
                                            <th scope="col">Stato</th>
                                            <th class="text-center" scope="col">Stampa</th>
                                            <th class="text-center" scope="col">Opzione</th>
                                            <th class="text-center" scope="col">Rigenera</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="text-center align-middle"><div class="form-check form-check-inline">
            <input class="checkSelezione" id="chech'.$row["codiceUtente"].'" onchange="stampaSelezionati(this,'.$row["codiceUtente"].')" type="checkbox">
            <label for="chech'.$row["codiceUtente"].'"></label>
            </div></td>
                                            <td class="align-middle">'.$row["cognome"].'</td>
                                            <td class="align-middle">'.$row["nome"].'</td>
                                            <td class="align-middle" id="dataGenerazione'.$row["codiceUtente"].'">'.$row["data_assegnazione_token"].'</td>
                                            <td class="align-middle text-center" id="stato'.$row["codiceUtente"].'">'.stampaStato($row["data_qr_bloccato"],$row["isQrBloccato"]).'</td>
                                            <td class="align-middle text-center">
                                            <a target="_blank" href="stampaBadgeAccessoSingolo.php?id='.$row["codiceUtente"].'" ><button type="button" class="btn btn-danger">
                                            <i class="fas fa-print"></i>
                                        </button></a></td>
                                            <td class="text-center">'.generaPulsanteToken($row["isQrBloccato"],$row["codiceUtente"],$row["nome"],$row["cognome"]).'</td>
                                            <td class="text-center"><button data-toggle="modal" data-target="#confermaRigenerazione" onclick=\'cacheRigenera('.$row["codiceUtente"].',"'.$row["nome"].'","'.$row["cognome"].'")\' type="button" class="btn btn-danger">
                                            <i class="fas fa-sync"></i> 
                                            </button></td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}

function stampaStato($data,$isBloccato){
    if($isBloccato){
        return '<i title="Badge disabilitato alle '.$data.'" class="h3 text-danger-rosso-solo far fa-times-circle"></i>';
    }else{
        return '<i title="Badge abilitato" class="h3 verde far fa-check-circle"></i>';
    }
}

function generaPulsanteToken($isBloccato,$id,$nome,$cognome){
    if($isBloccato)
        return '
                                                            <button id="pulsanteBloccoSblocco'.$id.'" title="Abilita Badge" onclick=\'devoBloccare(false,'.$id.',"'.$nome.'","'.$cognome.'",this)\' type="button" class="btn btn-danger">
                                                                <i class="fas fa-unlock"></i>
                                                            </button>';
    else
        return '
                                                            <button id="pulsanteBloccoSblocco'.$id.'" title="Disabilita Badge" type="button" onclick=\'devoBloccare(true,"'.$id.'","'.$nome.'","'.$cognome.'",this)\' class="btn btn-danger">
                                                                <i class="fas fa-lock"></i>
                                                            </button>';
}

?>