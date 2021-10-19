<?php session_start(); include'../CONFIG.php'; ?>
<?php
$errore="";
if (!$_SESSION["isBloccato"]) {
    $_SESSION["paginaPrecedente"] = $_SERVER['HTTP_REFERER'];
    $_SESSION["isBloccato"] = true;
} else if ($_SESSION["isBloccato"] && isset($_POST["password"])) {
    include '../auth_components/sbloccoSessione.php';
       $errore = sbloccaSessione($_SESSION["utente_id"],$_SESSION["impronta"],md5($_POST["password"]));
}


?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Sessione Bloccata - ReintegrApp</title>
</head>

<body class="altezza-piena neutral-1-bg-a1">
    <div class="container-fluid  d-inline-block bg-gradient-danger">
        <div class="row  justify-content-center h-100">

            <div class="shadow align-self-center p-5 bg-white alert">
                <form action="lockscreen.php" method="POST">
                    <div class="row">
                        <div class="col text-center">
                            <a class="text-decoration-none" href="lockscreen.php"><i class="text-danger h1 fas fa-laptop-medical"></i><span class="text-sans-serif h1 text-danger"> ReintegrApp</span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <p class="bd-logo-subtitle"><?php echo NOME_ASSOCIAZIONE; ?></p>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <div class="col text-center">
                            <div class="avatar avatar-primary size-xxl">
                                <p aria-hidden="true">Bentornato <?php echo $_SESSION["operatore"]; ?>!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p class="text-center text-danger-rosso-solo"><?php echo $errore; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" required name="password" class="form-control" id="password" placeholder="Digitare la password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row pt-3">
                        <div class="col text-center">
                            <a href="logout.php"><button type="button" class="btn btn-outline-danger">Logout <i class="fas fa-sign-out-alt"></i></button></a>
                        </div>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-danger">Sblocca <i class="fas fa-unlock-alt"></i></button>
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