<?php

include '../business/sigilliBusiness.php';

function stampaTabellaSigilli($id)
{
    $result = getListaSigilli($id);

    $esito = '<table id="tabellaNotifiche" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Codice</th>
                                            <th scope="col">Colore</th>
                                            <th scope="col">Operatore</th>
                                            <th scope="col">Data Sigillo</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $esito = $esito . '<tr>            
            <td class="align-middle">' . $row["codice_sigillo"] . '</td>
            <td class="align-middle">' . $row["colore_sigillo"] . '</td>
                                            <td class="align-middle">' . $row["operatore"] . '</td>
                                            <td class="align-middle">' . $row["data_sigillo"] . '</td>
                                        </tr>';
        }
    }

    $esito = $esito . '</tbody>
                                </table>';
    return $esito;
}
