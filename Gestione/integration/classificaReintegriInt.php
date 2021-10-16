<?php

include '../business/reintegriBusiness.php';

function stampaClassificaReintegri(){
    $result = getClassificaReintegri();

    $esito = '<table id="tabellaClassificaReintegri" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Numero Reintegri</th>
                                            <th scope="col">Cognome</th>
                                            <th scope="col">Nome</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="align-middle">'.$row["n"].'</td>
                                            <td class="align-middle">'.$row["cognome"].'</td>
                                            <td class="align-middle">'.$row["nome"].'</td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}


?>