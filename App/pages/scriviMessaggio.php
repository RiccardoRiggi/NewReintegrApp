<?php include '../auth_components/controlloAutenticazione.php'; ?>



<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Nuovo Messaggio - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>
    <form method="POST" action="confermaEsitoInvioMessaggio.php">
        <div class="container">

            <div class="row pt-5">


                <div class="col text-center">
                    <p class="lead text-justify">Utilizza questa sezione per lasciare un avviso oppure una comunicazione personalizzata ai responsabili dell'associazione.</p>
                    <div class="pt-3">
                        <div class="form-group">
                            <textarea id="contenuto" name="contenuto" rows="6"></textarea>
                            <label for="contenuto">Testo del messaggio</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Invia Messaggio <i class="fas fa-angle-right"></i></button>
                </div>


            </div>

        </div>

    </form>
    <?php include './common/footer.php'; ?>
</body>

</html>