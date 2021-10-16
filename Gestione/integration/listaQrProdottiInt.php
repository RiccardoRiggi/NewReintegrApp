<?php

include '../business/prodottiBusiness.php';

function generaTabellaEtichetteProdotti(){
    $result = getListaEtichette();

    $esito = '<table id="tabellaListaEtichette" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Seleziona</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Descrizione</th>
                                            <th scope="col">Stampa</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $esito=$esito.'<tr>             <td class="text-center align-middle"><div class="form-check form-check-inline">
            <input class="checkSelezione" id="chech'.$row["prodotto_id"].'" onchange="stampaSelezionati(this,'.$row["prodotto_id"].')" type="checkbox">
            <label for="chech'.$row["prodotto_id"].'"></label>
            </div></td>
                                            <td class="align-middle">'.$row["nome"].'</td>
                                            <td class="align-middle">'.$row["descrizione"].'</td>
                                            <td class="align-middle text-center">
                                            <a target="_blank" href="stampaQrProdottiDiGruppo.php?id='.$row["prodotto_id"].'" ><button type="button" class="btn btn-primary">
                                            <i class="fas fa-print"></i>
                                        </button></a></td>
                                        </tr>';
        }
    }

    $esito = $esito.'</tbody>
                                </table>';
    return $esito;
}

?>