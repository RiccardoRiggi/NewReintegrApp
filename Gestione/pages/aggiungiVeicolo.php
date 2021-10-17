<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/aggiungiVeicoloInt.php'; ?>

<?php
$errore = "";
if (isset($_POST["nome"])) {
    $id = memorizzaVeicolo($_POST["nome"], $_POST["codice_mezzo"], $_POST["targa"], $_POST["tipo"]);
    if ($id != 0)
        header('location: modificaVeicolo.php?id=' . $id);
    else {
        $errore = '<script>document.addEventListener("load",document.getElementById("bottoneErroreGenerico").click())</script>';
    }
}

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Aggiungi Veicolo - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <form action="aggiungiVeicolo.php" novalidate method="post" onsubmit="return validaFormAggiungiVeicolo()" autocomplete="new-password">
                        <div class="container-fluid  pt-3">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Aggiungi veicolo</h6>
                                    <div class="btn-example text-right">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-save"></i> Salva
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- CONTENUTO -->
                                    <div class="row pt-3">
                                        <div class="col-1">

                                        </div>
                                        <div class="col-10 bg-white">
                                            <div class="row ">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group needs-validation">
                                                                <label for="nome">Nome del veicolo</label>
                                                                <input required type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il nome del veicolo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group needs-validation">
                                                                <label for="codice_mezzo">Codice di riconoscimento</label>
                                                                <input required type="text" class="form-control" id="codice_mezzo" name="codice_mezzo" placeholder="Inserisci il codice identificativo">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group needs-validation">
                                                                <label for="targa">Targa</label>
                                                                <input required type="text" class="form-control" id="targa" name="targa" placeholder="Inserisci la targa">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="bootstrap-select-wrapper ">
                                                                <label>Tipo</label>
                                                                <select class="form-control" name="tipo" id="tipo" class="needs-validation" title="Scegli una opzione" required>
                                                                    <option value="Ambulanza">Ambulanza</option>
                                                                    <option value="Automedica">Automedica</option>
                                                                    <option value="Vettura">Vettura</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- METTERE QUI CONTENUTO INPUT -->

                                        </div>
                                        <div class="col-1">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>

                    <script>
                        function validaFormAggiungiVeicolo() {
                            esito = true;
                            if (document.getElementById("nome").value == "") {
                                aggiungiNomeCampoNonValidato("nome del veicolo");
                                esito = false;
                            }
                            if (document.getElementById("codice_mezzo").value == "") {
                                aggiungiNomeCampoNonValidato("codice del veicolo");
                                esito = false;
                            }
                            if (document.getElementById("targa").value == "") {
                                aggiungiNomeCampoNonValidato("targa");
                                esito = false;
                            }
                            if (document.getElementById("tipo").value == "") {
                                aggiungiNomeCampoNonValidato("tipo");
                                esito = false;
                            }
                            console.log(esito);
                            if (!esito)
                                document.getElementById("bottoneErrataValidazioneForm").click();
                            return esito;
                        }
                    </script>





                    <script>
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                var forms = document.getElementsByClassName('needs-validation');
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                    }, false);
                                    form.classList.add('was-validated');
                                });
                            }, false);
                        })();
                    </script>
                    <!-- FINE CONTENUTO PAGINA -->
                    <?php include './common/footer.php'; ?>
                </div>
            </div>
        </div>
</body>
<?php echo $errore; ?>

</html>