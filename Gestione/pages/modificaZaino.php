<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/modificaZainoInt.php'; ?>

<?php

if (isset($_POST["nome"])) {
    aggiornaZaino($_POST["zaino_id"], $_POST["nome"], $_POST["padre"]);
}

if (isset($_GET["id"])) {
    $zaino = ottieniZaino($_GET["id"]);
} else {
    header('location: listaZaini.php');
}
?>


<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Modifica Zaino - ReintegrApp</title>
</head>

<body onload="caricaTabelle();">
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>
                
                
                
                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                <form action="modificaZaino.php?id=<?php echo $zaino["zaino_id"]; ?>" novalidate method="POST" onsubmit="return validaFormAggiungiZaino()">
                    <div class="container-fluid  pt-3">
                        <div class="row ">
                            <div class="col-1"></div>
                            <div class="col-4 p-2 bg-white">
                                <h4 class="pl-3 testo-scuro">Modifica Zaino</h4>
                            </div>
                            <div class="col-6 p-2 text-right bg-white">
                                <div class="btn-example">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Salva
                                    </button>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>

                        <!-- CONTENUTO -->
                        <div class="row pt-3">
                            <div class="col-1">

                            </div>
                            <div class="col-10 bg-white">
                                <div class="row pt-5">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group needs-validation">
                                                    <label for="nome">Nome dello zaino</label>
                                                    <input type="hidden" name="zaino_id" id="zaino_id" value="<?php echo $zaino["zaino_id"]; ?>">
                                                    <input required type="text" class="form-control" id="nome" name="nome" value="<?php echo $zaino["nome"]; ?>" placeholder="Inserisci il nome della sacca">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="bootstrap-select-wrapper">
                                                    <label>Posizione della sacca</label>
                                                    <select name="padre" id="padre" title="Scegli una opzione">
                                                        <?php echo generaComboModificaPosizioneZaino($zaino["mezzo_id"]); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <?php echo stampaDataUltimaModifica($zaino); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>





                                <!-- METTERE QUI CONTENUTO INPUT -->

                            </div>
                            <div class="col-1">

                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-1"></div>
                            <div class="col-10 p-2 bg-white">
                                <h4 class="pl-3 testo-scuro">Lista Sacche</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10 bg-white">
                                <?php echo getTabellaListaSacche($zaino["zaino_id"]); ?>
                            </div>
                            <div class="col-1"></div>
                        </div>


                        <div class="row pt-5">
                            <div class="col-1"></div>
                            <div class="col-10 p-2 bg-white">
                                <h4 class="pl-3 testo-scuro">Lista Prodotti</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10 bg-white">
                                <ul class="nav nav-tabs nav-tabs-icon-text" id="myTab3" role="tablist">
                                    <li class="nav-item">

                                        <a class="nav-link active" id="tab1c-tab" data-toggle="tab" href="#tab1b" role="tab" aria-controls="tab1b" aria-selected="true">
                                            <i class="h5 testo-blu fas fa-notes-medical pr-3"></i> Prodotti nello zaino
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2b-tab" data-toggle="tab" href="#tab2b" role="tab" aria-controls="tab2b" aria-selected="false">
                                            <i class="h5 testo-blu fas fa-plus-square pr-3"></i>
                                            Aggiungi nuovi prodotti
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTab3Content">
                                    <div class="tab-pane p-4 fade show active" id="tab1b" role="tabpanel" aria-labelledby="tab1c-tab">
                                        <div id="spazioPerTabellaProdottiNellaSacca">
                                            <div class="progress progress-indeterminate">
                                                <span class="sr-only">In elaborazione...</span>
                                                <div class="progress-bar" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-4 fade" id="tab2b" role="tabpanel" aria-labelledby="tab2b-tab">
                                        <div id="spazioPerTabellaProdottiNonNellaSacca">
                                            <div class="progress progress-indeterminate">
                                                <span class="sr-only">In elaborazione...</span>
                                                <div class="progress-bar" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>

                        <!-- ------------------------------------------- -->



                        <script>
                            function validaFormAggiungiZaino() {
                                esito = true;
                                if (document.getElementById("nome").value == "") {
                                    aggiungiNomeCampoNonValidato("nome dello zaino");
                                    esito = false;
                                }
                                if (document.getElementById("padre").value == "") {
                                    aggiungiNomeCampoNonValidato("posizione dello zaino");
                                    esito = false;
                                }
                                console.log(esito);
                                if (!esito)
                                    document.getElementById("bottoneErrataValidazioneForm").click();
                                return esito;
                            }

                            var pnsDaEliminare = 0;
                            var codiceSaccaDaEliminare = 0;

                            function confermaEliminazione(nome, id, codiceSacca) {
                                document.getElementById("utenteDel").innerHTML = nome;
                                pnsDaEliminare = id;
                                codiceSaccaDaEliminare = codiceSacca;
                            }

                            function caricaTabelle() {
                                caricaProdottiNellaSacca();
                                caricaProdottiNonNellaSacca();
                            }

                            function aggiungiProdottoNellaSacca(id, idSacca) {
                                qtaMax = document.getElementById("qtaMax" + id).value;
                                if (qtaMax < 1) {
                                    aggiungiNomeCampoNonValidato("quantità massima di " + document.getElementById("label" + id).innerHTML);
                                    document.getElementById("bottoneErrataValidazioneForm").click();
                                } else {
                                    //FACCIO CHIAMATA HTTP
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            if (this.responseText == "UPDATED") {
                                                notificationShow('confermaInserimento', 2500);
                                                caricaTabelle();
                                            } else {
                                                setTimeout(() => {
                                                    document.getElementById("bottoneErroreGenerico").click();
                                                }, 500);
                                            }
                                        }
                                    };
                                    xmlhttp.open("GET", "../API/zaini.php?c=a&id=" + id + "&sacca=" + idSacca + "&qtaMax=" + qtaMax, true);
                                    xmlhttp.send();
                                }
                            }

                            function aggiornaProdottoNellaSacca(quantitaPrecedente, idPns, codiceSacca, disponibileInMagazzino, codiceProdotto) {
                                var esito = true;
                                qtaAtt = document.getElementById("qtaAtt" + idPns).value;
                                qtaAttBackup = qtaAtt;
                                qtaTot = document.getElementById("qtaTot" + idPns).value;
                                dataScad = document.getElementById("dataScad" + idPns).value;
                                console.log(qtaAtt + " " + qtaTot);
                                if ((qtaAtt == "" || qtaAtt < 0 || parseInt(qtaAtt) > parseInt(qtaTot)) && qtaAtt <= disponibileInMagazzino) {
                                    esito = false;
                                    aggiungiNomeCampoNonValidato("quantità attuale");
                                }
                                if (qtaAtt > disponibileInMagazzino) {
                                    esito = false;
                                    aggiungiNomeCampoNonValidato("quantità attuale (in magazzino sono presenti solamente <strong>" + disponibileInMagazzino + "</strong> unità)");
                                }
                                if (quantitaPrecedente > qtaAtt) {
                                    qtaAtt = (quantitaPrecedente - qtaAtt) * -1;
                                } else if (quantitaPrecedente < qtaAtt) {
                                    qtaAtt = qtaAtt - quantitaPrecedente;
                                }
                                if (qtaTot == "" || qtaTot <= 0) {
                                    esito = false;
                                    aggiungiNomeCampoNonValidato("quantità massima");
                                }
                                if (dataScad == "") {
                                    aggiungiNomeCampoNonValidato("data di scadenza");
                                    esito = false;
                                } else if (!convalidaDataScadenza(dataScad)) {
                                    esito = false;
                                    aggiungiNomeCampoNonValidato("data di scadenza");
                                } else {
                                    dataScad = "01/" + dataScad;
                                }
                                if (!esito)
                                    document.getElementById("bottoneErrataValidazioneForm").click();
                                else {
                                    var xmlhttppppp = new XMLHttpRequest();
                                    xmlhttppppp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            if (this.responseText == "UPDATED") {
                                                notificationShow('confermaSalvataggio', 2500);
                                                caricaTabelle();
                                            } else {
                                                setTimeout(() => {
                                                    document.getElementById("bottoneErroreGenerico").click();
                                                }, 500);
                                            }
                                        }
                                    };
                                    var url = "../API/zaini.php?c=u&id=" + idPns + "&qtaAtt=" + qtaAtt + "&qtaTot=" + qtaTot + "&dataScad=" + dataScad + "&codiceSacca=" + codiceSacca + "&codiceProdotto=" + codiceProdotto + "&labelAggiunta=" + qtaAttBackup;
                                    xmlhttppppp.open("GET", url, true);
                                    xmlhttppppp.send(null);
                                }

                            }

                            function eliminaProdottoNellaSacca(codiceSacca) {
                                var url = "../api/zaini.php";
                                var xhr = new XMLHttpRequest();
                                xhr.open("DELETE", url + '?c=dp&id=' + pnsDaEliminare + "&codiceSacca=" + codiceSacca, true);
                                xhr.onload = function() {
                                    if (xhr.readyState == 4 && xhr.status == "200") {
                                        if (this.responseText == "UPDATED") {
                                            notificationShow('confermaEliminazione', 2500);
                                            caricaTabelle();
                                        } else {
                                            setTimeout(() => {
                                                document.getElementById("bottoneErroreGenerico").click();
                                            }, 500);
                                        }
                                    }
                                }
                                xhr.send(null);
                            }

                            function caricaProdottiNellaSacca() {
                                str = document.getElementById("zaino_id").value;
                                if (str.length == 0) {
                                    document.getElementById("spazioPerTabellaProdottiNellaSacca").innerHTML = "Errore";
                                    return;
                                } else {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("spazioPerTabellaProdottiNellaSacca").innerHTML = this.responseText;
                                            $('#tabellaProdottiNelleSacche').DataTable().draw();
                                        }
                                    };
                                    xmlhttp.open("GET", "../API/zaini.php?c=sin&id=" + str, true);
                                    xmlhttp.send();
                                }
                            }

                            function caricaProdottiNonNellaSacca() {
                                str = document.getElementById("zaino_id").value;
                                if (str.length == 0) {
                                    document.getElementById("spazioPerTabellaProdottiNonNellaSacca").innerHTML = "Errore";
                                    return;
                                } else {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("spazioPerTabellaProdottiNonNellaSacca").innerHTML = this.responseText;
                                            $('#tabellaProdottiNonNelleSacche').DataTable().draw();
                                        }
                                    };
                                    xmlhttp.open("GET", "../API/zaini.php?c=sout&id=" + str, true);
                                    xmlhttp.send();
                                }
                            }
                        </script>

                        <div class="container test-desktop">
                            <div class="notification bottom-fix with-icon success" role="alert" aria-labelledby="not1d-title" id="confermaSalvataggio">
                                <h5 id="not1d-title"><i class="fas fa-check h1 text-success"></i>Salvataggio eseguito!</h5>
                            </div>
                        </div>
                        <div class="container test-desktop">
                            <div class="notification bottom-fix with-icon success" role="alert" aria-labelledby="not1d-title" id="confermaEliminazione">
                                <h5 id="not1d-title"><i class="fas fa-check h1 text-success"></i>Eliminazione eseguita!</h5>
                            </div>
                        </div>
                        <div class="container test-desktop">
                            <div class="notification bottom-fix with-icon success" role="alert" aria-labelledby="not1d-title" id="confermaInserimento">
                                <h5 id="not1d-title"><i class="fas fa-check h1 text-success"></i>Prodotto aggiunto!</h5>
                            </div>
                        </div>


                        <div class="modal fade" tabindex="-1" role="dialog" id="confermaEliminazioneProdottoNellaSacca">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Attenzione!
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Vuoi confermare l'eliminazione del prodotto <span id="utenteDel"></span> dalla sacca selezionata? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal" onclick="eliminaProdottoNellaSacca()">Conferma</button>
                                        <button class="btn btn-outline-primary btn-sm" data-dismiss="modal" type="button">Annulla</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ------------------------------------------- -->

                    </div>
                </form>

                <script>
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            var forms = document.getElementsByClassName('needs-validation');
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                }, false);
                                form.classList.add('was-validated');
                            });
                        }, false);
                    })();
                </script>
                <!-- FINE CONTENUTO PAGINA -->
                <?php include './common/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>