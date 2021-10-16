<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/listaSigilliInt.php'; ?>

<?php
if (!isset($_GET["id"]) || $_GET["id"]==null)
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
                    <div class="row ">
                        <div class="col-1"></div>
                        <div class="col-4 p-2 bg-white">
                            <h4 class="pl-3 testo-scuro">Lista Sigilli</h4>
                        </div>
                        <div class="col-6 p-2 text-right bg-white">
                            <div class="btn-example">

                                <a href="modificaSacca.php?id=<?php
                                                                if (isset($_GET["id"]))
                                                                    echo $_GET["id"]; ?>"><button type="button" class="btn btn-primary">
                                        <i class="fas fa-suitcase"></i> Torna alla sacca
                                    </button></a>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>

                    <!-- CONTENUTO -->

                    <div class="row pt-5">
                        <div class="col-1"></div>
                        <div class="col-10 bg-white">
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

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>