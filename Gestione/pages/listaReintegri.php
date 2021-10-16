<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include'../integration/listaReintegriInt.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">
    <head>
        <?php include './common/headscript.php'; ?>
        <title>Lista Reintegri - ReintegrApp</title>
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
                            <div class="col-10 p-2 bg-white">
                                <h4 class="pl-3 testo-scuro">Lista Reintegri</h4>
                            </div>
                            <div class="col-1"></div> 
                        </div>
                        
                        <!-- CONTENUTO -->


                        <div class="row pt-5">
                            <div class="col-1"></div>
                            <div class="col-10 bg-white">
                                <?php echo stampaListaReintegri(); ?>
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