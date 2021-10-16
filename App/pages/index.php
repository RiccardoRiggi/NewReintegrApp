<?php include '../auth_components/controlloAutenticazione.php'; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Homepage - ReintegrApp</title>
</head>

<body class="altezza-piena lightgrey-bg-c1">
    <?php include './common/header.php'; ?>

    <div class="container pt-3">
        <div class="row shadow p-3 rounded bg-white m-1">
            <div class="col-2">
                <i class="fas fa-calendar-alt h1 testo-blu"></i>
            </div>
            <div class="col-10">
                <h5>Ultimo accesso alle ore <?php echo $_SESSION["data_ultimo_accesso"]; ?></h5>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <div class="row shadow p-3 rounded bg-white m-1">
            <div class="col-2">
                <i class="fas fa-ambulance h1 testo-blu"></i>
            </div>
            <div class="col-10">
                <h5>Hai reintegrato <?php echo $_SESSION["veicoli"]." "; echo  ($_SESSION["veicoli"]==1) ? "veicolo" : "veicoli"  ?></h5>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <div class="row shadow p-3 rounded bg-white m-1">
            <div class="col-2">
                <i class="fas fa-pump-medical h1 testo-blu"></i>
            </div>
            <div class="col-10">
                <h5>Hai rimesso al loro posto <?php echo $_SESSION["prodotti"]." "; echo  ($_SESSION["prodotti"]==1) ? "prodotto" : "prodotti"  ?></h5>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <div class="row shadow p-3 rounded bg-white m-1">
            <div class="col-2">
                <i class="fas fa-envelope-open-text h1 testo-blu"></i>
            </div>
            <div class="col-10">
                <h5>Hai inviato <?php echo $_SESSION["messaggi"]." "; echo  ($_SESSION["messaggi"]==1) ? "messaggio" : "messaggi"  ?> </h5>
            </div>
        </div>
    </div>




    <?php include './common/footer.php'; ?>
</body>

</html>