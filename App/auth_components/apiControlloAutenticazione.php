<?php 


//FUNZIONA
if (!function_exists('isAutenticatoAPI')) {
    function isAutenticatoAPI(){
        if(!isset($_SESSION["impronta"])){
            return false;
        }else{
            verificaImprontaAPI();
            return true;
        }

    }
}

//FUNZIONA
if (!function_exists('isBloccatoAPI')) {
    function isBloccatoAPI(){
        if(isset($_SESSION["isBloccato"])){
            if($_SESSION["isBloccato"]){
                return true;
            }else{
                return false;
            } 
        }else{
            return true;
        }

                   
    }
}
//FUNZIONA
if (!function_exists('verificaImprontaAPI')) {
    function verificaImprontaAPI(){
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $sql = "SELECT count(*) as n FROM utenti WHERE utente_id = ? AND impronta = ? AND isEliminato = false AND isBloccato = false";
        $result = resultPreparedDue($conn,$sql,$_SESSION["utente_id"],$_SESSION["impronta"]);
        $row = $result->fetch_assoc();
        if($row["n"]==0){
            return false;
        }else{
            aggiornaTimestampAPI();
            return true;
        }        
    }
}

if (!function_exists('aggiornaTimestampAPI')) {
    function aggiornaTimestampAPI(){
        $_SESSION["timestamp"]=time();
    }
}

if (!function_exists('controllaAutenticazioneApi')) {
    function controllaAutenticazioneApi(){
        session_start();
        include '../db_components/dbGestione.php';
        if(isAutenticatoAPI()==false){
            http_response_code(500);
            exit("ERROR");
        }
            
    }
}




?>