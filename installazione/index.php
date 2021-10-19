<?php
//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//$txt = "Mickey Mouse\n";
//fwrite($myfile, $txt);
//$txt = "Minnie Mouse\n";
//fwrite($myfile, $txt);
//fclose($myfile);
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
<link rel="stylesheet" href="./css/sb-admin-2.css">
    <title>Installazione - ReintegrApp</title>
</head>

<body class="bg-gradient-danger">
    <div class="container ">
        <div class="row  justify-content-center ">
            <div class="shadow align-self-center bg-white alert">
                <form action="installazione.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col text-center">
                            <a class="text-decoration-none" href="index.php"><i class="text-danger h1 fas fa-laptop-medical"></i><span class="text-sans-serif h1 text-danger"> ReintegrApp</span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <p class="bd-logo-subtitle">Installazione</p>
                        </div>
                    </div>

                    <div class="row pt-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="nome_associazione">Nome dell'associazione</label>
                                <input value="Associazione" type="text" name="nome_associazione" required class="form-control" id="nome_associazione" placeholder="Inserire il nome dell'associazione" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="indirizzo_server_database">Host</label>
                                <input value="localhost" type="text" name="indirizzo_server_database" required class="form-control" id="indirizzo_server_database" placeholder="Inserire l'host" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username_database">Utente del database</label>
                                <input value="root" autocomplete="off" type="text" name="username_database" required class="form-control" id="username_database" placeholder="Inserire l'username" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password_database">Password del database</label>
                                <input value="" type="password" name="password_database" class="form-control" id="password_database" placeholder="Inserire la password" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="chiave_di_cifratura">Chiave di cifratura</label>
                                <input value="cifratura" type="password" name="chiave_di_cifratura" required class="form-control" id="chiave_di_cifratura" placeholder="Inserire una chiave di cifratura" maxlength="15" autocomplete="off">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email dell'utente amministratore</label>
                                <input value="info@ghiroinformatico.net" type="email" name="email" required class="form-control" id="email" placeholder="Inserire l'indirizzo email" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="password">Password dell'utente amministratore</label>
                                <input value="Alice02" type="password" name="password" class="form-control" id="password" required placeholder="Digitare la password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">Avvia installazione <i class="fas fa-sign-in-alt"></i></button>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col text-center">
                            <p>Piattaforma sviluppata <br>da <a class="text-decoration-none font-weight-bold" href="https://www.riccardoriggi.it/" target="_blank">Riccardo Riggi</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>