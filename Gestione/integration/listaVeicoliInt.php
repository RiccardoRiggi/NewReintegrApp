<?php
    include '../business/veicoliBusiness.php';

    function getTabellaListaVeicoli(){
        $result = selezionaTuttiVeicoli();
        $finale='<table id="tabellaProdotti" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">Codice Mezzo</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Targa</th>
                <th scope="col" class="text-center">Modifica</th>
                <th scope="col" class="text-center">Elimina</th>
            </tr>
        </thead>
        <tbody>';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <td scope="row">'.$row["codice_mezzo"].'</td>
                <td class="text-center">'.$row["tipo"].'</td>
                <td class="text-center">'.$row["nome"].'</td>
                <td class="text-center">'.$row["targa"].'</td>
                <td class="text-center"><a href="modificaVeicolo.php?id='.$row["mezzo_id"].'"><button type="button" class="btn btn-danger">
                            <i class="fas fa-edit"></i>
                        </button></a></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#confermaEliminazione" onclick="confermaEliminazione(\''.$row["tipo"]." ".$row["codice_mezzo"].' \','.$row["mezzo_id"].');" type="button" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>';
            }
        }

        //FINE CICLO
        $finale=$finale.'</tbody>
        </table>';
        return $finale;
    }

?>