<?php
    include '../business/zainiBusiness.php';

    function getTabellaListaZaini(){
        $result = selezionaListaZaini();
        $finale='<table id="tabellaZaini" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Posizione</th>
                <th scope="col" class="text-center">Modifica</th>
                <th scope="col" class="text-center">Elimina</th>
            </tr>
        </thead>
        <tbody>';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <td scope="row">'.$row["nome"].'</td>
                <td class="text-center">'.$row["posizione"].'</td>
                <td class="text-center"><a href="modificaZaino.php?id='.$row["zaino_id"].'"><button type="button" class="btn btn-danger">
                            <i class="fas fa-edit"></i>
                        </button></a></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#confermaEliminazione" onclick="confermaEliminazione(\''.$row["nome"].' \','.$row["zaino_id"].');" type="button" class="btn btn-danger">
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