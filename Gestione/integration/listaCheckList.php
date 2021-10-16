<?php
    include '../business/veicoliBusiness.php';

    function getTabellaListaCheckList(){
        $result = selezionaTuttiVeicoli();
        $finale='<table id="tabellaProdotti" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">Codice Mezzo</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Targa</th>
                <th scope="col" class="text-center">Stampa</th>
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
                <td class="text-center"><a href="schedaCheckList.php?id='.$row["mezzo_id"].'"><button type="button" class="btn btn-danger">
                            <i class="fas fa-print"></i>
                        </button></a></td>
            </tr>';
            }
        }

        //FINE CICLO
        $finale=$finale.'</tbody>
        </table>';
        return $finale;
    }

?>