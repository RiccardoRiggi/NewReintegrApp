<?php 

/*
    COMANDI
    sin=Seleziona prodotti nella sacca
    sout=Seleziona prodotti non nella sacca 
    a=aggiungi
    u=update/aggiorna
    d=cancella
    dS=cancella sacca

*/

include '../auth_components/apiControlloAutenticazione.php'; 
controllaAutenticazioneApi();
if(!isset($_GET["id"],$_GET["c"])){
    http_response_code(500);
    exit("ERROR");  
}else{
    generaLog($_GET["c"]);
    if($_GET["c"]=="sin"){
        exit(generaTabellaProdottiNellaSacca($_GET["id"]));
    }
    if($_GET["c"]=="sout"){
        exit(generaTabellaProdottiNonNellaSacca($_GET["id"]));
    }
    if($_GET["c"]=="a"){
        exit(aggiungiProdottoNellaSacca($_GET["id"],$_GET["sacca"],$_GET["qtaMax"]));
    }
    if($_GET["c"]=="u"){
        exit(aggiornaProdottoNellaSacca($_GET["id"],$_GET["qtaAtt"],$_GET["qtaTot"],$_GET["dataScad"],$_GET["codiceSacca"],$_GET["codiceProdotto"],$_GET["labelAggiunta"]));
    }
    if($_GET["c"]=="d"){
        exit(eliminaProdottoNellaSacca($_GET["id"],$_GET["codiceSacca"]));
    } 
    if($_GET["c"]=="ds"){
        exit(cancellaSacca($_GET["id"]));
    } 
}

function cancellaSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = "UPDATE sacche SET isEliminato = true, operatore_eliminazione = AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_eliminazione= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE sacca_id  = " . $codiceSacca . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function eliminaProdottoNellaSacca($id,$codiceSacca){
    $conn = apriConnessione();
    $sql="DELETE FROM prodotti_nelle_sacche WHERE id_pns =".$id;
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaOperatoreModificaSacca($codiceSacca);
    exit("UPDATED");
}

function aggiornaProdottoNellaSacca($id,$qtaAtt,$qtaTot,$dataScad,$codiceSacca,$codiceProdotto,$labelAtt){
    $dataScad=substr($dataScad,6,4)."-".substr($dataScad,3,2)."-".substr($dataScad,0,2);
    $conn = apriConnessione();
    $sql = 'UPDATE prodotti_nelle_sacche SET quantita_attuale = '.$labelAtt.' , quantita_totale = '.$qtaTot.' , data_scadenza = "'.$dataScad.'" , operatore_aggiornamento = AES_ENCRYPT("'.$_SESSION["operatore"].'","'.CHIAVE_DI_CIFRATURA.'"), data_aggiornamento = CURRENT_TIMESTAMP WHERE id_pns = '.$id;
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    annullaConvalidazioneProdottoNellaSacca($id);
    aggiornaOperatoreModificaSacca($codiceSacca);
    aggiornaQuantitaInMagazzino($codiceProdotto,$qtaAtt);
    exit("UPDATED");
}

function aggiornaQuantitaInMagazzino($codiceProdotto,$qtaAtt){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti SET totale_magazzino = totale_magazzino-".$qtaAtt.", operatore_aggiornamento = AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE prodotto_id  = " . $codiceProdotto . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function annullaConvalidazioneProdottoNellaSacca($id){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti_nelle_sacche SET isConvalidato = false";
    $sql = $sql . " WHERE id_pns  = " . $id . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}


function aggiungiProdottoNellaSacca($codiceProdotto,$codiceSacca,$quantita_totale){
    $conn = apriConnessione();
    $sql = 'INSERT INTO prodotti_nelle_sacche (codice_prodotto,codice_sacca,quantita_totale,operatore_aggiornamento,data_aggiornamento) VALUES ("'.$codiceProdotto.'","'.$codiceSacca.'",'.$quantita_totale.',AES_ENCRYPT(\''.$_SESSION["operatore"].'\',\''.CHIAVE_DI_CIFRATURA.'\'), CURRENT_TIMESTAMP )';
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaOperatoreModificaSacca($codiceSacca);
    exit("UPDATED");
}



function aggiornaOperatoreModificaSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = "UPDATE sacche SET operatore_aggiornamento= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE sacca_id  = " . $codiceSacca . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function selezionaProdottiNonNellaSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM prodotti where isEliminato = false AND prodotto_id NOT IN (SELECT codice_prodotto FROM prodotti_nelle_sacche WHERE codice_sacca = '.$codiceSacca.')';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;

}

function selezionaProdottiNellaSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT *, totale_magazzino-totale_disposizione_militi as disponibilie_in_magazzino , DATE_FORMAT(data_scadenza,"%m/%Y") as data_scadenza FROM prodotti_nelle_sacche, prodotti WHERE prodotti.prodotto_id = prodotti_nelle_sacche.codice_prodotto AND codice_sacca = '.$codiceSacca;
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;

}

function generaTabellaProdottiNellaSacca($codiceSacca){
    $result = selezionaProdottiNellaSacca($codiceSacca);
    $finale='<table class="table table-striped table-bordered" id="tabellaProdottiNelleSacche">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Quantità Inserita</th>
            <th scope="col">Quantità Massima</th>
            <th scope="col">Data Di Scadenza</th>
            <th scope="col" class="text-center">Salva</th>
            <th scope="col" class="text-center">Elimina</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td class="align-middle">'.iconaAvvisoConvalida($row["isConvalidato"]).' '.$row["nome"].'</td>
            <td>
                <div class="form-group mb-1">
                    <input type="text" class="form-control valoreAttuale" id="qtaAtt'.$row["id_pns"].'" placeholder="" value="'.stampaQuantitaInserita($row["isConvalidato"],$row["quantita_attuale"]).'">
                </div>
            </td>
            <td>
                <div class="form-group mb-1">
                    <input type="text" class="form-control valoreMassimo" id="qtaTot'.$row["id_pns"].'" placeholder="" readonly value="'.$row["quantita_totale"].'">
                </div>
            </td>
            <td>
                <div class="form-group mb-1">
                    <input type="text" class="form-control dataScadenza" id="dataScad'.$row["id_pns"].'" placeholder="MM/AAAA" value="'.$row["data_scadenza"].'">
                </div>
            </td>
            <td class="text-center"><button type="button" class="btn btn-primary" onclick="aggiornaProdottoNellaSacca('.stampaQuantitaInserita($row["isConvalidato"],$row["quantita_attuale"]).','.$row["id_pns"].','.$codiceSacca.','.$row["disponibilie_in_magazzino"].','.$row["prodotto_id"].')">
                    <i class="fas fa-save"></i>
                </button></td>
            <td class="text-center"><button type="button" class="btn btn-primary" onclick="confermaEliminazione(\''.$row["nome"].'\','.$row["id_pns"].','.$codiceSacca.')" data-toggle="modal" data-target="#confermaEliminazioneProdottoNellaSacca">
                    <i class="fas fa-times"></i>
                </button></td>
        </tr>';
        }
    }


    $finale=$finale.' </tbody>
    </table>';
    return $finale;

}

function iconaAvvisoConvalida($isConvalidato){
    if(!$isConvalidato){
        return '<i title="Il prodotto è stato aggiunto alla sacca, ma non è stata ancora sigillata!" class="fas text-danger-rosso-solo fa-exclamation-triangle"></i>';
    }
}

function stampaQuantitaInserita($isConvalidato,$qtaAtt){
    if($isConvalidato){
        return "0";
    }else{
        if($qtaAtt<0)
            return $qtaAtt*-1;
        else
        return $qtaAtt;
    }
}

function generaTabellaProdottiNonNellaSacca($codiceSacca){
    $result = selezionaProdottiNonNellaSacca($codiceSacca);
    $finale='<table class="table table-striped table-bordered" id="tabellaProdottiNonNelleSacche">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Quantità Massima</th>
            <th scope="col" class="text-center">Aggiungi</th>
        </tr>
    </thead>
    <tbody>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $finale=$finale.'<tr>
            <td class="align-middle"><span id="label'.$row["prodotto_id"].'">'.$row["nome"].'</span></td>
            <td>
                <div class="form-group mb-1">
                    <input type="number" class="form-control" id="qtaMax'.$row["prodotto_id"].'" placeholder="Inserire la quantità massima">
                </div>
            </td>
            <td class="text-center"><button type="button" onclick="aggiungiProdottoNellaSacca('.$row["prodotto_id"].','.$codiceSacca.')" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                </button></td>
        </tr>';
        }
    }


    $finale=$finale.' </tbody>
    </table>';
    return $finale;

}

?>



                                            
                                