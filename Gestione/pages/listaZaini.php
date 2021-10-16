<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/listaZainiInt.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">
    <head>
        <?php include './common/headscript.php'; ?>
        <title>Lista Zaini - ReintegrApp</title>
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
                                <h4 class="pl-3 font-weight-bold">Lista Zaini</h4>
                            </div>
                            <div class="col-6 p-2 text-right bg-white">
                                <div class="btn-example p-1">
                                    <a href="aggiungiZaino.php"><button type="button" class="btn btn-danger">
                                        <i class="fas fa-suitcase-rolling"></i> Aggiungi zaino
                                        </button></a>

                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                        
                        <!-- CONTENUTO -->
                        <div class="row pt-5">
                        <div class="col-1"></div>
                        <div class="col-10 bg-white p-3">
                            <?php echo getTabellaListaZaini(); ?>
                        </div>
                        <div class="col-1"></div>
                    </div>
                        
                    </div>

                    <script>
                    var zainoDaEliminare = 0;

                    function confermaEliminazione(nome, id) {
                        document.getElementById("saccaDel").innerHTML = nome;
                        zainoDaEliminare = id;
                    }

                    function eliminaSacca() {
                        var url = "../api/zaini.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("DELETE", url + '?c=d&id=' + zainoDaEliminare, true);
                        xhr.onload = function() {
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
                                <p>Vuoi confermare l'eliminazione dello zaino <span id="saccaDel"></span>? </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" onclick="eliminaSacca()">Conferma</button>
                                <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button">Annulla</button>
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