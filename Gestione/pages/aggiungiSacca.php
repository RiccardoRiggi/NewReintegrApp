<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/aggiungiSaccaInt.php'; ?>

<?php
$errore = "";
if (isset($_POST["nome"])) {
    $id = salvaSacca($_POST["nome"], $_POST["colore"],$_POST["padre"]);
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
    <title>Aggiungi Sacca - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>
                
                
                
                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                <form action="aggiungiSacca.php" class="needs-validation"  novalidate method="post" onsubmit="return validaFormAggiungiSacca()" autocomplete="new-password">

                <div class="container-fluid  pt-3">
                    
                    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Aggiungi sacca</h6>
        <div class="btn-example text-right">
                                <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-save"></i> Salva
                                    </button>

                            </div>
    </div>
    <div class="card-body">
    <div class="row pt-3">
                        <div class="col-1">

                        </div>
                        <div class="col-10 bg-white">
                            <div class="row ">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group needs-validation">
                                                <label for="nome">Nome della sacca</label>
                                                <input required type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il nome della sacca">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="bootstrap-select-wrapper">
                                                <label>Colore della sacca</label>
                                                <select class="form-control" title="Scegli una opzione" id="colore" name="colore">
                                                    <option value="Rossa">Rossa</option>
                                                    <option value="Gialla">Gialla</option>
                                                    <option value="Verde">Verde</option>
                                                    <option value="Blu">Blu</option>
                                                    <option value="Nera">Nera</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="bootstrap-select-wrapper">
                                                <label>Posizione della sacca</label>
                                                <select class="form-control" name="padre" id="padre" title="Scegli una opzione">
                                                    <?php echo generaComboPosizioneSacca(); ?>
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
                    <!-- CONTENUTO -->
                    
                    <script>
                    function validaFormAggiungiSacca() {
                        esito = true;
                        if (document.getElementById("nome").value == "") {
                            aggiungiNomeCampoNonValidato("nome della sacca");
                            esito = false;
                        }
                        if (document.getElementById("colore").value == "" ) {
                            aggiungiNomeCampoNonValidato("colore della sacca");
                            esito = false;
                        }
                        if (document.getElementById("padre").value == "" ) {
                            aggiungiNomeCampoNonValidato("posizione della sacca");
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
                </div>
                </form>
                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>