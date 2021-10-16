<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../business/gestioneReintegrazioneBusiness.php'; ?>

<?php

if (isset($_GET["mezzo_id"])) {
    $_SESSION["reintegrazione_id"] = creaNuovaReintegrazione($_GET["mezzo_id"]);
    $_SESSION["isVeicoloScelto"] = true;
    $_SESSION["veicoli"] = $_SESSION["veicoli"] + 1;

    header('location: selezionaProdotto.php');
} else if (!isset($_SESSION["isVeicoloScelto"])) {
    header('location: selezionaVeicolo.php');
} else if ($_SESSION["isVeicoloScelto"] == false) {
    header('location: selezionaVeicolo.php');
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <script src="../camera_products/jquery-1.11.3.min.js"></script>
    <?php include './common/headscript.php'; ?>
    <title>Seleziona Prodotto - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div style="display:none;">Barcode result: <span id="dbr"></span></div>
                <div style="display: none;" class="select ">
                    <label for="videoSource">Video source: </label><select id="videoSource"></select>
                </div>
                <button style="display: none;" id="go">Read Barcode</button>
                <div>
                    <video onclick="cambiaTelecamera();" style="max-height: 50vh;" width="100%;" muted autoplay id="video" playsinline="true"></video>
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
                <p id="testoPronto" style="display: none;">Scansiona il codice del prodotto</p>
                <div class="row">
                    <div class="col">
                        <a href="ringraziamentiReintegro.php"><button type="button" class="btn btn-primary btn-lg">Ho finito</button></a>
                    </div>
                </div>
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

    <script async src="../camera_products/zxing.js"></script>
    <script src="../camera_products/video.js"></script>
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
                document.getElementById("testoPronto").innerHTML = "Attendere...";
                setTimeout(function() {
                    document.getElementById("go").click();
                    document.getElementById("testoPronto").innerHTML = "Scansiona il codice del prodotto";
                }, 3000);
            } else {
                select = document.getElementById("videoSource");
                telecameraAttuale = 0;
                select.selectedIndex = telecameraAttuale;
                select.onchange();
                document.getElementById("testoPronto").innerHTML = "Attendere...";
                setTimeout(function() {
                    document.getElementById("go").click();
                    document.getElementById("testoPronto").innerHTML = "Scansiona il codice del prodotto";
                }, 3000);
            }
        }
    </script>


    <?php include './common/footer.php'; ?>

    <?php
    if (isset($_GET["error"]) && $_GET["error"] == "404") {        
        echo '<div class="notification bottom-fix with-icon error" role="alert" aria-labelledby="not1e-title" id="prodottoNonTrovato">
            <h5 id="not1e-title"><i class="fas fa-exclamation-triangle text-danger-rosso-solo"></i> <span>Errore!<span></h5>
            <p>Il codice scansionato non corrisponde a nessun prodotto presente in magazzino.</p>
        </div>';
        echo "<script>notificationShow('prodottoNonTrovato',4000);</script>";
    }else if (isset($_GET["error"]) && $_GET["error"] == 200) {
        
        echo '<div class="notification bottom-fix with-icon info" role="alert" aria-labelledby="not1e-title" id="prodottoAggiunto">
            <h5 id="not1e-title"><i class="fas fa-check testo-blu"></i> <span class="text-blu ">Salvataggio eseguito!<span></h5>
            <p>Il movimento è stato registrato con successo.</p>
        </div>';
        echo "<script>notificationShow('prodottoAggiunto',4000);</script>";
    }
    ?>
</body>

</html>