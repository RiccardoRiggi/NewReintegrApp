<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php

include '../integration/listaUtentiInt.php';

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">
    <head>
        <?php include './common/headscript.php'; ?>
        <title>Lista Utenti - ReintegrApp</title>
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
                                <h4 class="pl-3 font-weight-bold">Lista Utenti</h4>
                            </div>
                            <div class="col-6 p-2 text-right bg-white">
                                <div class="btn-example p-1">
                                    <a href="listaBadgeAccesso.php">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-id-badge"></i> Stampa Badge Accesso Multipli
                                        </button></a>

                                    <a href="creaUtente.php"><button type="button" class="btn btn-danger">
                                        <i class="fas fa-user-plus"></i> Nuovo Utente
                                        </button></a>

                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>                        
                        <div class="row p-3">
                            <div class="col"></div>
                        </div>


                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-10 bg-white p-3">
                                <?php echo generaListaUtenti(); ?>
                            </div>
                            <div class="col-1">

                            </div>
                        </div>


                        <!-- FINE CONTENUTO PAGINA -->
                        <?php include './common/footer.php'; ?>
                    </div>
                </div>
            </div> 
        </div>
        <script>

            var utenteDaEliminare=0;
            
            function confermaEliminazione(nome,id){
                document.getElementById("utenteDel").innerHTML=nome;
                utenteDaEliminare=id;
            }

            function eliminaUtente(){
                var url = "../api/utenti.php";
                var xhr = new XMLHttpRequest();
                console.warn(url+'?c=d&id='+utenteDaEliminare);
                xhr.open("DELETE", url+'?c=d&id='+utenteDaEliminare, true);
                xhr.onload = function () {
                    if (xhr.readyState == 4 && xhr.status == "200") {
                        location.reload();
                        console.log("OK");
                    } else {
                        setTimeout(() => {
                            document.getElementById("bottoneErroreGenerico").click();  
                        }, 500);
                        
                        console.log("ERRORE");
                    }
                }
                xhr.send(null);
            }
            
        </script>
        <div class="modal fade" tabindex="-1" role="dialog" id="confermaEliminazione">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Attenzione!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>Vuoi confermare l'eliminazione dell'utente <span id="utenteDel"></span>? </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" onclick="eliminaUtente()">Conferma</button>
                         <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button">Annulla</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>