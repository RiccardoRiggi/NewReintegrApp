<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php

$_SESSION["isVeicoloScelto"] = false;
$_SESSION["reintegrazione_id"] = null;


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Grazie - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>

    <div class="container">

        <div class="row pt-5">

            <div class="col text-center">

                <i class="far fa-smile-wink h1 testo-blu"></i>

            </div>

        </div>

        <div class="row pt-5">

            <div class="col text-center">

                <p class="lead">Grazie per aver reintegrato il mezzo!</p>

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