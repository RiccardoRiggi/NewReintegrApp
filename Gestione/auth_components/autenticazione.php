<?php

if (!function_exists('apriConnessione')) {
    function effettuaAutenticazione($email, $psw)
    {

        include '../db_components/dbGestione.php';

        $conn = apriConnessione();

        $sql = "SELECT utente_id FROM utenti WHERE email = AES_ENCRYPT( ? ,'".CHIAVE_DI_CIFRATURA."') AND isEliminato = false";
        $result = resultPreparedUno($conn,$sql,$email);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sql = "SELECT utente_id, AES_DECRYPT(utenti.nome,'".CHIAVE_DI_CIFRATURA."') as nome, AES_DECRYPT(cognome,'".CHIAVE_DI_CIFRATURA."') as cognome, isBloccato, utenti.codice_ruolo, ruoli.nome as ruolo, data_primo_accesso FROM utenti JOIN ruoli ON utenti.codice_ruolo = ruoli.codice_ruolo  WHERE utente_id = ? AND email = AES_ENCRYPT( ? ,'".CHIAVE_DI_CIFRATURA."') AND password = ? AND isEliminato = false";
                $resultTwo = resultPreparedTre($conn,$sql,$row["utente_id"],$email,$psw);
                if ($resultTwo->num_rows > 0) {
                    while ($row = $resultTwo->fetch_assoc()) {
                        if ($row["codice_ruolo"] == 0) {
                            chiudiConnessione($conn);
                            return "Utente non abilitato ad accedere<br>a questa parte dell'applicativo!";
                        } else if ($row["isBloccato"]) {
                            chiudiConnessione($conn);
                            return "Utente bloccato!";
                        }
                        aggiornaDataUltimoAccesso($row["utente_id"], $conn);
                        impostaDataPrimoAccesso($row["utente_id"], $conn, $row["data_primo_accesso"]);
                        salvaUtenteInSessione($row, $conn);


                        chiudiConnessione($conn);
                    }
                } else {
                    decrementoTentativi($conn);
                    chiudiConnessione($conn);
                    return "Email e/o password errati!";
                }
            }
        } else {
            chiudiConnessione($conn);
            return "Utente non trovato!";
        }
    }
}

if (!function_exists('salvaUtenteInSessione')) {
    function salvaUtenteInSessione($utente, $conn)
    {
        $_SESSION["utente_id"] = $utente["utente_id"];
        $_SESSION["avatar"] = substr($utente["nome"], 0, 1) . substr($utente["cognome"], 0, 1);
        $_SESSION["nome"] = $utente["nome"];
        $_SESSION["cognome"] = $utente["cognome"];
        $_SESSION["impronta"] = aggiornaImpronta($utente["utente_id"], $conn);
        $_SESSION["operatore"] = $utente["nome"] . " " . $utente["cognome"];
        $_SESSION["codice_ruolo"] = $utente["codice_ruolo"];
        $_SESSION["ruolo"] = $utente["ruolo"];
        $_SESSION["isBloccato"] = false;
        $_SESSION["paginaPrecedente"] = "";
        $_SESSION["timestamp"] = time();
        $_SESSION["isInGestione"] = true;

        header('location: index.php');
    }
}

if (!function_exists('aggiornaDataUltimoAccesso')) {
    function aggiornaDataUltimoAccesso($id, $conn)
    {
        $sql = "UPDATE utenti SET data_ultimo_accesso = CURRENT_TIMESTAMP WHERE utente_id = " . $id;
        $conn->query($sql);
    }
}

if (!function_exists('impostaDataPrimoAccesso')) {
    function impostaDataPrimoAccesso($id, $conn, $data)
    {
        if ($data == null) {
            $sql = "UPDATE utenti SET data_primo_accesso = CURRENT_TIMESTAMP WHERE utente_id = " . $id;
            $conn->query($sql);
        }
    }
}

if (!function_exists('aggiornaImpronta')) {
    function aggiornaImpronta($id, $conn)
    {
        $impronta = generaImpronta();
        $sql = "UPDATE utenti SET impronta = '" . $impronta . "' WHERE utente_id = " . $id;
        $conn->query($sql);
        return $impronta;
    }
}

if (!function_exists('generaImpronta')) {
    function generaImpronta($length = 35)
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

//--- FUNZIONI PRESE DA 118 GESTIONE DA IMPLEMENTARE

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



if (!function_exists('recuperaCodiceSblocco')) {
    function recuperaCodiceSblocco()
    {
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $ip = codificaIndirizzoIp();
        $sql = "SELECT * FROM elenco_indirizzi WHERE indirizzo = '" . $ip . "' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            chiudiConnessione($conn);
            return $row["codice_sblocco"];
        } else {
            chiudiConnessione($conn);
            return "";
        }
    }
}


if (!function_exists('tentativiRimanenti')) {
    function tentativiRimanenti()
    {
        include '../db_components/dbGestione.php';
        $conn = apriConnessione();
        $sql = "SELECT n_tentativi as a FROM elenco_indirizzi WHERE indirizzo = '" . codificaIndirizzoIp() . "' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["a"] != 0) {
                chiudiConnessione($conn);
                return $row["a"];
            } else
                bloccaIndirizzoIp($conn);
        }
    }
}

if (!function_exists('decrementoTentativi')) {
    function decrementoTentativi($conn)
    {
        $sql = "SELECT n_tentativi as a FROM elenco_indirizzi WHERE indirizzo = '" . codificaIndirizzoIp() . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row["a"] == 1) {
            bloccaIndirizzoIp($conn);
        } else {
            $sql = "UPDATE elenco_indirizzi SET n_tentativi = '" . ($row["a"] - 1) . "' WHERE indirizzo = '" . codificaIndirizzoIp() . "'";
            $conn->query($sql);
        }
    }
}

if (!function_exists('bloccaIndirizzoIp')) {
    function bloccaIndirizzoIp($conn)
    {
        $sql = "UPDATE elenco_indirizzi SET n_tentativi = 0, is_bloccato = true WHERE indirizzo = '" . codificaIndirizzoIp() . "'";
        $conn->query($sql);
        include '../db_components/dbGestione.php';
        chiudiConnessione($conn);
        header("location: ../pages/bloccato.php");
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
