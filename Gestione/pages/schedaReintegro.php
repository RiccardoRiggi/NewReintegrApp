<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php

include '../integration/schedaReintegroInt.php';

if (isset($_GET["id"])) {

    $scheda = ottieniDettaglioReintegro($_GET["id"]);
} else {
    header('location: listaReintegri.php');
}

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Scheda Reintegro - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">


                    <!-- CONTENUTO -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Scheda reintegro N. <?php echo $scheda["reintegrazione_id"]; ?></h6>
                            <small class=" form-text text-muted"><strong><?php echo $scheda["nome"] . " " . $scheda["cognome"]; ?></strong> ha reintegrato il veicolo <strong><?php echo $scheda["tipo"] . " " . $scheda["codice_mezzo"]; ?></strong> alle ore <?php echo $scheda["data_reintegro"]; ?></small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10  p-3">
                                    <?php echo stampaListaProdottiReintegrati($_GET["id"]); ?>
                                </div>
                                <div class="col-1">

                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>