<?php session_start();
include '../CONFIG.php'; include '../auth_components/autenticazione.php';verificaIndirizzoIp();?>
<?php
$stringaErrore = "";
if (isset($_POST["email"], $_POST["password"])) {
    $stringaErrore = effettuaAutenticazione($_POST["email"], md5($_POST["password"]));
}

?>



<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Autenticazione - ReintegrApp</title>
</head>

<body class="altezza-piena neutral-1-bg-a1 bg-gradiendt-danger">
    <div class="container-fluid  d-inline-block bg-gradient-danger">
        <div class="row  justify-content-center h-100">
            <div class="shadow align-self-center p-5 bg-white alert">
                <form action="login.php" method="post">
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
                    <div class="row pt-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" required class="form-control" id="email" placeholder="Inserire l'indirizzo email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required placeholder="Digitare la password">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p class="text-center text-danger-rosso-solo"><?php echo $stringaErrore; ?></p>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col text-center">
                            <a href="loginPasswordDimenticata.php" class="text-decoration-none font-weight-bold"><span class="bd-logo-subtitle">Hai dimenticato la password?</span></a>
                        </div>
                    </div>
                    -->
                    <div class="row">
                        <div class="col text-center">
                            <p>Tentativi rimanenti: <?php echo tentativiRimanenti(); ?></p>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">Login <i class="fas fa-sign-in-alt"></i></button>
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