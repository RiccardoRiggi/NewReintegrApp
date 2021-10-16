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
                <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
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
                <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button" onclick="resettaNomeCampoNonValidato();">Chiudi</button>
            </div>
        </div>
    </div>
</div>