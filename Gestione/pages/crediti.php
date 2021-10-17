<?php include '../auth_components/controlloAutenticazione.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Informazioni - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Crediti</h6>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <p class="pl-3">ReintegrApp è una Web Application gestionale sviluppata senza fini di lucro da <a class="text-decoration-none font-weight-bold" href="https://www.riccardoriggi.it/" target="_blank">Riccardo Riggi</a> per organizzazioni di volontariato che operano nel campo dell'emergenza/urgenza </p>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="https://www.facebook.com/riccardo.riggi.52" target="_blank">
                                                <i class="fab text-danger h1 fa-facebook-square"></i>
                                            </a>
                                        </div>
                                        <div class="col text-center">
                                            <a href="https://www.instagram.com/_riccardoriggi_/" target="_blank">
                                                <i class="fab text-danger h1 fa-instagram-square"></i>
                                            </a>
                                        </div>
                                        <div class="col text-center">
                                            <a href="https://www.linkedin.com/in/riccardoriggi/" target="_blank">
                                                <i class="fab text-danger h1 fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid ">
                    <!-- CONTENUTO CREDITI-->




                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Garanzia limitata ed esclusioni di responsabilità</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10 ">
                                    <p class="pl-3">Il software viene fornito "così com'è", senza garanzie. Riccardo Riggi non concede alcuna garanzia per il software e la relativa documentazione in termini di correttezza, accuratezza, affidabilità o altro. L'utente si assume totalmente il rischio utilizzando questo applicativo. </p>
                                </div>
                                <div class="col-1"></div>
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