<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/aggiungiZainoInt.php'; ?>

<?php
$errore = "";
if (isset($_POST["nome"])) {
    $id = salvaZaino($_POST["nome"], $_POST["mezzo_id"]);
    if ($id != 0);
    //header('location: modificaVeicolo.php?id=' . $id);
    else {
        $errore = '<script>document.addEventListener("load",document.getElementById("bottoneErroreGenerico").click())</script>';
    }
}

?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Aggiungi Zaino - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <form action="aggiungiZaino.php" novalidate method="post" onsubmit="return validaFormAggiungiZaino()" autocomplete="new-password">
                        <div class="container-fluid  pt-3">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Aggiungi zaino</h6>
                                    <div class="btn-example text-right">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-save"></i> Salva
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- CONTENUTO -->
                                    <div class="row">
                                        <div class="col-1">

                                        </div>
                                        <div class="col-10 bg-white">
                                            <div class="row ">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="form-group needs-validation">
                                                                <label for="nome">Nome dello zaino</label>
                                                                <input required type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il nome dello zaino">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="bootstrap-select-wrapper">
                                                                <label>Posizione Zaino</label>
                                                                <select class="form-control" name="mezzo_id" id="mezzo_id" title="Scegli una opzione">
                                                                    <?php echo generaComboPosizioneZaino(); ?>
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
                        function validaFormAggiungiZaino() {
                            esito = true;
                            if (document.getElementById("nome").value == "") {
                                aggiungiNomeCampoNonValidato("nome dello zaino");
                                esito = false;
                            }
                            if (document.getElementById("mezzo_id").value == "") {
                                aggiungiNomeCampoNonValidato("posizione dello zaino");
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