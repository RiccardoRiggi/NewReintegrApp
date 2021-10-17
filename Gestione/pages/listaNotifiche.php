<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/listaNotificheInt.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Lista Notifiche - ReintegrApp</title>
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
                            <h6 class="m-0 font-weight-bold text-danger">Lista notifiche</h6>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <?php echo stampaTabellaNotifiche(); ?>
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