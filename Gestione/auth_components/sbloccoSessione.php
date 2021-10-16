<?php

if (!function_exists('sbloccaSessione')) {
    function sbloccaSessione($id,$impronta,$password){
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $sql = "SELECT count(*) as n FROM utenti  WHERE utente_id = ? AND impronta = ? AND password = ? AND isEliminato = false";
        $resultTwo = resultPreparedTre($conn,$sql,$id,$impronta,$password);
        if ($resultTwo->num_rows > 0) {
            $row = $resultTwo->fetch_assoc();
            if($row["n"]==1){
                $_SESSION["isBloccato"] = false;
                $_SESSION["timestamp"]=time();
                header('location: '.$_SESSION["paginaPrecedente"]);
            }else{
                return "Password non corretta!";
            }
        }
    }
}

?>