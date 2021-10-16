<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../integration/stampaBadgeAccessoInt.php'; ?>

<?php
if (isset($_GET["all"])) {
    $scheda = stampaTuttiBadge();
} else if(isset($_POST["listaIdPost"])){
    //header('location: listaUtenti.php');
    $scheda=stampaDeterminatiBadge($_POST["listaIdPost"]);
}else{
    exit('<script>window.history.back();</script>');
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