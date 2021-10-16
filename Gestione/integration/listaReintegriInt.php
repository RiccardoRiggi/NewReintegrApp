<?php

include '../business/reintegriBusiness.php';

function stampaListaReintegri(){
    $result = getListaReintegri();

    $esito = '<table id="tabellaReintegri" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Cognome</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Mezzo</th>
                                            <th scope="col">Data</th>
                                            <th class="text-center" scope="col">Dettagli</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="align-middle">'.$row["reintegrazione_id"].'</td>
                                            <td class="align-middle">'.$row["cognome"].'</td>
                                            <td class="align-middle">'.$row["nome"].'</td>
                                            <td class="align-middle">'.$row["tipo"].' '.$row["codice_mezzo"].'</td>
                                            <td class="align-middle">'.$row["data_reintegro"].'</td>

                                            <td class="text-center"><a href="schedaReintegro.php?id='.$row["reintegrazione_id"].'"><button type="button" class="btn btn-primary">
                                            <i class="fas fa-info-circle"></i>
                                                </button></a></td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}


?>