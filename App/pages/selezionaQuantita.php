<?php include '../auth_components/controlloAutenticazione.php'; ?>

<?php include '../business/gestioneReintegrazioneBusiness.php'; ?>

<?php
if(isset($_POST["valorePreso"],$_POST["idProdotto"])){
    aggiornaQuantitaInMagazzino($_POST["valorePreso"],$_POST["idProdotto"]);
    registraPrelevamento($_SESSION["reintegrazione_id"],$_POST["valorePreso"],$_POST["idProdotto"]);
    $_SESSION["prodotti"]=$_SESSION["prodotti"]+$_POST["valorePreso"];
    header('location: selezionaProdotto.php?error=200');
}else if (!isset($_GET["id"])) {
    header('location: selezionaProdotto.php');
}else{
    $prodotto = recuperaProdotto($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Seleziona Quantità - ReintegrApp</title>
</head>

<body class="altezza-piena">
    <?php include './common/header.php'; ?>
    <form action="selezionaQuantita.php" method="POST">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <p class="h1 text-center"><?php echo $prodotto["nome"]; ?></p>
                <p class="lead text-center"><?php echo $prodotto["descrizione"]; ?></p>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col text-right" onclick="decrementaValore();">
                <p id="segnettoMeno" class="h1 text-danger">-</p>
            </div>
            <div class="col text-center align-baseline">
                <input type="hidden" id="valorePreso" name="valorePreso" value="1">
                <input type="hidden" id="idProdotto" name="idProdotto" value="<?php echo $prodotto["prodotto_id"]; ?>">
                <p class="h1 "><span id="attuale">
                <?php
                    if($prodotto["totale_disposizione_militi"]==0){
                        echo "0";
                    }else{
                        echo "1";
                    }
                ?></span>/<span id="massimo"><?php echo $prodotto["totale_disposizione_militi"]; ?></span></p>
            </div>
            <div class="col text-left" onclick="incrementaValore();">
                <p id="segnettoPiu" class="h1 text-danger">+</p>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col text-center">
                <small id="testoSegnalazione">La quantità massima non corrisponde? <strong><span class="text-danger" style="user-select: none;" onclick="inviaSegnalazione();">Clicca qui!</span></strong></small>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col text-center">
            <button <?php
                    if($prodotto["totale_disposizione_militi"]==0){
                        echo "disabled";
                    }else{
                        echo "";
                    }
                ?> type="submit" class="btn btn-primary btn-lg ">Conferma</button>
            </div>
        </div>
    </div>
    </form>


    <script>
        var valoreMassimo = <?php echo $prodotto["totale_disposizione_militi"]; ?>;

        function incrementaValore() {
            valoreAttuale = parseInt(document.getElementById("attuale").innerHTML);
            if (valoreAttuale < valoreMassimo) {
                document.getElementById("attuale").innerHTML = valoreAttuale + 1;
                document.getElementById("valorePreso").value = valoreAttuale + 1;
                segnettoMeno = document.getElementById("segnettoMeno");
                segnettoMeno.classList.remove("text-secondary");
                segnettoMeno.classList.add("text-danger");
                if (valoreMassimo - valoreAttuale == 1) {
                    segnettoPiu = document.getElementById("segnettoPiu");
                    segnettoPiu.classList.remove("text-danger");
                    segnettoPiu.classList.add("text-secondary");
                }
            }

        }

        function decrementaValore() {
            valoreAttuale = parseInt(document.getElementById("attuale").innerHTML);
            if (valoreAttuale > 0) {
                document.getElementById("attuale").innerHTML = valoreAttuale - 1;
                document.getElementById("valorePreso").value = valoreAttuale - 1;
                segnettoPiu = document.getElementById("segnettoPiu");
                segnettoPiu.classList.remove("text-secondary");
                segnettoPiu.classList.add("text-danger");
                if (valoreAttuale == 1) {
                    segnettoMeno = document.getElementById("segnettoMeno");
                    segnettoMeno.classList.remove("text-danger");
                    segnettoMeno.classList.add("text-secondary");
                }
            }

        }

        function inviaSegnalazione() {
                        var url = "../api/prodotti.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", url + '?c=tnc&id=<?php echo $prodotto["prodotto_id"]; ?>', true);
                        xhr.onload = function() {
                            if (xhr.readyState == 4 && xhr.status == "200") {
                                document.getElementById("testoSegnalazione").style.display="none";
                                notificationShow('notificaInviata',4000);
                            } else {
                                setTimeout(() => {
                                    document.getElementById("bottoneErroreGenerico").click();
                                }, 500);

                                console.log("ERRORE");
                            }
                        }
                        xhr.send(null);
                    }
    </script>




    <?php include './common/footer.php'; ?>

    <div class="notification bottom-fix with-icon info" role="alert" aria-labelledby="not1e-title" id="notificaInviata">
            <h5 id="not1e-title"><i class="fas fa-check text-danger"></i> <span class="text-secondary ">Notifica inviata!<span></h5>
        </div>

        <?php
                    if($prodotto["totale_disposizione_militi"]==0){
                        echo '<div class="notification bottom-fix with-icon error" role="alert" aria-labelledby="not1e-title" id="prodottoTerminato">
            <h5 id="not1e-title"><i class="fas fa-exclamation-triangle text-danger-rosso-solo"></i> <span>Attenzione!<span></h5>
            <p>Il prodotto risulta essere momentaneamente esaurito. Un responsabile rifornirà il magazzino il prima possibile.</p>
        </div>';
        echo "<script>notificationShow('prodottoTerminato',6000);</script>";
                    }
                ?>    
</body>

</html>