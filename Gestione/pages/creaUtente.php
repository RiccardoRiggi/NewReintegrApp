<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php
include('../integration/creaUtenteInt.php');


if (isset($_POST["nome"])) {


    $id =  salvaUtenteInBaseDati($_POST["nome"], $_POST["cognome"], $_POST["sesso"], $_POST["data_di_nascita"], $_POST["numero_dae"], $_POST["isCertificato"], $_POST["comune_residenza"], $_POST["via"], $_POST["civico"], $_POST["interno"], $_POST["numero_tessera"], $_POST["email"], md5($_POST["password"]), $_SESSION["operatore"]);
    if ($id != 0) {
        header('location: modificaUtente.php?id=' . $id);
    }
}
?>


<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Aggiungi Utente - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <form novalidate method="post" onsubmit="return validateForm()">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Aggiungi utente</h6>
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
                                        <div class="row ">
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Digitare il nome" required>
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="cognome">Cognome</label>
                                                    <input type="text" name="cognome" class="form-control" id="cognome" placeholder="Digitare il cognome" required>
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Sesso</label>
                                                    <select class="form-control" id="sesso" name="sesso" title="Scegli una opzione" required>
                                                        <option value="uomo">Uomo</option>
                                                        <option value="donna">Donna</option>
                                                        <option value="N">Non specificato</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="it-datepicker-wrapper">
                                                    <div class="form-group">
                                                        <label for="data_di_nascita">Data di nascita</label>
                                                        <input class="form-control it-date-datepicker" id="data_di_nascita" name="data_di_nascita" type="text" placeholder="gg/mm/aaaa">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="numero_dae">N. DAE</label>
                                                    <input type="text" class="form-control" id="numero_dae" name="numero_dae" placeholder="nnnn/aaaa">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Certificato 118</label>
                                                    <select class="form-control" id="isCertificato" required name="isCertificato" title="Scegli una opzione">
                                                        <option value="Si">Si</option>
                                                        <option selected value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Comune di residenza</label>
                                                    <input type="text" class="form-control" name="comune_residenza" placeholder="Digitare il comune di residenza">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="via">Indirizzo</label>
                                                    <input type="text" class="form-control" id="via" name="via" placeholder="Digitare l'indirizzo">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="via">Civico</label>
                                                            <input type="text" class="form-control" id="civico" name="civico" placeholder="Digitare il civico">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="via">Interno</label>
                                                            <input type="text" class="form-control" id="interno" name="interno" placeholder="Digitare l'interno">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-4">
                                                <div class="form-group needs-validation">
                                                    <label for="cognome">N. Tessera</label>
                                                    <input required type="text" class="form-control" id="numero_tessera" name="numero_tessera" placeholder="Digitare il numero tessera">
                                                    <div class="invalid-feedback">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <input style="border-color:#d9364f;" onkeyup="controllaEmail(this)" type="email" required class="form-control" id="email" name="email" placeholder="esempio@reintegra.org">
                                                    <div class="pl-1 text-danger-rosso" id="divMail">Campo obbligatorio!</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="note">Password</label>
                                                    <input type="password" class="needs-validation form-control input-password input-password-strength-meter" id="password" name="password" data-enter-pass="Digitare almeno 6 caratteri" placeholder="Digitare la password">
                                                </div>
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
                        $(document).ready(function() {
                            $('.it-date-datepicker').datepicker({
                                inputFormat: ["dd/MM/yyyy"],
                                outputFormat: 'dd/MM/yyyy',
                            });
                        });
                    </script>
                    <script>

                    </script>

                    <!-- CONTENUTO -->


                    <!-- FINE CONTENUTO -->
                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>