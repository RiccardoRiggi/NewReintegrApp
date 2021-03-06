<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/homePageInt.php'; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>ReintegrApp - Home Page</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <div class="row">
                        <?php echo stampaSchedaProdottiScaduti(); ?>
                        <?php echo stampaSchedaProdottiInScadenza(); ?>
                        <?php echo stampaSchedaProdottiDaReintegrate(); ?>
                        <?php echo stampaSchedaProdottiEsauriti(); ?>
                    </div>


                    <div class="row">
                        <div class="col-6 ">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Mezzi reintegrati negli ultimi 7 giorni</h6>
                                </div>
                                <div class="card-body">
                                    <canvas class=" mx-auto d-block" id="myChart" width="400" height="200"></canvas>
                                    <small class="text-muted text-center">Il grafico verrà generato dopo aver raccolto almeno 7 giorni di dati</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Classifica</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php echo stampaClassificaHomePage(); ?>
                                    </ul>
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


    <script>
        <?php echo stampaGrafico(); ?>
    </script>
</body>

</html>