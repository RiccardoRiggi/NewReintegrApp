<?php 

    include '../db_components/dbGestione.php';

    function memorizzaZaino($nome,$mezzoId){
        $conn = apriConnessione();
        $sql = "INSERT INTO zaini (nome,mezzo_id) VALUE ('".$nome."','".$mezzoId."')";
        $conn->query($sql);
        $id=$conn->insert_id;
        chiudiConnessione($conn);
        generaLog($sql);
        return $id;      
    }

    function selezionaListaZaini(){
        $conn = apriConnessione();
        $sql = "SELECT zaini.zaino_id, zaini.nome as nome, CONCAT(mezzi.tipo,\" - \",mezzi.codice_mezzo) as posizione FROM zaini LEFT JOIN mezzi ON zaini.mezzo_id = mezzi.mezzo_id WHERE zaini.isEliminato = false ORDER BY codice_mezzo";
        generaLog($sql);
        $result = $conn->query($sql);
        chiudiConnessione($conn);
        return $result;
    }

    function getZainoSingolo($id)
{
    $conn = apriConnessione();
    $sql = 'SELECT *, AES_DECRYPT(operatore_aggiornamento,\''.CHIAVE_DI_CIFRATURA.'\') as operatore_aggiornamento , DATE_FORMAT(data_aggiornamento, "%H:%i del %d/%m/%Y") as data_aggiornamento FROM zaini WHERE isEliminato = false AND zaino_id = ? ';
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

function selezionaListaPosizioni()
{
    $conn = apriConnessione();
    $sql = 'select mezzo_id as id, CONCAT(tipo,\' - \',codice_mezzo) as nome from mezzi WHERE mezzi.isEliminato = false ORDER BY mezzi.tipo, mezzi.codice_mezzo';
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function selezionaTuttiVeicoli(){
    $conn = apriConnessione();
    $sql = "SELECT * FROM mezzi WHERE isEliminato = false AND mezzo_id != 0 ORDER BY codice_mezzo";
    generaLog($sql);
    $result = $conn->query($sql);
    chiudiConnessione($conn);
    return $result;
}

function aggiornaZainoInBaseDati($codiceZaino, $nome, $codiceMezzo)
{
    $conn = apriConnessione();
    $sql = "UPDATE zaini SET nome = ? , mezzo_id = ? , operatore_aggiornamento= AES_ENCRYPT('" . $_SESSION["operatore"] . "','".CHIAVE_DI_CIFRATURA."'), data_aggiornamento= CURRENT_TIMESTAMP";
    $sql = $sql . " WHERE zaino_id  = ? ";
    resultPreparedTre($conn,$sql,$nome,$codiceMezzo,$codiceZaino);
    chiudiConnessione($conn);
    convalidaProdotti($codiceZaino);
}

function convalidaProdotti($codiceSacca){
    $conn = apriConnessione();
    $sql = "UPDATE prodotti_negli_zaini SET isConvalidato = true";
    $sql = $sql . " WHERE codice_zaino  = ? ";
    resultPreparedUno($conn,$sql,$codiceSacca);
    chiudiConnessione($conn);
}

function getListaSacche($id)
{
    $conn = apriConnessione();
    $sql = "SELECT sacche.sacca_id as id, sacche.colore_sacca as colore, sacche.nome as nome FROM sacche WHERE sacche.zaino_id= ? ";
    $result = resultPreparedUno($conn,$sql,$id);
    chiudiConnessione($conn);
    return $result;
}

?>