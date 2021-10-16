<?php

include '../business/notificheBusiness.php';

function stampaTabellaNotifiche()
{
    $result = getListaNotifiche();

    $esito = '<table id="tabellaNotifiche" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Utente</th>
                                            <th scope="col">Testo</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $esito = $esito . '<tr>            
            <td class="align-middle">' . $row["notifica_id"] . '</td>
            <td class="align-middle">' . $row["data_notifica"] . '</td>
                                            <td class="align-middle">' . $row["nome"] . ' ' . $row["cognome"] . '</td>
                                            <td class="align-middle">' . $row["testo"] . '</td>
                                        </tr>';
        }
    }

    $esito = $esito . '</tbody>
                                </table>';
    return $esito;
}
