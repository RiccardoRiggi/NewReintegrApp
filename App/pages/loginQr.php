<?php include '../CONFIG.php';
session_start();
session_unset();
session_destroy(); ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <script src="../camera_auth/jquery-1.11.3.min.js"></script>
    <?php include './common/headscript.php'; ?>
    <title>Login Con Token - ReintegrApp</title>


</head>

<body class="altezza-piena">
    <?php include './common/headerLogin.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p><a class="text-decoration-none font-weight-bold" href="loginTokenPerso.php">Hai smarrito il token?</a></p>
                <div style="display:none;">Barcode result: <span id="dbr"></span></div>
                <div style="display: none;" class="select ">
                    <label for="videoSource">Video source: </label><select id="videoSource"></select>
                </div>
                <button style="display: none;" id="go">Read Barcode</button>
                <div>
                    <video onclick="cambiaTelecamera();" style="max-height: 53vh;" width="100%;" muted autoplay id="video" playsinline="true"></video>
                    <div style="display: none;">
                        <canvas id="pcCanvas" width="500" height="480" style="display: none; float: bottom;"></canvas>
                        <canvas id="mobileCanvas" width="240" height="320" style="display: none; float: bottom;"></canvas>
                    </div>
                </div>


                <div class="progress-spinner progress-spinner-double size-sm progress-spinner-active" id="spinnerCaricamento">
                    <div class="progress-spinner-inner"></div>
                    <div class="progress-spinner-inner"></div>
                    <span class="sr-only">Caricamento...</span>
                </div>
                <p id="testoPronto" style="display: none;">Scansiona il token di accesso</p>
            </div>
        </div>
    </div>

    <!--
    <div>Barcode result: <span id="dbr"></span></div>
    <div class="select bootstrap-select-wrapper">
        <label for="videoSource">Video source: </label><select id="videoSource"></select>
    </div>
    <button id="go">Read Barcode</button>
    <div>
        <video muted autoplay width="500" height="480" id="video" playsinline="true"></video>
        <canvas id="pcCanvas" width="500" height="480" style="display: none; float: bottom;"></canvas>
        <canvas id="mobileCanvas" width="240" height="320" style="display: none; float: bottom;"></canvas>
    </div>
-->

    <?php include './common/footerLogin.php'; ?>
    <script async src="../camera_auth/zxing.js"></script>
    <script src="../camera_auth/video.js"></script>
    <script>
        setTimeout(function() {
            setNumeroTelecamere();
            document.getElementById("spinnerCaricamento").style.display = "none";
            document.getElementById("testoPronto").style.display = "block";
            document.getElementById("go").click();


        }, 3000);
    </script>




    <script>
        //GESTIONE MULTI CAMERA

        var numeroTelecamere = 0;
        var telecameraAttuale = 0;

        function setNumeroTelecamere() {
            numeroTelecamere = document.getElementById("videoSource").options.length;
        }

        function cambiaTelecamera() {
            if (telecameraAttuale < numeroTelecamere - 1) {
                select = document.getElementById("videoSource");
                telecameraAttuale++;
                select.selectedIndex = telecameraAttuale;
                select.onchange();
                document.getElementById("testoPronto").innerHTML="Attendere...";
                setTimeout(function() {
                    document.getElementById("go").click();
                    document.getElementById("testoPronto").innerHTML="Scansiona il token di accesso";
                }, 3000);
            } else {
                select = document.getElementById("videoSource");
                telecameraAttuale = 0;
                select.selectedIndex = telecameraAttuale;
                select.onchange();
                document.getElementById("testoPronto").innerHTML="Attendere...";
                setTimeout(function() {
                    document.getElementById("go").click();
                    document.getElementById("testoPronto").innerHTML="Scansiona il token di accesso";
                }, 3000);
            }
        }
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
            if (!xDown || !yDown) {
                return;
            } //nessun movimento
            var xUp = evt.touches[0].clientX;
            var yUp = evt.touches[0].clientY;
            var xDiff = xDown - xUp;
            var yDiff = yDown - yUp;
            if (Math.abs(xDiff) > Math.abs(yDiff)) {
                /*Trovo quello più significativo sulle assi X e Y*/
                if (xDiff > 10) {

                    /* swipe sinistra */
                    console.log("Swipe SINISTRA");



                } else if (xDiff < -10) {
                    /* swipe destra */
                    console.log("Swipe DESTRA");
                    window.location.replace("loginCredenziali.php");



                } //right
            } else {
                if (yDiff > 0) {

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
</body>

</html>