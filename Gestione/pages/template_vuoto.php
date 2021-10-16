<?php include '../auth_components/controlloAutenticazione.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">
    <head>
        <?php include './common/headscript.php'; ?>
        <title></title>
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
                                <h4 class="pl-3 testo-scuro">Titolo Pagina</h4>
                            </div>
                            <div class="col-6 p-2 text-right bg-white">
                                <div class="btn-example">
                                    <a href="stampaBadgeAccesso.php">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-id-badge"></i> FUNZ 1
                                        </button></a>

                                    <a href="creaUtente.php"><button type="button" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> FUNZ 2
                                        </button></a>

                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                        
                        <!-- CONTENUTO -->
                        
                        
                    </div>
                    
                    <!-- FINE CONTENUTO PAGINA -->
                    <?php include './common/footer.php'; ?>
                </div>
            </div>
        </div>   
    </body>
</html>