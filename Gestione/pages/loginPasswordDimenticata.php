<?php session_start(); include '../CONFIG.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">
    <head>
        <?php include './common/headscript.php'; ?>
        <title></title>
    </head>
    <body class="altezza-piena neutral-1-bg-a1">
        <div class="container-fluid h-100 d-inline-block">
            <div class="row  justify-content-center h-100">  
                <div class="shadow align-self-center p-5 bg-white">
                    <div class="row">
                        <div class="col">
                            <a class="text-decoration-none" href="login.php"><i class="testo-blu h1 fas fa-laptop-medical"></i><span class="text-sans-serif h1 testo-blu">   ReintegrApp</span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <p class="bd-logo-subtitle"><?php echo NOME_ASSOCIAZIONE; ?></p>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Inserire l'indirizzo email">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-3 text-center">
                            <a href="login.php"><button type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></button></a>
                        </div>
                        <div class="col-9 text-center">
                            <button type="button" class="btn btn-primary">Recupera password <i class="fas fa-key"></i></button>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col text-center">
                            <p>Piattaforma sviluppata <br>da <a class="text-decoration-none font-weight-bold" href="https://www.riccardoriggi.it/" target="_blank">Riccardo Riggi</a></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>   
    </body>
</html>