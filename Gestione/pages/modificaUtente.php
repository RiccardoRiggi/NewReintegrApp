<?php include '../auth_components/controlloAutenticazione.php'; ?>


<?php
include('../integration/modificaUtenteInt.php');

if (!isset($_GET["id"]) || $_GET["id"] == "")
    header('location: listaUtenti.php');

if (isset($_POST["nome"]))
    aggiornaUtenteInBaseDati($_POST["nome"], $_POST["cognome"], $_POST["sesso"], $_POST["data_di_nascita"], $_POST["numero_dae"], $_POST["isCertificato"], $_POST["comune_residenza"], $_POST["via"], $_POST["civico"], $_POST["interno"], $_POST["numero_tessera"], $_POST["email"], $_POST["password"], $_POST["id"]);

$utente = cercaUtente($_GET["id"]);

?>


<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Modifica <?php echo $utente["nome"] . " " . $utente["cognome"] ?> - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <form novalidate method="post" onsubmit="return validateForm()" autocomplete="new-password">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Modifica utente</h6>
                                <div class="btn-example text-right">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-save"></i> Salva
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-1">

                                    </div>
                                    <div class="col-10 bg-white" onclick="resetPw();">
                                        <div class="row pt-5">
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="nome">Nome</label>
                                                    <input type="hidden" value="<?php echo $utente["a"]; ?>" name="id">
                                                    <input type="text" name="nome" value="<?php echo $utente["nome"]; ?>" class="form-control" id="nome" placeholder="Digitare il nome" required>
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="cognome">Cognome</label>
                                                    <input type="text" name="cognome" class="form-control" id="cognome" value="<?php echo $utente["cognome"]; ?>" placeholder="Digitare il cognome" required>
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Sesso</label>
                                                    <select class="form-control" id="sesso" name="sesso" title="Scegli una opzione" required>
                                                        <option <?php echo selezionato($utente["sesso"], "uomo"); ?> value="uomo">Uomo</option>
                                                        <option <?php echo selezionato($utente["sesso"], "donna"); ?> value="donna">Donna</option>
                                                        <option <?php echo selezionato($utente["sesso"], "N"); ?> value="N">Non specificato</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="it-datepicker-wrapper">
                                                    <div class="form-group">
                                                        <label for="data_di_nascita">Data di nascita</label>
                                                        <input value="<?php echo $utente["data_di_nascita"]; ?>" class="form-control" id="data_di_nascita" name="data_di_nascita" type="text" placeholder="gg/mm/aaaa">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="numero_dae">N. DAE</label>
                                                    <input type="text" class="form-control" id="numero_dae" value="<?php echo $utente["numero_dae"]; ?>" name="numero_dae" placeholder="nnnn/aaaa">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Certificato 118</label>
                                                    <select class="form-control" id="isCertificato" required name="isCertificato" title="Scegli una opzione">
                                                        <option <?php echo selezionato($utente["isCertificato"], true); ?> value="Si">Si</option>
                                                        <option <?php echo selezionato($utente["isCertificato"], false); ?> value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Comune di residenza</label>
                                                    <input type="text" value="<?php echo $utente["comune_residenza"]; ?>" class="form-control" name="comune_residenza" placeholder="Digitare il compune di residenza" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="via">Indirizzo</label>
                                                    <input type="text" class="form-control" id="via" name="via" value="<?php echo $utente["via"]; ?>" placeholder="Digitare l'indirizzo">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="civico">Civico</label>
                                                            <input type="text" class="form-control" id="civico" name="civico" value="<?php echo $utente["civico"]; ?>" placeholder="Digitare il civico">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="interno">Interno</label>
                                                            <input type="text" class="form-control" id="interno" name="interno" value="<?php echo $utente["interno"]; ?>" placeholder="Digitare l'interno">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="cognome">N. Tessera</label>
                                                    <input required type="text" class="form-control" id="numero_tessera" value="<?php echo $utente["numero_tessera"]; ?>" name="numero_tessera" placeholder="Digitare il numero tessera">
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <input onkeyup="controllaEmail(this)" type="email" required class="form-control" id="email" value="<?php echo $utente["email"]; ?>" name="email" placeholder="esempio@reintegra.org">
                                                    <div class="pl-1 text-danger-rosso" id="divMail"></div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="note">Password</label>
                                                    <input type="password" class="form-control input-password input-password-strength-meter" id="password" name="password" data-enter-pass="Digitare almeno 6 caratteri" placeholder="Digitare la password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 ">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Informazioni di accesso</h6>
                                <div class="btn-example align-middle text-right">
                                    <?php echo generaPulsanteToken($utente["isQrBloccato"]); ?>

                                    <button data-toggle="modal" data-target="#confermaRigenerazione" type="button" class="btn btn-danger">
                                        <i class="fas fa-sync"></i> Rigenera Badge
                                    </button>
                                    <a target="_blank" href="stampaBadgeAccessoSingolo.php?id=<?php echo $_GET["id"] ?>"><button type="button" class="btn btn-danger">
                                            <i class="fas fa-print"></i> Stampa Badge
                                        </button></a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-1">

                                    </div>
                                    <div class="col-10 bg-white align-middle">
                                        <div class="row">
                                            <div class="col-8">
                                                <div id="avvisoTokenBloccato"><?php echo generaAvvisoTokenBloccato($utente["isQrBloccato"], $utente["data_qr_bloccato"]); ?></div>
                                                <div class="row pt-5">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input value="<?php echo stampaDataUltimoAccesso($utente["data_primo_accesso"]); ?>" type="text" class="form-control" disabled>
                                                            <label>Data del primo accesso </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" value="<?php echo stampaDataUltimoAccesso($utente["data_ultimo_accesso"]); ?>" class="form-control" readonly>
                                                            <label>Data dell'ultimo accesso</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input id="dataAssegnazioneToken" type="text" value="<?php echo $utente["data_assegnazione_token"]; ?>" class="form-control" disabled>
                                                            <label>Data assegnazione badge </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input value="<?php echo $utente["operatore_assegnazione_token"]; ?>" type="text" class="form-control" id="operatoreAssegnazioneToken" readonly>
                                                            <label>Badge assegnato da</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <figure class="figure">
                                                    <img id="tokenDiAccesso" src="https://chart.apis.google.com/chart?cht=qr&chs=350x350&chl=<?php echo $utente["codice_qr"] ?>">
                                                    <figcaption class="figure-caption text-center">Badge di accesso</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">

                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>

                    <script>
                        isResetted = false;

                        function resetPw() {
                            if (!isResetted) {
                                isResetted = true;
                                document.getElementById("password").value = "";
                            }
                        }


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
                    <script>
                        var urlBase = 'https://chart.apis.google.com/chart?cht=qr&chs=350x350&chl=';
                        var operatore = '<?php echo $_SESSION["operatore"]; ?>';

                        function rigeneraQrCode() {
                            var url = "../api/utenti.php";
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url + '?c=r&id= + <?php echo $_GET["id"];  ?>', true);
                            xhr.onload = function() {
                                if (xhr.readyState == 4 && xhr.status == "200") {
                                    setTimeout(() => {
                                        document.getElementById("tokenDiAccesso").src = urlBase + xhr.responseText;
                                        document.getElementById("operatoreAssegnazioneToken").value = operatore;
                                        document.getElementById("dataAssegnazioneToken").value = "Appena asseggnato";
                                        document.getElementById("pulsanteBloccoSblocco").setAttribute("onclick", "devoBloccare(true)");
                                        generaAvvisoTokenBloccato();
                                        document.getElementById("bottoneBadgeRigeneratoDalServizio").click();
                                    }, 1000);
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

                        function devoBloccare(devoBloccare) {
                            if (devoBloccare) {
                                var url = "../api/utenti.php?c=b";
                            } else {
                                var url = "../api/utenti.php?c=s";
                            }
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url + '&id= + <?php echo $_GET["id"];  ?>', true);
                            xhr.onload = function() {
                                if (xhr.readyState == 4 && xhr.status == "200") {
                                    setTimeout(() => {
                                        if (devoBloccare) {
                                            document.getElementById("pulsanteBloccoSblocco").setAttribute("onclick", "devoBloccare(false)");
                                            document.getElementById("bottoneBadgeBloccatoDalServizio").click();
                                        } else {
                                            document.getElementById("pulsanteBloccoSblocco").setAttribute("onclick", "devoBloccare(true)");
                                            document.getElementById("bottoneBadgeSbloccatoDalServizio").click();
                                        }
                                        generaAvvisoTokenBloccato();
                                    }, 1000);
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

                        function generaAvvisoTokenBloccato() {
                            var url = "../api/utenti.php";
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url + '?c=t&id= + <?php echo $_GET["id"];  ?>', true);
                            xhr.onload = function() {
                                if (xhr.readyState == 4 && xhr.status == "200") {
                                    document.getElementById("avvisoTokenBloccato").innerHTML = xhr.responseText;
                                    if (xhr.responseText == "") {
                                        //DEVO CAMBIARE IN BLOCCA
                                        document.getElementById("pulsanteBloccoSblocco").innerHTML = '<i class="fas fa-lock"></i> Blocca Badge';
                                    } else {
                                        //DEVO CAMBIARE IN SBLOCCA 
                                        document.getElementById("pulsanteBloccoSblocco").innerHTML = '<i class="fas fa-unlock"></i> Sblocca Badge';
                                    }
                                } else {


                                    console.log("ERRORE");
                                }
                            }
                            xhr.send(null);
                        }
                    </script>

                    <!-- CONTENUTO -->

                    <div class="modal fade" tabindex="-2" role="dialog" id="confermaRigenerazione">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Attenzione!
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <i class="fas fa-id-badge text-danger h1"></i>
                                        <p> il badge di accesso comporta la disabilitazione dei badge cartacei stampati precedentemente per <?php echo $utente["nome"] . " " . $utente["cognome"];  ?>.<br>Sei sicuro di voler proseguire? </p>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button">Annulla</button>
                                    <button class="btn btn-danger btn-sm" onclick="rigeneraQrCode();" data-dismiss="modal" type="button">Rigenera badge</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FINE CONTENUTO -->
                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>