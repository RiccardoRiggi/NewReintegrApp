<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/listaQrProdottiInt.php'; ?>
<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Lista Etichette - ReintegrApp</title>
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
        <h6 class="m-0 font-weight-bold text-danger">Lista etichette</h6>
        <div class="btn-example p-1 text-right">
                                <form method="POST" action="stampaQrProdottiDiGruppo.php" target="_blank">
                                    <input type="hidden" value="" name="listaIdPost" id="listaIdPost">
                                    <button id="bottoneStampaSelezionati" disabled type="submit" class="btn btn-danger">
                                        <i class="fas fa-check"></i> Stampa selezionati <span id="numeroSelezionati"> (0)</span>
                                    </button>

                                    <a href="stampaQrProdottiDiGruppo.php?all=true" target="_blank"><button type="button" class="btn btn-danger">
                                            <i class="fas fa-print"></i> Stampa tutti
                                        </button></a>

                                </form>
                            </div>
    </div>
    <div class="card-body">
    <div class="row ">
                        <div class="col-1"></div>
                        <div class="col-10  p-3">
                            <?php echo generaTabellaEtichetteProdotti(); ?>

                        </div>
                        <div class="col-1"></div>
                    </div>
    </div>
</div>
                    

                    <!-- CONTENUTO -->

                    <script>
                        function resettaCheck() {
                            var x = document.getElementsByClassName("checkSelezione");
                            for (c = 0; c < x.length; c++)
                                x[c].checked = false;
                        }


                        var selezionti = 0;
                        var listaIdQr = "";

                        function stampaSelezionati(checkbox, id) {
                            bottoneStampaSelezionati = document.getElementById("bottoneStampaSelezionati");
                            numeroSelezionati = document.getElementById("numeroSelezionati");
                            lista = document.getElementById("listaIdPost");

                            if (checkbox.checked) {
                                selezionti++;
                                listaIdQr = listaIdQr + id + ";";
                            } else {
                                selezionti--;
                                listaIdQr = listaIdQr.replace(id + ";", "");

                            }
                            //console.log(listaIdQr);
                            lista.value = listaIdQr;
                            if (selezionti == 0) {
                                bottoneStampaSelezionati.disabled = true;
                                numeroSelezionati.innerHTML = " (0)";
                            } else {
                                bottoneStampaSelezionati.disabled = false;
                                numeroSelezionati.innerHTML = " (" + selezionti + ")";
                            }
                            //console.log(lista.value);
                        }
                    </script>
                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>