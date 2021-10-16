<?php

include '../business/homePageBusiness.php';

function generaTabellaEsauriti(){
        $result = getProdottiEsauritiInMagazzino();
        $finale='<table id="tabellaProdottiStrategica" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center">Totale Magazzino</th>
                <th scope="col" class="text-center">Disponibile ai militi</th>
                <th scope="col" class="text-center">Modifica</th>
            </tr>
        </thead>
        <tbody>';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <td scope="row">'.$row["nome"].'</td>
                <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_magazzino"]).'</span></td>
                <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_disposizione_militi"]).'</span></td>
                <td class="text-center"><a href="schedaProdotto.php?id='.$row["prodotto_id"].'"><button type="button" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </button></a></td>
            </tr>';
            }
        }

        //FINE CICLO
        $finale=$finale.'</tbody>
        </table>';
        return $finale;
}

function generaTabellaDaReintegrare(){
    $result = getProdottiEsauritiInMagazzinoMiliti();
    $finale='<table id="tabellaProdottiStrategica" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" class="text-center">Totale Magazzino</th>
            <th scope="col" class="text-center">Disponibile ai militi</th>
            <th scope="col" class="text-center">Modifica</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td scope="row">'.$row["nome"].'</td>
            <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_magazzino"]).'</span></td>
            <td class="text-center"><span>'.stampaNumeroProdotti($row["totale_disposizione_militi"]).'</span></td>
            <td class="text-center"><a href="schedaProdotto.php?id='.$row["prodotto_id"].'"><button type="button" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </button></a></td>
        </tr>';
        }
    }

    //FINE CICLO
    $finale=$finale.'</tbody>
    </table>';
    return $finale;
}

function generaTabellaScaduti(){
    $result = getProdottiScaduti();
    $finale='<table id="tabellaScadenza" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" class="text-center">Modifica</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td scope="row">'.$row["nome"].'</td>
            <td class="text-center">'.generaPulsanteModifica($row["id"]).'</td>
        </tr>';
        }
    }

    //FINE CICLO
    $finale=$finale.'</tbody>
    </table>';
    return $finale;
}

function generaTabellaScadenza(){
    $result = getProdottiInScadenza();
    $finale='<table id="tabellaScadenza" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" class="text-center">Modifica</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td scope="row">'.$row["nome"].'</td>
            <td class="text-center">'.generaPulsanteModifica($row["id"]).'</td>
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

function generaPulsanteModifica($id){
    if(substr($id,0,1)=="Z"){
        $id=substr($id,1,strlen($id)-1);
        return '<a href="modificaZaino.php?id='.$id.'"><button type="button" class="btn btn-primary">
    <i class="fas fa-edit"></i>
</button></a>';
    }
    if(substr($id,0,1)=="M"){
        $id=substr($id,1,strlen($id)-1);
        return '<a href="modificaVeicolo.php?id='.$id.'"><button type="button" class="btn btn-primary">
    <i class="fas fa-edit"></i>
</button></a>';
    }
    if(substr($id,0,1)=="S"){
        $id=substr($id,1,strlen($id)-1);
        return '<a href="modificaSacca.php?id='.$id.'"><button type="button" class="btn btn-primary">
    <i class="fas fa-edit"></i>
</button></a>';
    }

    
}

?>