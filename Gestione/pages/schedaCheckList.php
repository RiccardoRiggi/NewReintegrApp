<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/schedaCheckListInt.php'; ?>

<?php
if (isset($_GET["id"])) {
    $scheda = stampaMezzo($_GET["id"]);
} else {
    header('location: listaCheckList.php');
}
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Stampa Check List - ReintegrApp</title>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col">
                <?php echo $scheda; ?>

                
            </div>
        </div>
    </div>

</body>
<script>
    window.addEventListener('load', function() {
        window.print();
    })
</script>

</html>