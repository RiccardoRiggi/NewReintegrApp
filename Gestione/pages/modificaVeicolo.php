<?php include '../auth_components/controlloAutenticazione.php'; ?>
<?php include '../integration/modificaVeicoloInt.php'; ?>

<?php

if (isset($_POST["nome"])) {
    aggiornaVeicolo($_POST["mezzo_id"], $_POST["codice_mezzo"], $_POST["nome"], $_POST["targa"], $_POST["tipo"]);
}

if (isset($_GET["id"])) {
    $veicolo = ottieniVeicolo($_GET["id"]);
} else {
    header('location: listaVeicoli.php');
}
?>

<!DOCTYPE html>
<html class="altezza-piena" lang="it">

<head>
    <?php include './common/headscript.php'; ?>
    <title>Modifica Veicolo - ReintegrApp</title>
</head>

<body onload="caricaTabelle();">
    <div id="wrapper">
        <?php include './common/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './common/header.php'; ?>



                <!-- INIZIO CONTENUTO PAGINA -->
                <div class="container-fluid ">
                    <form action="modificaVeicolo.php?id=<?php echo $veicolo["mezzo_id"]; ?>" onsubmit="return validaFormAggiungiVeicolo()" novalidate method="POST">


                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Modifica veicolo</h6>
                                <div class="btn-example p-1 text-right">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-save"></i> Salva
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- CONTENUTO -->
                                <div class="row pt-3">
                                    <div class="col-1">

                                    </div>
                                    <div class="col-10 bg-white">
                                        <div class="row ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group needs-validation">
                                                            <label for="nome">Nome del veicolo</label>
                                                            <input type="hidden" id="mezzo_id" name="mezzo_id" value="<?php echo $veicolo["mezzo_id"]; ?>">
                                                            <input required type="text" class="form-control" id="nome" name="nome" value="<?php echo $veicolo["nome"]; ?>" placeholder="Inserisci il nome del veicolo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group needs-validation">
                                                            <label for="codice_mezzo">Codice di riconoscimento</label>
                                                            <input required type="text" class="form-control" id="codice_mezzo" name="codice_mezzo" value="<?php echo $veicolo["codice_mezzo"]; ?>" placeholder="Inserisci il codice identificativo">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group needs-validation">
                                                            <label for="targa">Targa</label>
                                                            <input required type="text" class="form-control" id="targa" name="targa" placeholder="Inserisci la targa" value="<?php echo $veicolo["targa"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="bootstrap-select-wrapper ">
                                                            <label>Tipo</label>
                                                            <select class="form-control" name="tipo" id="tipo" class="needs-validation" title="Scegli una opzione" required>
                                                                <option <?php echo selected($veicolo["tipo"], "Ambulanza") ?> value="Ambulanza">Ambulanza</option>
                                                                <option <?php echo selected($veicolo["tipo"], "Automedica") ?> value="Automedica">Automedica</option>
                                                                <option <?php echo selected($veicolo["tipo"], "Vettura") ?> value="Vettura">Vettura</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo stampaDataUltimaModifica($veicolo); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- METTERE QUI CONTENUTO INPUT -->

                                    </div>
                                    <div class="col-1">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- CONTENUTO -->


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Lista zaini</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <?php echo getTabellaListaZaini($veicolo["mezzo_id"]);
                                    ?>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Lista sacche</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <?php echo getTabellaListaSacche($veicolo["mezzo_id"]); ?>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>


                    

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Lista prodotti</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10 bg-white p-3">
                                    <ul class="nav nav-tabs nav-tabs-icon-text" id="myTab3" role="tablist">
                                        <li class="nav-item">

                                            <a class="nav-link active" id="tab1c-tab" data-toggle="tab" href="#tab1b" role="tab" aria-controls="tab1b" aria-selected="true">
                                                <i class="h5 text-danger fas fa-notes-medical pr-3"></i> Prodotti nel veicolo
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab2b-tab" data-toggle="tab" href="#tab2b" role="tab" aria-controls="tab2b" aria-selected="false">
                                                <i class="h5 text-danger fas fa-plus-square pr-3"></i>
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
                        </div>
                    </div>



                    <!-- ------------------------------------------- -->



                    <script>
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
                                            document.getElementById("bottoneProdottoAggiunto").click();
                                            caricaTabelle();
                                        } else {
                                            setTimeout(() => {
                                                document.getElementById("bottoneErroreGenerico").click();
                                            }, 500);
                                        }
                                    }
                                };
                                xmlhttp.open("GET", "../api/veicoli.php?c=a&id=" + id + "&sacca=" + idSacca + "&qtaMax=" + qtaMax, true);
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
                                            document.getElementById("bottoneSalvataggioEseguito").click();
                                            caricaTabelle();
                                        } else {
                                            setTimeout(() => {
                                                document.getElementById("bottoneErroreGenerico").click();
                                            }, 500);
                                        }
                                    }
                                };
                                var url = "../api/veicoli.php?c=u&id=" + idPns + "&qtaAtt=" + qtaAtt + "&qtaTot=" + qtaTot + "&dataScad=" + dataScad + "&codiceSacca=" + codiceSacca + "&codiceProdotto=" + codiceProdotto + "&labelAggiunta=" + qtaAttBackup;
                                xmlhttppppp.open("GET", url, true);
                                xmlhttppppp.send(null);
                            }

                        }

                        function eliminaProdottoNellaSacca(codiceSacca) {
                            var url = "../api/veicoli.php";
                            var xhr = new XMLHttpRequest();
                            xhr.open("DELETE", url + '?c=dp&id=' + pnsDaEliminare + "&codiceSacca=" + codiceSacca, true);
                            xhr.onload = function() {
                                if (xhr.readyState == 4 && xhr.status == "200") {
                                    if (this.responseText == "UPDATED") {
                                        document.getElementById("bottoneEliminazioneEseguita").click();
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
                            str = document.getElementById("mezzo_id").value;
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
                                xmlhttp.open("GET", "../api/veicoli.php?c=sin&id=" + str, true);
                                xmlhttp.send();
                            }
                        }

                        function caricaProdottiNonNellaSacca() {
                            str = document.getElementById("mezzo_id").value;
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
                                xmlhttp.open("GET", "../api/veicoli.php?c=sout&id=" + str, true);
                                xmlhttp.send();
                            }
                        }
                    </script>






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
                                    <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" onclick="eliminaProdottoNellaSacca()">Conferma</button>
                                    <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button">Annulla</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ------------------------------------------- -->



                </div>

                <script>
                    function validaFormAggiungiVeicolo() {
                        esito = true;
                        if (document.getElementById("nome").value == "") {
                            aggiungiNomeCampoNonValidato("nome del veicolo");
                            esito = false;
                        }
                        if (document.getElementById("codice_mezzo").value == "") {
                            aggiungiNomeCampoNonValidato("codice del veicolo");
                            esito = false;
                        }
                        if (document.getElementById("targa").value == "") {
                            aggiungiNomeCampoNonValidato("targa");
                            esito = false;
                        }
                        if (document.getElementById("tipo").value == "") {
                            aggiungiNomeCampoNonValidato("tipo");
                            esito = false;
                        }
                        console.log(esito);
                        if (!esito)
                            document.getElementById("bottoneErrataValidazioneForm").click();
                        return esito;
                    }
                </script>
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