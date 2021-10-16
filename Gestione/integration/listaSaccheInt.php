<?php
    include '../business/saccheBusiness.php';

    function getTabellaListaSacche(){
        $result = getListaSacche();
        $finale='<table id="tabellaSacche" class="table table-striped table-bordered">
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
                <td scope="row">'.coloraSacca($row["colore"]).$row["nome"].'</td>
                <td scope="row">'.$row["posizione"].'</td>
                <td class="text-center"><a href="modificaSacca.php?id='.$row["id"].'"><button type="button" class="btn btn-danger">
                            <i class="fas fa-edit"></i>
                        </button></a></td>
                <td class="text-center">
                    <button data-toggle="modal" data-target="#confermaEliminazione" onclick="confermaEliminazione(\''.$row["nome"].' \','.$row["id"].');" type="button" class="btn btn-danger">
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

    function coloraSacca($colore){
        if($colore=="Rossa"){
            return '<span class="pr-2"><i class="fas text-danger-rosso-solo fa-briefcase-medical"></i></span>';
        }
        if($colore=="Gialla"){
            return '<span class="pr-2"><i class="fas text-arancione fa-briefcase-medical"></i></span>';
        }
        if($colore=="Verde"){
            return '<span class="pr-2"><i class="fas verde fa-briefcase-medical"></i></span>';
        }
        if($colore=="Blu"){
            return '<span class="pr-2"><i class="fas testo-blu fa-briefcase-medical"></i></span>';
        }
        if($colore=="Nera"){
            return '<span class="pr-2"><i class="fas text-black fa-briefcase-medical"></i></span>';
        }
    }

?>