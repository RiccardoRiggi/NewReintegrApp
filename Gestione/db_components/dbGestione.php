<?php

include '../CONFIG.php';

if (!function_exists('apriConnessione')) {
    function apriConnessione()
    {
        return $conn = new mysqli(INDIRIZZO_SERVER_DATABASE, USERNAME_DATABASE, PASSWORD_DATABASE, NOME_ISTANZA_DATABASE);
    }
}
if (!function_exists('chiudiConnessione')) {
    function chiudiConnessione($conn)
    {
        $conn->close();
    }
}

if (!function_exists('generaLog')) {
    function generaLog($contenuto)
    {
        if (!IS_IN_PRODUZIONE)
            file_put_contents("reintegra.log", date("h:i:s d/m/Y") . " - " . $contenuto . "\n", FILE_APPEND);
    }
}

if (!function_exists('generaQrCode')) {
    function generaQrCode($length = 50)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('resultPreparedUno')) {
    function resultPreparedUno($conn,$sql,$uno){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog("FINE PREPARED");
        $stmt->bind_param("s", $uno);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
}

if (!function_exists('resultPreparedDue')) {
    function resultPreparedDue($conn,$sql,$uno,$due){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        $due = mysqli_real_escape_string($conn, $due);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog($due);
        generaLog("FINE PREPARED");
        $stmt->bind_param("ss", $uno,$due);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
}

if (!function_exists('resultPreparedTre')) {
    function resultPreparedTre($conn,$sql,$uno,$due,$tre){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        $due = mysqli_real_escape_string($conn, $due);
        $tre = mysqli_real_escape_string($conn, $tre);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog($due);
        generaLog($tre);
        generaLog("FINE PREPARED");
        $stmt->bind_param("sss", $uno,$due,$tre);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
}

if (!function_exists('resultPreparedQuattro')) {
    function resultPreparedQuattro($conn,$sql,$uno,$due,$tre,$quattro){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        $due = mysqli_real_escape_string($conn, $due);
        $tre = mysqli_real_escape_string($conn, $tre);
        $quattro = mysqli_real_escape_string($conn, $quattro);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog($due);
        generaLog($tre);
        generaLog($quattro);
        generaLog("FINE PREPARED");
        $stmt->bind_param("ssss", $uno,$due,$tre,$quattro);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
}

if (!function_exists('resultPreparedCinque')) {
    function resultPreparedCinque($conn,$sql,$uno,$due,$tre,$quattro,$cinque){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        $due = mysqli_real_escape_string($conn, $due);
        $tre = mysqli_real_escape_string($conn, $tre);
        $quattro = mysqli_real_escape_string($conn, $quattro);
        $cinque = mysqli_real_escape_string($conn, $cinque);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog($due);
        generaLog($tre);
        generaLog($quattro);
        generaLog($cinque);
        generaLog("FINE PREPARED");
        $stmt->bind_param("sssss", $uno,$due,$tre,$quattro,$cinque);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
    
}

if (!function_exists('resultPreparedSei')) {
    function resultPreparedSei($conn,$sql,$uno,$due,$tre,$quattro,$cinque,$sei){
        $stmt = $conn->prepare($sql);
        $uno = mysqli_real_escape_string($conn, $uno);
        $due = mysqli_real_escape_string($conn, $due);
        $tre = mysqli_real_escape_string($conn, $tre);
        $quattro = mysqli_real_escape_string($conn, $quattro);
        $cinque = mysqli_real_escape_string($conn, $cinque);
        $sei = mysqli_real_escape_string($conn, $sei);
        generaLog("INIZIO PREPARED");
        generaLog($sql);
        generaLog($uno);
        generaLog($due);
        generaLog($tre);
        generaLog($quattro);
        generaLog($cinque);
        generaLog($sei);
        generaLog("FINE PREPARED");
        $stmt->bind_param("ssssss", $uno,$due,$tre,$quattro,$cinque,$sei);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;        
    }
    
}