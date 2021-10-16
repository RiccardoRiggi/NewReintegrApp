<?php
include '../business/saccheBusiness.php';

function ottieniSacca($id)
{
    $result = getSaccaSingola($id);
    if ($result->num_rows == 0)
        header('location: errore404.php');
    $row = $result->fetch_assoc();
    return $row;
}

function generaComboModificaColoreSacca($colore)
{
    return '<select title="Scegli una opzione" id="colore_sacca" name="colore_sacca">
    <option ' . selected($colore, "Rossa") . ' value="Rossa">Rossa</option>
    <option ' . selected($colore, "Gialla") . ' value="Gialla">Gialla</option>
    <option ' . selected($colore, "Verde") . ' value="Verde">Verde</option>
    <option ' . selected($colore, "Blu") . ' value="Blu">Blu</option>
    <option ' . selected($colore, "Nera") . ' value="Nera">Nera</option>
</select>';
}

function generaComboModificaPosizioneSacca($mezzo, $zaino)
{
    if ($mezzo != null)
        $id = "M" . $mezzo;
    else
        $id = "Z" . $zaino;

    $finale = '';
    $result = selezionaListaPosizioni();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $finale = $finale . '<option '.selected($id,$row["id"]).' value="' . $row["id"] . '">' . $row["nome"] . '</option>';
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

function aggiornaSacca($codiceSacca, $nome, $colore,$coloreSigillo, $codiceSigillo,$padre){
    if($nome=="" || $colore=="" || $padre=="" || $codiceSacca=="")
            header('location: errore500.php'); 
    if(substr($padre,0,1)=='Z'){
        aggiornaSaccaInBaseDati($codiceSacca, $nome, $colore,$coloreSigillo, $codiceSigillo);
        aggiornaSaccaZaino(substr($padre,1,strlen($padre)),$codiceSacca);
    }else{
        aggiornaSaccaInBaseDati($codiceSacca, $nome, $colore,$coloreSigillo, $codiceSigillo);
        aggiornaSaccaMezzo(substr($padre,1,strlen($padre)),$codiceSacca);
    }
    header('location: modificaSacca.php?id='.$codiceSacca);
}

function stampaDatiSigillo($colore,$codice,$operatoreSigillo,$dataSigillo){
    if($colore!=null && $codice!=null)
        return '<small class=" pl-3 form-text text-muted">Sacca sigillitata da '.$operatoreSigillo.' alle ore '.$dataSigillo.' con il sigillo numero <strong>'.$codice."</strong> di colore <strong>".$colore.'</strong></small>';
    else
        return '<small class=" pl-3 form-text text-muted text-danger-rosso-solo">Attenzione! La sacca non è stata ancora sigillata!</small>';
}

function stampaDataUltimaModifica($prodotto){
        return '<small class="text-center form-text text-muted">Ultimo aggiornamento effettuato da '.$prodotto["operatore_aggiornamento"].' alle ore '.$prodotto["data_aggiornamento"].'</small>';

}
