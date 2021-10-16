<!-- MODALE ERRORE GENERICO -->
<button style="display: none;" id="bottoneErroreGenerico" data-toggle="modal" data-target="#erroreGenerico" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="erroreGenerico">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Errore!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-danger-rosso-solo h1"></i>
                    <p>L'operazione non è andata a buon fine. Riprovare!</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneErrataValidazioneForm" data-toggle="modal" data-target="#erroreValidazioneForm" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="erroreValidazioneForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attenzione!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-times text-danger-rosso-solo h1"></i>
                    <p>Si prega di controllare i campi <span id="elencoCampiNonValidati"> </span>. <br>Alcuni dati sono mancanti oppure inseriti in modo errato!</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger btn-sm" data-dismiss="modal" type="button" onclick="resettaNomeCampoNonValidato();">Chiudi</button>
            </div>
        </div>
    </div>
</div>



<button style="display: none;" id="bottoneNuovoMessaggioDalServizio" data-toggle="modal" data-target="#nuovoMessaggioDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="nuovoMessaggioDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hai ricevuto un nuovo messaggio!
                </h5>
            </div>
            <div class="modal-footer">
            <a href="listaMessaggi.php" class="btn btn-outline-danger btn-sm">Vedi messaggio</a>
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneNuovaNotificaDalServizio" data-toggle="modal" data-target="#nuovaNotificaDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="nuovaNotificaDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hai ricevuto una nuova notifica!
                </h5>
            </div>
            <div class="modal-footer">
            <a href="listaNotifiche.php" class="btn btn-outline-danger btn-sm">Vedi notifica</a>
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneBadgeBloccatoDalServizio" data-toggle="modal" data-target="#badgeBloccatoDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="badgeBloccatoDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Badge Bloccato!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Operazione conclusa con successo!</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneBadgeSbloccatoDalServizio" data-toggle="modal" data-target="#badgeSbloccatoDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="badgeSbloccatoDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Badge Sbloccato!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Operazione conclusa con successo!</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneBadgeRigeneratoDalServizio" data-toggle="modal" data-target="#badgeRigeneratoDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="badgeRigeneratoDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Badge Rigenerato!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Operazione conclusa con successo. Ricordati di stampare il nuovo badge di accesso da consegnare</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneNecessarioCambioPasswordDalServizio" data-toggle="modal" data-target="#necessarioCambioPasswordDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="necessarioCambioPasswordDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Errore!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Per poter cambiare il ruolo di è necessario impostare una password di accesso. <a id="linkImpostaPw" class="font-weight-bold text-decoration-none">Imposta adesso!</a></p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneRuoloAggiornatoDalServizio" data-toggle="modal" data-target="#ruoloAggiornatoDalServizio" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="ruoloAggiornatoDalServizio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ruolo aggiornato!
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Il ruolo è stato aggiornato con successo!</p>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneSalvataggioEseguito" data-toggle="modal" data-target="#salvataggioEseguito" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="salvataggioEseguito">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvataggio eseguito!
                </h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneEliminazioneEseguita" data-toggle="modal" data-target="#eliminazioneEseguita" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="eliminazioneEseguita">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminazione eseguita!
                </h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" id="bottoneProdottoAggiunto" data-toggle="modal" data-target="#prodottoAggiunto" type="button" class="btn text-white  p-1 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
</button>
<div class="modal fade" tabindex="-2" role="dialog" id="prodottoAggiunto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvataggio eseguito!
                </h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>