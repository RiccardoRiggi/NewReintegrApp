<?php
include '../db_components/dbGestione.php';


function selezionaListaPosizioni()
{
    $conn = apriConnessione();
    $sql = '(SELECT CONCAT(\'Z\',zaino_id) as id, CONCAT(zaini.nome,\' - \',mezzi.codice_mezzo) as nome from zaini, mezzi where zaini.mezzo_id = mezzi.mezzo_id AND mezzi.isEliminato = false AND zaini.isEliminato = false ORDER BY mezzi.tipo, mezzi.codice_mezzo) UNION (select CONCAT(\'M\',mezzo_id) as id, CONCAT(tipo,\' - \',codice_mezzo) as nome from mezzi WHERE mezzi.isEliminato = false ORDER BY mezzi.tipo, mezzi.codice_mezzo)';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function salvaSaccaMezzo($nome, $colore, $id)
{
    $conn = apriConnessione();
    $nome = mysqli_real_escape_string($conn, $nome);
    $sql = "INSERT INTO sacche (nome,colore_sacca,mezzo_id,data_aggiornamento,operatore_aggiornamento,data_sigillo,operatore_sigillo,codice_sigillo,colore_sigillo) VALUE ('" . $nome . "','" . $colore . "'," . $id . ",CURRENT_TIMESTAMP,AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'),CURRENT_TIMESTAMP,AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."') ,'','')";
    $conn->query($sql);
    $id = $conn->insert_id;
    chiudiConnessione($conn);
    generaLog($sql);
    return $id;
}

function salvaSaccaZaino($nome, $colore, $id)
{
    $conn = apriConnessione();
    $sql = "INSERT INTO sacche (nome,colore_sacca,zaino_id,data_aggiornamento,operatore_aggiornamento,data_sigillo,operatore_sigillo,codice_sigillo,colore_sigillo) VALUE ('" . $nome . "','" . $colore . "'," . $id . ",CURRENT_TIMESTAMP,AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'),CURRENT_TIMESTAMP,AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."') ,'','')";
    $conn->query($sql);
    $id = $conn->insert_id;
    chiudiConnessione($conn);
    generaLog($sql);
    return $id;
}

function getListaSacche()
{
    $conn = apriConnessione();
    $sql = "( SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome, CONCAT(zaini.nome,' - ',mezzi.tipo,' ',mezzi.codice_mezzo) as posizione FROM sacche, zaini, mezzi WHERE zaini.mezzo_id = mezzi.mezzo_id and sacche.zaino_id = zaini.zaino_id and  sacche.zaino_id is not null and sacche.mezzo_id is null and sacche.isEliminato = false AND mezzi.isEliminato = false ) UNION (SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome, CONCAT(mezzi.tipo,' ',mezzi.codice_mezzo) as nome FROM sacche, zaini, mezzi WHERE sacche.mezzo_id = mezzi.mezzo_id and  sacche.zaino_id is null and sacche.mezzo_id is not null and sacche.isEliminato = false AND mezzi.isEliminato = false)";
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

/*

QUERY FUNZIONANTE SOTTO

I CAMPI DEVONO ESSERE VARBINARY 1024

FARE SOLO PER I CAMPI NOMINATIVI DELLA TABELLA UTENTI E DOVE SONO RICHIAMATI

*/

function getSaccaSingola($id)
{
    $conn = apriConnessione();
    $sql = 'SELECT *, AES_DECRYPT(operatore_aggiornamento,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_aggiornamento , AES_DECRYPT(operatore_sigillo,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_sigillo, DATE_FORMAT(data_aggiornamento, "%H:%i del %d/%m/%Y") as data_aggiornamento, DATE_FORMAT(data_sigillo, "%H:%i del %d/%m/%Y") as data_sigillo, (SELECT codice_sigillo+1 FROM `sacche` ORDER BY data_sigillo DESC LIMIT 1) as sigilloSuggerito FROM sacche WHERE isEliminato = false AND sacca_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function aggiornaSaccaZaino($codicePosizione, $codiceSacca)
{
    $conn = apriConnessione();
    $sql = "UPDATE sacche SET zaino_id = ?";
    $sql = $sql . " WHERE sacca_id  = ? ";
    resultPreparedDue($conn,$sql,$codicePosizione,$codiceSacca);
    chiudiConnessione($conn);
}

function aggiornaSaccaMezzo($codicePosizione, $codiceSacca)
{
    $conn = apriConnessione();
    $sql = "UPDATE sacche SET mezzo_id = ? ";
    $sql = $sql . " WHERE sacca_id  = ? ";
    resultPreparedDue($conn,$sql,$codicePosizione,$codiceSacca);
    chiudiConnessione($conn);
}

function aggiornaSaccaInBaseDati($codiceSacca, $nome, $colore, $coloreSigillo, $codiceSigillo)
{
    inserisciInStoricoSigillo($codiceSacca);
    $conn = apriConnessione();
    $sql = "UPDATE sacche SET nome = ? , colore_sacca = ? , colore_sigillo = ? , codice_sigillo= ? , operatore_aggiornamento= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), operatore_sigillo= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP, data_sigillo= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE sacca_id  = ? ";
    resultPreparedCinque($conn,$sql,$nome,$colore,$coloreSigillo,$codiceSigillo,$codiceSacca);
    chiudiConnessione($conn);
    convalidaProdottiSacca($codiceSacca);
}

function inserisciInStoricoSigillo($codiceSacca)
{
    $conn = apriConnessione();
    $sql = "INSERT INTO storico_sigilli (codice_sacca,codice_sigillo,colore_sigillo,operatore,data_sigillo) SELECT sacca_id, codice_sigillo, colore_sigillo, operatore_sigillo, data_sigillo FROM sacche WHERE sacca_id = ? ";
    resultPreparedUno($conn,$sql,$codiceSacca);
    chiudiConnessione($conn);
    generaLog($sql);
}

function convalidaProdottiSacca($codiceSacca){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti_nelle_sacche SET isConvalidato = true";
    $sql = $sql . " WHERE codice_sacca  = ? ";
    resultPreparedUno($conn,$sql,$codiceSacca);
    chiudiConnessione($conn);
}


