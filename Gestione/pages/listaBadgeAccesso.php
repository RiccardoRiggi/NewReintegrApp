<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/listaBadgeAccessoInt.php'; ?>
<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Lista Badge Di Accesso - ReintegrApp</title>
</head>

<body onload="resettaCheck()">
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Lista badge di accesso</h6>
                            <div class="btn-example text-right">
                                <form method="POST" action="stampaBadgeAccessoDiGruppo.php" target="_blank">
                                    <input type="hidden" value="" name="listaIdPost" id="listaIdPost">
                                    <button id="bottoneStampaSelezionati" disabled type="submit" class="btn btn-danger">
                                        <i class="fas fa-check"></i> Stampa selezionati <span id="numeroSelezionati"> (0)</span>
                                    </button>

                                    <a href="stampaBadgeAccessoDiGruppo.php?all=true" target="_blank"><button type="button" class="btn btn-danger">
                                            <i class="fas fa-print"></i> Stampa tutti
                                        </button></a>

                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- CONTENUTO -->

                            <div class="row ">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <?php echo generaListaBadgeUtenti(); ?>

                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>


                </div>



                <script>
                    function resettaCheck() {
                        var x = document.getElementsByClassName("checkSelezione");
                        for (c = 0; c < x.length; c++)
                            x[c].checked = false;
                    }


                    var selezionti = 0;
                    var listaIdQr = "";

                    function stampaSelezionati(checkbox, id) {
                        bottoneStampaSelezionati = document.getElementById("bottoneStampaSelezionati");
                        numeroSelezionati = document.getElementById("numeroSelezionati");
                        lista = document.getElementById("listaIdPost");

                        if (checkbox.checked) {
                            selezionti++;
                            listaIdQr = listaIdQr + id + ";";
                        } else {
                            selezionti--;
                            listaIdQr = listaIdQr.replace(id + ";", "");

                        }
                        //console.log(listaIdQr);
                        lista.value = listaIdQr;
                        if (selezionti == 0) {
                            bottoneStampaSelezionati.disabled = true;
                            numeroSelezionati.innerHTML = " (0)";
                        } else {
                            bottoneStampaSelezionati.disabled = false;
                            numeroSelezionati.innerHTML = " (" + selezionti + ")";
                        }
                        //console.log(lista.value);
                    }

                    function devoBloccare(devoBloccare, id, nome, cognome, bottone) {
                        if (devoBloccare) {
                            var url = "../api/utenti.php?c=b";
                        } else {
                            var url = "../api/utenti.php?c=s";
                        }
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", url + '&id=' + id, true);
                        xhr.onload = function() {
                            if (xhr.readyState == 4 && xhr.status == "200") {
                                setTimeout(() => {
                                    if (devoBloccare) {
                                        bottone.setAttribute("onclick", "devoBloccare(false," + id + ",\"" + nome + "\",\"" + cognome + "\",this)");
                                        document.getElementById("nomeBloccato").innerHTML = nome;
                                        document.getElementById("cognomeBloccato").innerHTML = cognome;
                                        document.getElementById("stato" + id).innerHTML = '<i title="Badge disabilitato" class="h3 text-danger-rosso-solo far fa-times-circle"></i>';
                                        document.getElementById("bottoneBadgeBloccatoDalServizio").click();
                                        bottone.setAttribute("title", "Abilita Badge");
                                        bottone.innerHTML = '<i class="fas fa-unlock"></i>';

                                    } else {
                                        bottone.setAttribute("onclick", "devoBloccare(true," + id + ",\"" + nome + "\",\"" + cognome + "\",this)");
                                        document.getElementById("nomeSbloccato").innerHTML = nome;
                                        document.getElementById("cognomeSbloccato").innerHTML = cognome;
                                        document.getElementById("stato" + id).innerHTML = '<i title="Badge abilitato" class="h3 verde far fa-check-circle"></i>';
                                        document.getElementById("bottoneBadgeSbloccatoDalServizio").click();
                                        bottone.setAttribute("title", "Disabilita Badge");
                                        bottone.innerHTML = '<i class="fas fa-lock"></i>';


                                    }
                                }, 1000);
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

                    function cacheRigenera(id, nome, cognome) {
                        document.getElementById("nomeRige").innerHTML = nome + " " + cognome;
                        document.getElementById("bottoneConfermaRigenerazione").setAttribute("onclick", "rigeneraQrCode(" + id + ',"' + nome + '","' + cognome + '")');
                    }


                    function rigeneraQrCode(id, nome, cognome) {
                        var url = "../api/utenti.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", url + '?c=r&id=' + id, true);
                        xhr.onload = function() {
                            if (xhr.readyState == 4 && xhr.status == "200") {
                                setTimeout(() => {
                                    document.getElementById("dataGenerazione" + id).innerHTML = "Appena rigenerato";
                                    //document.getElementById("nominativoRigenerato").innerHTML = nome + " " + cognome;
                                    document.getElementById("stato" + id).innerHTML = '<i title="Badge abilitato" class="h3 verde far fa-check-circle"></i>';
                                    document.getElementById("pulsanteBloccoSblocco" + id).setAttribute("onclick", "devoBloccare(true," + id + ",\"" + nome + "\",\"" + cognome + "\",this)");
                                    document.getElementById("pulsanteBloccoSblocco" + id).setAttribute("title", "Disabilita Badge");
                                    document.getElementById("pulsanteBloccoSblocco" + id).innerHTML = '<i class="fas fa-lock"></i>';
                                    document.getElementById("bottoneBadgeRigeneratoDalServizio").click();
                                }, 1000);
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



                <div class="modal fade" tabindex="-2" role="dialog" id="confermaRigenerazione">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Attenzione!
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="fas fa-id-badge text-danger h1"></i>
                                    <p>Rigenerare il badge di accesso comporta la disabilitazione dei badge cartacei stampati precedentemente per <span id="nomeRige"> </span><br> Sei sicuro di voler proseguire? </p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button">Annulla</button>
                                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button" id="bottoneConfermaRigenerazione">Rigenera Badge</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>