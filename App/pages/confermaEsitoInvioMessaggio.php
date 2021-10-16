<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../business/messaggiBusiness.php';?>

<?php
if (isset($_POST["contenuto"])) {
    inviaMessaggio($_POST["contenuto"]);
    $_SESSION["messaggi"]++;
}


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Messaggio Inviato - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>

    <div class="container">

        <div class="row pt-5">

            <div class="col text-center">

                <i class="fas fa-mail-bulk h1 text-danger"></i>

            </div>

        </div>

        <div class="row pt-5">

            <div class="col text-center">

                <p class="lead">Grazie per aver mandato il messaggio!</p>

            </div>

        </div>

        <div class="row pt-5">

            <div class="col text-center">

                <p class="lead">Verrai reinderizzato alla homepage tra pochi secondi</p>

            </div>

        </div>

    </div>



    <script>
        var x = setTimeout(function() {
            window.location.replace("index.php");
        }, 4000);
    </script>




    <?php include './common/footer.php'; ?>
</body>

</html>