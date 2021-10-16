<?php 

/*
    COMANDI
    sin=Seleziona prodotti nella sacca
    sout=Seleziona prodotti non nella sacca 
    a=aggiungi
    u=update/aggiorna
    dP=cancella prodotto
    d=cancella zaino

*/

include '../auth_components/apiControlloAutenticazione.php'; 
controllaAutenticazioneApi();
if(!isset($_GET["id"],$_GET["c"])){
    http_response_code(500);
    exit("ERROR");  
}else{
    generaLog($_GET["c"]);
    if($_GET["c"]=="d"){
        exit(cancellaZaino($_GET["id"]));
    }
    if($_GET["c"]=="sin"){
        exit(generaTabellaProdottiNelloZaino($_GET["id"]));
    }
    if($_GET["c"]=="sout"){
        exit(generaTabellaProdottiNonNelloZaino($_GET["id"]));
    }
    if($_GET["c"]=="a"){
        exit(aggiungiProdottoNelloZaino($_GET["id"],$_GET["sacca"],$_GET["qtaMax"]));
    }
    if($_GET["c"]=="u"){
        exit(aggiornaProdottoNelloZaino($_GET["id"],$_GET["qtaAtt"],$_GET["qtaTot"],$_GET["dataScad"],$_GET["codiceSacca"],$_GET["codiceProdotto"],$_GET["labelAggiunta"]));
    }
    if($_GET["c"]=="dp"){
        exit(eliminaProdottoNelloZaino($_GET["id"],$_GET["codiceSacca"]));
    } 
}

function cancellaZaino($codiceZaino){
    $conn = apriConnessione();
    $sql = "UPDATE zaini SET isEliminato = true, operatore_eliminazione = AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_eliminazione= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE zaino_id  = " . $codiceZaino . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function eliminaProdottoNelloZaino($id,$codiceSacca){
    $conn = apriConnessione();
    $sql="DELETE FROM prodotti_negli_zaini WHERE id_pnz =".$id;
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaOperatoreModificaZaino($codiceSacca);
    exit("UPDATED");
}

function aggiornaProdottoNelloZaino($id,$qtaAtt,$qtaTot,$dataScad,$codiceSacca,$codiceProdotto,$labelAtt){
    $dataScad=substr($dataScad,6,4)."-".substr($dataScad,3,2)."-".substr($dataScad,0,2);
    $conn = apriConnessione();
    $sql = 'UPDATE prodotti_negli_zaini SET isConvalidato = true,  quantita_attuale = '.$labelAtt.' , quantita_totale = '.$qtaTot.' , data_scadenza = "'.$dataScad.'" , operatore_aggiornamento = AES_ENCRYPT(\''.$_SESSION["operatore"].'\',"'.CHIAVE_DI_CIFRATURA.'") , data_aggiornamento = CURRENT_TIMESTAMP WHERE id_pnz = '.$id;
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    annullaConvalidazioneProdottoNelloZaino($id);
    aggiornaOperatoreModificaZaino($codiceSacca);
    aggiornaQuantitaInMagazzino($codiceProdotto,$qtaAtt);
    exit("UPDATED");
}

function aggiornaQuantitaInMagazzino($codiceProdotto,$qtaAtt){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti SET totale_magazzino = totale_magazzino-".$qtaAtt.", operatore_aggiornamento = AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."') data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE prodotto_id  = " . $codiceProdotto . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function annullaConvalidazioneProdottoNelloZaino($id){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti_negli_zaini SET isConvalidato = false";
    $sql = $sql . " WHERE id_pnz  = " . $id . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}


function aggiungiProdottoNelloZaino($codiceProdotto,$codiceSacca,$quantita_totale){
    $conn = apriConnessione();
    $sql = 'INSERT INTO prodotti_negli_zaini (codice_prodotto,codice_zaino,quantita_totale,operatore_aggiornamento,data_aggiornamento) VALUES ("'.$codiceProdotto.'","'.$codiceSacca.'",'.$quantita_totale.',AES_ENCRYPT(\''.$_SESSION["operatore"].'\',"'.CHIAVE_DI_CIFRATURA.'"), CURRENT_TIMESTAMP )';
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
    aggiornaOperatoreModificaZaino($codiceSacca);
    exit("UPDATED");
}



function aggiornaOperatoreModificaZaino($codiceSacca){
    $conn = apriConnessione();
    $sql = "UPDATE zaini SET operatore_aggiornamento= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."') data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE zaino_id  = " . $codiceSacca . " ";
    generaLog($sql);
    $conn->query($sql);
    chiudiConnessione($conn);
}

function selezionaProdottiNonNelloZaino($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT * FROM prodotti where isEliminato = false AND prodotto_id NOT IN (SELECT codice_prodotto FROM prodotti_negli_zaini WHERE codice_zaino = '.$codiceSacca.')';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;

}

function selezionaProdottiNelloZaino($codiceSacca){
    $conn = apriConnessione();
    $sql = 'SELECT *, totale_magazzino-totale_disposizione_militi as disponibilie_in_magazzino , DATE_FORMAT(data_scadenza,"%m/%Y") as data_scadenza FROM prodotti_negli_zaini, prodotti WHERE prodotti.prodotto_id = prodotti_negli_zaini.codice_prodotto AND codice_zaino = '.$codiceSacca;
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;

}

function generaTabellaProdottiNelloZaino($codiceSacca){
    $result = selezionaProdottiNelloZaino($codiceSacca);
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
                    <input type="text" class="form-control valoreAttuale" id="qtaAtt'.$row["id_pnz"].'" placeholder="" value="'.stampaQuantitaInserita($row["isConvalidato"],$row["quantita_attuale"]).'">
                </div>
            </td>
            <td>
                <div class="form-group mb-1">
                    <input type="text" class="form-control valoreMassimo" id="qtaTot'.$row["id_pnz"].'" placeholder="" readonly value="'.$row["quantita_totale"].'">
                </div>
            </td>
            <td>
                <div class="form-group mb-1">
                    <input type="text" class="form-control dataScadenza" id="dataScad'.$row["id_pnz"].'" placeholder="MM/AAAA" value="'.$row["data_scadenza"].'">
                </div>
            </td>
            <td class="text-center"><button type="button" class="btn btn-primary" onclick="aggiornaProdottoNellaSacca('.stampaQuantitaInserita($row["isConvalidato"],$row["quantita_attuale"]).','.$row["id_pnz"].','.$codiceSacca.','.$row["disponibilie_in_magazzino"].','.$row["prodotto_id"].')">
                    <i class="fas fa-save"></i>
                </button></td>
            <td class="text-center"><button type="button" class="btn btn-primary" onclick="confermaEliminazione(\''.$row["nome"].'\','.$row["id_pnz"].','.$codiceSacca.')" data-toggle="modal" data-target="#confermaEliminazioneProdottoNellaSacca">
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
        return '<i title="Il prodotto è stato aggiunto allo zaino, clicca su Salva in alto a destra per confermare le modifiche!" class="fas text-danger-rosso-solo fa-exclamation-triangle"></i>';
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

function generaTabellaProdottiNonNelloZaino($codiceSacca){
    $result = selezionaProdottiNonNelloZaino($codiceSacca);
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