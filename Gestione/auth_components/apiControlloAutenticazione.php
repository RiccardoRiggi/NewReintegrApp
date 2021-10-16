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
        $sql = "SELECT count(*) as n FROM utenti WHERE utente_id = ? AND impronta = ? AND codice_ruolo = ? AND codice_ruolo > 0 AND isEliminato = false AND isBloccato = false";
        $result = resultPreparedTre($conn,$sql,$_SESSION['utente_id'],$_SESSION['impronta'],$_SESSION['codice_ruolo']);
        $row = $result->fetch_assoc();
        if($row["n"]==0){
            return false;
        }else{
            return true;
        }        
    }
}

if (!function_exists('controllaAutenticazioneApi')) {
    function controllaAutenticazioneApi(){
        session_start();
        if(isAutenticatoAPI()==false || isBloccatoAPI()){
            http_response_code(500);
            exit("ERROR");
        }
            
    }
}




?>