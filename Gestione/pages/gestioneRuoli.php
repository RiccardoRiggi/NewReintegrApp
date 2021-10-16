<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/gestioneRuoliInt.php'; ?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Gestione Ruoli - ReintegrApp</title>
</head>

<body>
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>
                
                
                
                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <div class="row ">
                        <div class="col-1"></div>
                        <div class="col-4 p-2 bg-white">
                            <h4 class="pl-3 font-weight-bold">Gestione Ruoli</h4>
                        </div>
                        <div class="col-6 p-2 text-right bg-white">
                            <div class="btn-example p-1">
                                <a href="listaBadgeAccesso.php">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fas fa-id-badge"></i> Badge Accesso
                                    </button></a>

                                <a href="listaUtenti.php"><button type="button" class="btn btn-danger">
                                        <i class="fas fa-users"></i> Lista Utenti
                                    </button></a>

                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>

                    <!-- CONTENUTO -->

                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-10 bg-white">
                            <?php echo generaTabella(); ?>
                        </div>
                        <div class="col-1">

                        </div>
                    </div>



                </div>

                <script>
                    function aggiornaModifica(idUtente, idRuolo) {
                        abilitaPulsante(idUtente);
                        if(idRuolo==document.getElementById("ruoloOriginale" + idUtente).value){
                            document.getElementById("pulsanteSalva" + idUtente).disabled = true;
                        }
                        document.getElementById("modifica" + idUtente).value = idRuolo;
                    }

                    function abilitaPulsante(idUtente) {
                        document.getElementById("pulsanteSalva" + idUtente).disabled = false;
                    }

                    function salvaNuovoRuolo(idUtente, nome, cognome) {
                        //console.log(document.getElementById("modifica"+idUtente).value);
                        var codiceRuolo = document.getElementById("modifica"+idUtente).value;
                        var url = "../api/utenti.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", url + '?c=vp&id=' + idUtente, true);
                        xhr.onload = function() {
                            if (xhr.readyState == 4 && xhr.status == "200") {
                                if (xhr.responseText == "0") {
                                    document.getElementById("linkImpostaPw").setAttribute("href", "modificaUtente.php?id=" + idUtente);
                                    document.getElementById("bottoneNecessarioCambioPasswordDalServizio").click(); 
                                } else {
                                    var url = "../api/utenti.php";
                                    var xx = new XMLHttpRequest();
                                    xx.open("GET", url + '?c=ct&id=' + idUtente+'&codR='+codiceRuolo, true);
                                    xx.onload = function() {
                                        if (xx.readyState == 4 && xx.status == "200") {
                                            document.getElementById("pulsanteSalva" + idUtente).disabled = true;
                                            document.getElementById("ruoloOriginale"+idUtente).value=codiceRuolo;
                                            document.getElementById("bottoneRuoloAggiornatoDalServizio").click();  
                                            console.log("OK");
                                        } else {

                                            setTimeout(() => {
                                                document.getElementById("bottoneErroreGenerico").click();
                                            }, 500);
                                            console.log("ERRORE");
                                        }
                                    }
                                    xx.send(null);
                                }

                                console.log("OK");
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
               
                
                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>