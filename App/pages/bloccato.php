<?php include '../CONFIG.php'; include '../auth_components/autenticazione.php';?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Login - ReintegrApp</title>
</head>

<body class="altezza-piena ">
    <?php include './common/headerLogin.php'; ?>

    <div class="container pt-4">

            <div class="row">
                    <div class="col text-center">
                        <p class="lead font-weight-bold">Sei stato bloccato in modo<br> automatico dal sistema di sicurezza!</p>
                        <p class="h4 font-weight-normal">Id: <span class="blu font-weight-bold"><?php echo recuperaCodiceSblocco(); ?></span></p>
                    </div>
                </div>
                <div class="row pt-5">
                <div class="col text-center">
                    <p>Piattaforma sviluppata da <a class="text-decoration-none font-weight-bold" href="https://www.riccardoriggi.it/" target="_blank">Riccardo Riggi</a></p>
                </div>
            </div>

    </div>
</body>

</html>