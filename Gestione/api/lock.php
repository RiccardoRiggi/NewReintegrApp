<?php
session_start();

include '../CONFIG.php';

if(isset($_SESSION["timestamp"])){
    if(time()-$_SESSION["timestamp"] > SOGLIA_LOCKSCREEN)
    exit("KO");
else
    exit("OK");
}else{
    exit("ACCESSO NEGATO");
}

?>