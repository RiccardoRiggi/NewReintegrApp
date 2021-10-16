<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/stampaQrProdottiDiGruppoInt.php'; ?>

<?php
if (isset($_GET["all"])) {
    $scheda = stampaTutteEtichette();
} else if(isset($_POST["listaIdPost"])){
    //header('location: listaUtenti.php');
    $scheda=stampaDeterminatiBadge($_POST["listaIdPost"]);
}else if(isset($_GET["id"])){
    $scheda=stampaEtichettaSingola($_GET["id"]);
}else{
    exit('<script>window.history.back();</script>');
}
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Stampa Etichette - ReintegrApp</title>
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