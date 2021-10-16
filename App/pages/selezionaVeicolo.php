<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/selezionaVeicoloInt.php'; ?>

<?php
if (isset($_SESSION["isVeicoloScelto"]) && $_SESSION["isVeicoloScelto"] == true) {
    header('location: selezionaProdotto.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Seleziona Veicolo - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>


    <?php echo stampaListaVeicoli(); ?>

    <?php include './common/footer.php'; ?>
</body>

</html>