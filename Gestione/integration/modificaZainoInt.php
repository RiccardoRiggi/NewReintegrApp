<?php
include '../business/zainiBusiness.php';

function ottieniZaino($id)
{
    $result = getZainoSingolo($id);
    if ($result->num_rows == 0)
        header('location: errore404.php');
    $row = $result->fetch_assoc();
    return $row;
}

function generaComboModificaPosizioneZaino($mezzo)
{

    $finale = '';
    $result = selezionaListaPosizioni();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $finale = $finale . '<option '.selected($mezzo,$row["id"]).' value="' . $row["id"] . '">' . $row["nome"] . '</option>';
        }
    }
    return $finale;
}

function selected($a, $b)
{
    if ($a == $b)
        return "selected";
    else
        return "";
}

function aggiornaZaino($codiceSacca, $nome,$padre){
    if($nome=="" || $padre == "" || $codiceSacca =="")
        header('location: errore500.php'); 
    aggiornaZainoInBaseDati($codiceSacca, $nome, $padre);
    header('location: modificaZaino.php?id='.$codiceSacca);
}

function stampaDataUltimaModifica($prodotto){
        return '<small class="text-center form-text text-muted">Ultimo aggiornamento effettuato da '.$prodotto["operatore_aggiornamento"].' alle ore '.$prodotto["data_aggiornamento"].'</small>';

}

function getTabellaListaSacche($id){
    $result = getListaSacche($id);
    $finale='<table id="tabellaSaccheSemplici" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col" class="text-center">Nome</th>
            <th scope="col" class="text-center">Modifica</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td scope="row">'.coloraSacca($row["colore"]).$row["nome"].'</td>
            <td class="text-center"><a href="modificaSacca.php?id='.$row["id"].'"><button type="button" class="btn btn-danger">
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
