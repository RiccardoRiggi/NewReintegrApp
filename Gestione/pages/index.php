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
                        <div class="col-6 ml-3 bg-white shadow alert">
                            <h4 class="pl-3 text-dark">Mezzi reintegrati negli ultimi 7 giorni</h4>
                            <canvas class=" mx-auto d-block" id="myChart" width="400" height="200"></canvas>
                        </div>
                        <div class="ml-5 col-5 bg-white shadow alert">
                            <h4 class="pl-3 text-dark">Classifica</h4>
                                <ul class="list-group">
                                    <?php echo stampaClassificaHomePage(); ?>
                                </ul>
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