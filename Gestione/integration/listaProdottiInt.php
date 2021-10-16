<?php
    include '../business/prodottiBusiness.php';

    function recuperoListaProdotti(){
        $result = listaProdotti();
        $finale='<table id="tabellaProdotti" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center">Totale Magazzino</th>
                <th scope="col" class="text-center">Disponibile ai militi</th>
                <th scope="col" class="text-center">Modifica</th>
                <th scope="col" class="text-center">Elimina</th>
            </tr>
        </thead>
        <tbody>';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <td scope="row">'.$row["nome"].'</td>
                <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_magazzino"]).'</span></td>
                <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_disposizione_militi"]).'</span></td>
                <td class="text-center"><a href="schedaProdotto.php?id='.$row["prodotto_id"].'"><button type="button" class="btn btn-danger">
                            <i class="fas fa-edit"></i>
                        </button></a></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#confermaEliminazione" onclick="confermaEliminazione(\''.$row["nome"].' \','.$row["prodotto_id"].');" type="button" class="btn btn-danger">
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

    function stampaNumeroProdotti($numero){
        if($numero<1)
            return '<span class="text-danger-rosso-solo font-weight-bold">'.$numero.'</span>';
        if($numero<SOGLIA_PRODOTTI_IN_ESAURIMENTO)
            return '<span class="text-arancione font-weight-bold">'.$numero.'</span>';
        else
            return $numero;
    }

?>