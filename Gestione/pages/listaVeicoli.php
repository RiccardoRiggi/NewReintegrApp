<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/listaVeicoliInt.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Lista Veicoli - ReintegrApp</title>
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
                            <h6 class="m-0 font-weight-bold text-danger">Lista veicoli</h6>
                            <div class="btn-example text-right">
                                <a href="aggiungiVeicolo.php"><button type="button" class="btn btn-danger">
                                        <i class="fas fa-ambulance"></i> Aggiungi veicolo
                                    </button></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- CONTENUTO -->

                            <div class="row ">
                                <div class="col-1"></div>
                                <div class="col-10 p-3">
                                    <?php echo getTabellaListaVeicoli(); ?>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>


                </div>

                <script>
                    var veicoloDaEliminare = 0;

                    function confermaEliminazione(nome, id) {
                        document.getElementById("saccaDel").innerHTML = nome;
                        veicoloDaEliminare = id;
                    }

                    function eliminaSacca() {
                        var url = "../api/veicoli.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("DELETE", url + '?c=d&id=' + veicoloDaEliminare, true);
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
                                <p>Vuoi confermare l'eliminazione del veicolo <span id="saccaDel"></span>? </p>
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