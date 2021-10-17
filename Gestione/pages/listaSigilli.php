<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/listaSigilliInt.php'; ?>

<?php
if (!isset($_GET["id"]) || $_GET["id"] == null)
    header('location: listaSacche.php');
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Lista Sigilli - ReintegrApp</title>
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
                            <h6 class="m-0 font-weight-bold text-danger">Lista sigilli</h6>
                            <div class="btn-example text-right">

                                <a href="modificaSacca.php?id=<?php
                                                                if (isset($_GET["id"]))
                                                                    echo $_GET["id"]; ?>"><button type="button" class="btn btn-danger">
                                        <i class="fas fa-suitcase"></i> Torna alla sacca
                                    </button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <?php
                                    if (isset($_GET["id"]))
                                        echo stampaTabellaSigilli($_GET["id"]);
                                    else {
                                        header('location: listaSacche.php');
                                    }
                                    ?>
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