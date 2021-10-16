<?php include '../CONFIG.php';include '../auth_components/autenticazione.php'; session_start(); session_unset(); verificaIndirizzoIp(); ?>


<?php

$stringaErrore = "";
if (isset($_POST["email"], $_POST["password"])) {
    $stringaErrore = effettuaAutenticazione($_POST["email"], md5($_POST["password"]));
} else if (isset($_GET["tokenId"])) {
    $stringaErrore = autenticaConTokenCartaceo($_GET["tokenId"]);
}

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Login - ReintegrApp</title>
</head>

<body class="altezza-piena ">
    <?php include './common/headerLogin.php'; ?>

    <div class="container pt-4">

        <form action="loginCredenziali.php" method="post" class="needs-validation" novalidate>
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
            <div class="row mb-1">
                <div class="col">
                    <p class="text-center text-danger-rosso-solo"><?php echo $stringaErrore; ?></p>
                </div>
            </div>
            <div class="row">
                        <div class="col text-center">
                            <p>Tentativi rimanenti: <?php echo tentativiRimanenti(); ?></p>
                        </div>
                    </div>
            <div class="row">
                <div class="col text-center">
                    <a href="loginPasswordDimenticata.php" class="text-decoration-none font-weight-bold"><span class="bd-logo-subtitle">Hai dimenticato la password?</span></a>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary btn-block">Login <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col text-center">
                    <p>Piattaforma sviluppata da <a class="text-decoration-none font-weight-bold" href="https://www.riccardoriggi.it/" target="_blank">Riccardo Riggi</a></p>
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
    <script>
            document.addEventListener('touchstart', handleTouchStart, false); //bind & fire - evento di inizio tocco
            document.addEventListener('touchmove', handleTouchMove, false); // bind & fire - evento di movimento durante il tocco
            var xDown = null;
            var yDown = null;
            function handleTouchStart(evt) {
                xDown = evt.touches[0].clientX;
                yDown = evt.touches[0].clientY;
            };
            function handleTouchMove(evt) {
                if ( ! xDown || ! yDown ) {
                    return;
                } //nessun movimento
                var xUp = evt.touches[0].clientX;
                var yUp = evt.touches[0].clientY;
                var xDiff = xDown - xUp;
                var yDiff = yDown - yUp;
                if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*Trovo quello più significativo sulle assi X e Y*/
                    if ( xDiff > 10 ) {

                        /* swipe sinistra */
                        console.log("Swipe SINISTRA");
                        window.location.replace("loginQr.php");


                    } else if(xDiff < -10){
                        /* swipe destra */
                        console.log("Swipe DESTRA");



                    }//right
                } else {
                    if ( yDiff > 0 ) {

                        /* swipe alto */
                        console.log("Swipe ALTO");

                    } else {

                        /* swipe basso */
                        console.log("Swipe BASSO");

                    }
                }
                /* reset values */
                xDown = null;
                yDown = null;
            };
            //Gesture
        </script>


    <?php include './common/footerLogin.php'; ?>
</body>

</html>