<?php

 include '../business/reintegriBusiness.php';


 function ottieniDettaglioReintegro($id){
    $result=getIntestazioneDettaglioReintegro($id);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row;
        }
    }else{
        header('location: errore404.php');
    }
 }

 function stampaListaProdottiReintegrati($id){
    $result = getListaProdottiReintegrati($id);

    $esito = '<table id="tabellaDettaglioReintegro" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prodotto Reintegrato</th>
                                            <th scope="col">Quantità</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="align-middle">'.$row["nome"].'</td>
                                            <td class="align-middle">'.$row["quantita"].'</td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}


?>

