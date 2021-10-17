<?php include '../auth_components/autenticazione.php';include '../CONFIG.php';?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Indirizzo IP Bloccato - ReintegrApp</title>
</head>

<body class="altezza-piena neutral-1-bg-a1">
    <div class="container-fluid h-100 d-inline-block bg-gradient-danger">
        <div class="row  justify-content-center h-100">
            <div class="shadow align-self-center p-5 bg-white alert">
                <div class="row">
                    <div class="col text-center">
                        <a class="text-decoration-none" href="login.php"><i class="text-danger h1 fas fa-laptop-medical"></i><span class="text-sans-serif h1 text-danger"> ReintegrApp</span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <p class="bd-logo-subtitle"><?php echo NOME_ASSOCIAZIONE; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <p class="lead font-weight-bold">Sei stato bloccato in modo<br> automatico dal sistema di sicurezza!</p>
                        <p class="h4 font-weight-normal">Id: <span class="blu font-weight-bold"><?php echo recuperaCodiceSblocco(); ?></span></p>
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