<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/listaStrategicaInt.php'; ?>

<?php
$tabella = "";
$titolo = "";
if (isset($_GET["t"])) {
    if ($_GET["t"] == "esauriti") {
        $tabella = generaTabellaEsauriti();
        $titolo = "Lista prodotti esauriti";
    } else if ($_GET["t"] == "reintegrare") {
        $tabella = generaTabellaDaReintegrare();
        $titolo = "Lista prodotti da reintegrare";
    } else if ($_GET["t"] == "scaduti") {
        $tabella = generaTabellaScaduti();
        $titolo = "Lista prodotti scaduti";
    }else if ($_GET["t"] == "scadenza") {
        $tabella = generaTabellaScadenza();
        $titolo = "Lista prodotti in scadenza";
    }
} else {
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title><?php echo $titolo; ?> - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>
                
                
                
                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <div class="row ">
                        <div class="col-1"></div>
                        <div class="col-4 p-2 bg-white">
                            <h4 class="pl-3 font-weight-bold"><?php echo $titolo; ?></h4>
                        </div>
                        <div class="col-6 p-2 text-right bg-white">

                            <div class="col-1"></div>
                        </div>
                    </div>

                    <!-- CONTENUTO -->

                    <div class="row pt-5">

                        <div class="col-1"></div>
                        <div class="col-10 bg-white p-3"><?php echo $tabella; ?></div>
                        <div class="col-1"></div>

                    </div>
                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>