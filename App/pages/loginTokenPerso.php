<?php include '../CONFIG.php'; session_start(); session_unset(); session_destroy(); ?>

<?php 
    $stringaErrore="";
    if(isset($_POST["email"])){
        include '../auth_components/autenticazione.php';
        $stringaErrore=bloccaTokenByEmail($_POST["email"]);
    }
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Token Perso - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/headerLogin.php'; ?>

    <div class="container pt-4">

        <form action="loginTokenPerso.php" method="post" class="needs-validation" novalidate>
        <div class="row mb-1">
                <div class="col">
                    <p class="text-justify">Inserisci il tuo indirizzo email associato al tuo account per avviare la richiesta di un nuovo token di accesso. <br> <strong>Attenzione!</strong> Dopo aver avviato la procedura <strong>il tuo token cartaceo attuale verrà bloccato permanentemente</strong> e non sarà più utilizzabile per accedere alla piattaforma. <br>Il nuovo token ti verrà consegnato da un responsabile dell'associazione.</p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col">
                    <div class="form-group mb-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" required class="form-control" id="email" placeholder="Inserire l'indirizzo email">
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <p class="text-center text-danger-rosso-solo"><?php echo $stringaErrore; ?></p>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary btn-block">Richiedi un nuovo token <i class="fas fa-qrcode"></i></button>
                </div>
            </div>
        </form>

    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    }, false);
                    form.classList.add('was-validated');
                });
            }, false);
        })();
    </script>


    <?php include './common/footerLogin.php'; ?>
</body>

</html>