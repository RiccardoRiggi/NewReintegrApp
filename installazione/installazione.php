<?php 

    function generaConfigGestione(){
        $myfile = fopen("../gestione/CONFIG.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php".PHP_EOL);
        fwrite($myfile, 'if(!defined("NOME_ASSOCIAZIONE")) '.PHP_EOL);
        fwrite($myfile, 'define("NOME_ASSOCIAZIONE","'.$_POST["nome_associazione"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("SOGLIA_LOCKSCREEN"))'.PHP_EOL);
        fwrite($myfile, 'define("SOGLIA_LOCKSCREEN",300);'.PHP_EOL);
        fwrite($myfile, 'if(!defined("SOGLIA_PRODOTTI_IN_ESAURIMENTO"))'.PHP_EOL);
        fwrite($myfile, 'define("SOGLIA_PRODOTTI_IN_ESAURIMENTO",10);'.PHP_EOL);
        fwrite($myfile, 'if(!defined("IS_IN_PRODUZIONE"))'.PHP_EOL);
        fwrite($myfile, 'define("IS_IN_PRODUZIONE",true);'.PHP_EOL);
        fwrite($myfile, 'if(!defined("INDIRIZZO_SERVER_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("INDIRIZZO_SERVER_DATABASE","'.$_POST["indirizzo_server_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("NOME_ISTANZA_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("NOME_ISTANZA_DATABASE","reintegra");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("USERNAME_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("USERNAME_DATABASE","'.$_POST["username_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("PASSWORD_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("PASSWORD_DATABASE","'.$_POST["password_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("NUMERO_VERSIONE"))'.PHP_EOL);
        fwrite($myfile, 'define("NUMERO_VERSIONE","2.0.0");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("CHIAVE_DI_CIFRATURA"))'.PHP_EOL);
        fwrite($myfile, 'define("CHIAVE_DI_CIFRATURA","'.$_POST["chiave_di_cifratura"].'");'.PHP_EOL);
        fwrite($myfile, "?>");
        fclose($myfile);
    }

    function generaConfigApp(){
        $myfile = fopen("../app/CONFIG.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php".PHP_EOL);
        fwrite($myfile, 'if(!defined("NOME_ASSOCIAZIONE")) '.PHP_EOL);
        fwrite($myfile, 'define("NOME_ASSOCIAZIONE","'.$_POST["nome_associazione"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("SOGLIA_PRODOTTI_IN_ESAURIMENTO"))'.PHP_EOL);
        fwrite($myfile, 'define("SOGLIA_PRODOTTI_IN_ESAURIMENTO",10);'.PHP_EOL);
        fwrite($myfile, 'if(!defined("IS_IN_PRODUZIONE"))'.PHP_EOL);
        fwrite($myfile, 'define("IS_IN_PRODUZIONE",true);'.PHP_EOL);
        fwrite($myfile, 'if(!defined("INDIRIZZO_SERVER_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("INDIRIZZO_SERVER_DATABASE","'.$_POST["indirizzo_server_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("NOME_ISTANZA_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("NOME_ISTANZA_DATABASE","reintegra");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("USERNAME_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("USERNAME_DATABASE","'.$_POST["username_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("PASSWORD_DATABASE"))'.PHP_EOL);
        fwrite($myfile, 'define("PASSWORD_DATABASE","'.$_POST["password_database"].'");'.PHP_EOL);
        fwrite($myfile, 'if(!defined("CHIAVE_DI_CIFRATURA"))'.PHP_EOL);
        fwrite($myfile, 'define("CHIAVE_DI_CIFRATURA","'.$_POST["chiave_di_cifratura"].'");'.PHP_EOL);
        fwrite($myfile, "?>");
        fclose($myfile);
    }

    function creaDatabase(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];

        $conn = mysqli_connect($servername, $username, $password);
        if (!$conn) {
            $erroreGlobale = true;
            die("Connection failed: " . mysqli_connect_error());
        }

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS reintegra";
        if (mysqli_query($conn, $sql)) {
        echo "<p>Database creato con successo</p>";
        } else {
            $erroreGlobale = true;
            echo "Error creating database: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    function eseguiCreateTable(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];
        $mysql_database = "reintegra";
 
        $db = new PDO("mysql:host=$servername;dbname=$mysql_database", $username, $password);

        $query = file_get_contents("./db/reintegra.sql");

        $stmt = $db->prepare($query);

        if ($stmt->execute()){
            echo "<p>Tabelle importate correttamente</p>";
        }else{ 
            echo "Fail";
            $erroreGlobale = true;
        }
    }

    function eseguiSetupConfigMenu(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];
        $mysql_database = "reintegra";
 
        $db = new PDO("mysql:host=$servername;dbname=$mysql_database", $username, $password);

        $query = file_get_contents("./db/config_menu.sql");

        $stmt = $db->prepare($query);

        if ($stmt->execute()){
            echo "<p>Voci di menu importate con successo</p>";
        }else{ 
            echo "Fail";
            $erroreGlobale = true;
        }
        $db = null;
    }

    function eseguiSetupConfigRuoli(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];
        $mysql_database = "reintegra";
 
        $db = new PDO("mysql:host=$servername;dbname=$mysql_database", $username, $password);

        $query = file_get_contents("./db/config_ruoli.sql");

        $stmt = $db->prepare($query);

        if ($stmt->execute()){
            echo "<p>Ruoli importati con successo</p>";
        }else{ 
            echo "Fail";
            $erroreGlobale = true;
        }
        $db = null;
    }

    function eseguiSetupConfigVociMenu(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];
        $mysql_database = "reintegra";
 
        $db = new PDO("mysql:host=$servername;dbname=$mysql_database", $username, $password);

        $query = file_get_contents("./db/config_menu_voci.sql");

        $stmt = $db->prepare($query);

        if ($stmt->execute()){
            echo "<p>Configurazione privilegi eseguita con successo</p>";
        }else{ 
            echo "Fail";
            $erroreGlobale = true;
        }
        $db = null;
    }

    function creaUtenteAmministratore(){
        $servername = $_POST["indirizzo_server_database"];
        $username = $_POST["username_database"];
        $password = $_POST["password_database"];
        $dbname = "reintegra";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO utenti (nome,cognome,sesso,data_di_nascita,numero_dae,isCertificato,comune_residenza,via,civico,interno,numero_tessera,email,password,codice_qr,operatore_assegnazione_token,codice_ruolo) VALUE (AES_ENCRYPT('Nome','".$_POST["chiave_di_cifratura"]."') ,AES_ENCRYPT('Cognome','".$_POST["chiave_di_cifratura"]."'),AES_ENCRYPT('donna','".$_POST["chiave_di_cifratura"]."'),'2000-01-01','0000/00','1',AES_ENCRYPT('','".$_POST["chiave_di_cifratura"]."'),AES_ENCRYPT('','".$_POST["chiave_di_cifratura"]."'),AES_ENCRYPT('','".$_POST["chiave_di_cifratura"]."'),AES_ENCRYPT('','".$_POST["chiave_di_cifratura"]."'),'0000',AES_ENCRYPT('".$_POST["email"]."','".$_POST["chiave_di_cifratura"]."'),'".md5($_POST["password"])."','',AES_ENCRYPT('','".$_POST["chiave_di_cifratura"]."'),9)
        ";

        if (mysqli_query($conn, $sql)) {
        echo "<p>Utente super user creato con successo</p>";
        echo "<p>Credenziali di accesso: </p>";
        echo "<p>Email: ".$_POST["email"]."</p>";
        echo "<p>Password: quella scelta da te al momento dell'installazione".$_POST["password"]."</p>";
        echo "<p>Sul documento e alla voce Documentazione troverai ulteriori istruzioni per proseguire nell'installazione</p>";
        echo "<p>Verrai rediretto sulla pagina di login fra pochi secondi...</p>".PHP_EOL;
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $erroreGlobale = true;
        }

        mysqli_close($conn);
    }

    $erroreGlobale = false;
    generaConfigGestione();
    generaConfigApp();
    creaDatabase();
    eseguiCreateTable();
    eseguiSetupConfigMenu();
    eseguiSetupConfigRuoli();
    eseguiSetupConfigVociMenu();
    creaUtenteAmministratore();

    if(!$erroreGlobale){
        echo '<meta http-equiv="refresh" content="10;url=../gestione/pages/" />';
    }

    



?>