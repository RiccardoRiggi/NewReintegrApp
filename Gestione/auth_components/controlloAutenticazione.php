<?php 




if (!function_exists('isAutenticato')) {
    function isAutenticato(){
        if(!isset($_SESSION["impronta"])){
            header('location: login.php');
        }else if($_SESSION["isInGestione"]==false){
			header('location: logout.php');	
		}else{
            verificaImpronta();
        }

    }
}

if (!function_exists('isBloccato')) {
    function isBloccato(){
        if($_SESSION["isBloccato"])
            header('location: lockscreen.php');
    }
}

if (!function_exists('verificaImpronta')) {
    function verificaImpronta(){
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $sql = "SELECT count(*) as n FROM utenti WHERE utente_id = ? AND impronta = ? AND codice_ruolo = ? AND codice_ruolo > 0 AND isEliminato = false AND isBloccato = false";
        $result = resultPreparedTre($conn,$sql,$_SESSION["utente_id"],$_SESSION["impronta"],$_SESSION["codice_ruolo"]);
        $row = $result->fetch_assoc();
        if($row["n"]==0){
            header('location: logout.php');
        }else{
            aggiornaTimestamp();
        }        
    }
}

if (!function_exists('aggiornaTimestamp')) {
    function aggiornaTimestamp(){
        $_SESSION["timestamp"]=time();
    }
}

if (!function_exists('codificaIndirizzoIp')) {
    function codificaIndirizzoIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return md5($ip_address);
    }
}

if (!function_exists('verificaIndirizzoIp')) {
    function verificaIndirizzoIp()
    {
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $ip = codificaIndirizzoIp();
        $sql = "SELECT * FROM elenco_indirizzi WHERE indirizzo = '" . $ip . "' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["is_bloccato"] || $row["n_tentativi"] == 0) {
                header("location: ./bloccato.php");
            }
        } else {
            registraNuovoIndirizzoIp($conn);
        }
    }
}

if (!function_exists('registraNuovoIndirizzoIp')) {
    function registraNuovoIndirizzoIp($conn)
    {
        $ip = codificaIndirizzoIp();
        do {
            $sql = "INSERT INTO elenco_indirizzi (indirizzo,codice_sblocco) VALUES ('" . $ip . "','" . rand(0, 999999) . "')";
        } while ($conn->query($sql) !== TRUE);
    }
}

session_start();
verificaIndirizzoIp();
isAutenticato();
isBloccato();

?>