<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/stampaBadgeAccessoInt.php'; ?>

<?php
if (isset($_GET["id"])) {
    $scheda = stampaSchedaBadgeAccessoSingola($_GET["id"]);
} else {
    header('location: listaUtenti.php');
}
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Stampa Badge Di Accesso - ReintegrApp</title>
</head>

<body>
    <?php echo $scheda;?>    
</body>
<script>
    window.addEventListener('load', function () {
        window.print();
})

</script>
</html>