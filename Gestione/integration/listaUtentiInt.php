<?php

include '../business/utentiBusiness.php';

function generaListaUtenti(){
    $result = selezionaListaUtenti();

    $esito = '<table id="tabellaUtenti" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tessera</th>
                                            <th scope="col">Cognome</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Reintegri</th>
                                            <th scope="col">Ultimo Accesso</th>
                                            <th class="text-center" scope="col">Modifica</th>
                                            <th class="text-center" scope="col">Stampa Badge</th>
                                            <th class="text-center" scope="col">Elimina</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="align-middle">N. '.$row["numero_tessera"].'</td>
                                            <td class="align-middle">'.$row["cognome"].'</td>
                                            <td class="align-middle">'.$row["nome"].'</td>
                                            <td class="align-middle">'.$row["reintegri"].'</td>
                                            <td class="align-middle">'.stampaDataUltimoAccesso($row["data_ultimo_accesso"]).'</td>

                                            <td class="text-center"><a href="modificaUtente.php?id='.$row["a"].'"><button type="button" class="btn btn-danger">
                                                <i class="fas fa-user-edit"></i>
                                                </button></a></td>
                                            <td class="text-center"><a target="_blank" class="btn btn-danger '.pulsanteBadgeAccesso($row["isQrBloccato"]).'" href="stampaBadgeAccessoSingolo.php?id='.$row["a"].'">
                                                <i class="fas fa-id-badge"></i>
                                                </a></td>
                                            <td class="text-center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confermaEliminazione" onclick="confermaEliminazione(\''.$row["nome"].' '.$row["cognome"].'\','.$row["a"].')">
                                                <i class="fas fa-user-times"></i>
                                                </button></td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}

function stampaDataUltimoAccesso($data){
    if($data!="00:00 - 00/00/0000" && $data!=null)
        return $data;
    else
        return"Non ancora effettuato";
}

function pulsanteBadgeAccesso($isQrBloccato){
    if($isQrBloccato)
        return "";
    else
        return "";
}
?>