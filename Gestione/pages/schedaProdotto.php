<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/schedaProdottoInt.php'; ?>

<?php

if(isset($_POST["nome"],$_POST["prodotto_id"]) && $_POST["prodotto_id"] != ""){
    aggiornaProdotto($_POST["nome"],$_POST["descrizione"],$_POST["totale_magazzino"],$_POST["totale_disposizione_militi"],$_POST["prodotto_id"]);
}else if(isset($_POST["nome"])){
    //SALVA PRODOTTO
    memorizzaProdotto($_POST["nome"],$_POST["descrizione"],$_POST["totale_magazzino"],$_POST["totale_disposizione_militi"]);
}

if (isset($_GET["id"])){
    $isModifica = true;
    $prodotto=getProdotto($_GET["id"]);
}else {
    $isModifica = false;
    $prodotto="";
}
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title><?php echo stampaTitolo($isModifica) ?> - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>
                
                
                
                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                <form action="schedaProdotto.php";   novalidate method="post" onsubmit="return validaFormSchedaProdotto()" autocomplete="new-password">
                    <div class="container-fluid  pt-3">
                        <div class="row ">
                            <div class="col-1"></div>
                            <div class="col-4 p-2 bg-white">
                                <h4 class="pl-3 testo-scuro"><?php echo stampaTitolo($isModifica) ?></h4>
                            </div>
                            <div class="col-6 p-2 text-right bg-white">
                                <div class="btn-example">
                                    <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Salva
                                        </button>

                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>

                        <!-- CONTENUTO -->
                        <div class="row pt-3">
                            <div class="col-1">

                            </div>
                            <div class="col-10 bg-white">
                                <div class="row pt-5">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group needs-validation">
                                                    <input type="hidden" name="prodotto_id" value="<?php echo stampaDato($isModifica,$prodotto,"prodotto_id"); ?>">
                                                    <label for="nome">Nome del prodotto</label>
                                                    <input required type="text" class="form-control" id="nome" name="nome" value="<?php echo stampaDato($isModifica,$prodotto,"nome"); ?>" placeholder="Inserisci il nome del prodotto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="descrizione">Descrizione del prodotto</label>
                                                    <input type="text" class="form-control" id="descrizione" name="descrizione" value="<?php echo stampaDato($isModifica,$prodotto,"descrizione"); ?>" placeholder="Inserisci la descrizione del prodotto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group needs-validation">
                                                    <label for="totale_magazzino">Totale in magazzino</label>
                                                    <input required type="text" class="form-control" id="totale_magazzino" name="totale_magazzino" value="<?php echo stampaDato($isModifica,$prodotto,"totale_magazzino"); ?>" placeholder="Inserisci il numero totale presente a magazzino">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group needs-validation">
                                                    <label for="totale_disposizione_militi">Parte a disposizione dei militi</label>
                                                    <input required type="text" class="form-control" id="totale_disposizione_militi" name="totale_disposizione_militi" value="<?php echo stampaDato($isModifica,$prodotto,"totale_disposizione_militi"); ?>" placeholder="Inserisci il numero riservato ai militi">
                                                    <small id="label_totale_disposizione_militi" class="form-text text-muted">Deve essere uguale o minore del totale presente in magazzino</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <?php echo stampaDataUltimaModifica($isModifica,$prodotto); ?>
                                                
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
                </form>

                <script>
                    function validaFormSchedaProdotto() {
                        esito = true;
                        if(document.getElementById("nome").value==""){
                            aggiungiNomeCampoNonValidato("nome del prodotto");
                            esito = false;
                        }
                        if(document.getElementById("totale_magazzino").value=="" || parseInt(document.getElementById("totale_magazzino").value)<0){
                            aggiungiNomeCampoNonValidato("totale in magazzino");
                            esito = false;
                        }
                        if(document.getElementById("totale_disposizione_militi").value=="" || parseInt(document.getElementById("totale_disposizione_militi").value)>parseInt(document.getElementById("totale_magazzino").value) || parseInt(document.getElementById("totale_disposizione_militi").value)<0){
                            aggiungiNomeCampoNonValidato("parte a disposizione dei militi");
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

</html>