var isSidebarNascosta = false;

function nascondiSidebar() {
    if (!isSidebarNascosta) {
        document.getElementById("sidebar").style.display = "none";
        document.getElementById("contenuto").classList.remove("col-xl-10");
        document.getElementById("contenuto").classList.add("col-xl-12");
        isSidebarNascosta = true;
    } else {
        document.getElementById("sidebar").style.display = "block";
        document.getElementById("contenuto").classList.remove("col-xl-12");
        document.getElementById("contenuto").classList.add("col-xl-10");
        isSidebarNascosta = false;
    }

}

function controllaEmail(email) {
    if (!validateEmail(email.value)) {
        document.getElementById("divMail").style.visibility = "visible";
        document.getElementById("email").style.borderColor = "#d9364f";
        document.getElementById("divMail").innerHTML = "Controllare la sintassi dell'indirizzo email";
    } else {
        document.getElementById("divMail").style.visibility = "hidden";
        document.getElementById("email").style.borderColor = "#5c6f82";
    }
    if (email.value == "") {
        document.getElementById("divMail").innerHTML = "Campo obbligatorio";
    }
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateForm() {
    var esito = true;
    if (document.getElementById("nome").value == "") {
        aggiungiNomeCampoNonValidato("Nome");
        esito = false;
    }
    if (document.getElementById("cognome").value == "") {
        aggiungiNomeCampoNonValidato("Cognome");
        esito = false;
    }
    if (!validateEmail(document.getElementById("email").value)) {
        aggiungiNomeCampoNonValidato("Email");
        esito = false;
    }
    if (document.getElementById("password").value.length < 6 && document.getElementById("password").value.length > 0) {
        aggiungiNomeCampoNonValidato("Password");
        esito = false;
    }
    if (document.getElementById("data_di_nascita").value != "") {
        if (!convalidaData(document.getElementById("data_di_nascita").value)) {
            aggiungiNomeCampoNonValidato("Data di nascita");
            esito = false;
        }
    }
    if (document.getElementById("numero_tessera").value == "") {
        aggiungiNomeCampoNonValidato("N. Tessera");
        esito = false;
    }

    console.log(esito);
    if(!esito)
        document.getElementById("bottoneErrataValidazioneForm").click();
    return esito;
}
var isPrimaVoltaCampoNonValidato=true;
function aggiungiNomeCampoNonValidato(testo) {
    if(isPrimaVoltaCampoNonValidato){
        isPrimaVoltaCampoNonValidato=false;
        document.getElementById("elencoCampiNonValidati").innerHTML = document.getElementById("elencoCampiNonValidati").innerHTML+testo;
    }else{
        document.getElementById("elencoCampiNonValidati").innerHTML = document.getElementById("elencoCampiNonValidati").innerHTML + ", " + testo;
    }
}

function resettaNomeCampoNonValidato(){
    isPrimaVoltaCampoNonValidato=true;
    document.getElementById("elencoCampiNonValidati").innerHTML ="";
}

//DA DD/MM/AAAA -> AAAA-MM-DD
function convertiDataDaFormatoItaliano(data) {
    giorno = data.substring(0, 2);
    mese = data.substring(3, 5);
    anno = data.substring(6, 10);
    return anno + "-" + mese + "-" + giorno;
}

function convalidaData(data) {
    data = data.toString();
    giorno = data.substring(0, 2);
    mese = data.substring(3, 5);
    anno = data.substring(6, 10);
    console.log("Giorno: " + giorno + " Mese: " + mese + " Anno: " + anno);
    if (data.charAt(2) != "/" || data.charAt(5) != "/" || data.length != 10) {
        console.log("A");
        return false; //FUNZIONA
    }
    if (isNaN(giorno) || isNaN(mese) || isNaN(anno)) {
        console.log("B");
        return false; //FUNZIONA
    }
    isAnnoBisestile = isBisestile(anno);
    if (giorno > 31 || mese > 12 || giorno < 1 || mese < 1 || anno < 1) {
        console.log("C");//FUNZIONA
        return false;
    }
    if (giorno > 28 && mese == 2 && isAnnoBisestile == false) {
        console.log("D");//FUNZIONA
        return false;
    }
    if (giorno > 29 && mese == 2 && isAnnoBisestile == true) {
        console.log("E");//FUNZIONA
        return false;
    }
    if (giorno > 30 && (mese == 4 || mese == 6 || mese == 9 || mese == 11)) {
        console.log("F");
        return false; //FUNZIONA
    }
    return true;
}

function convalidaDataScadenza(data) {
    return convalidaData("01/" + data);
}

//Funziona correttamente
function isBisestile(yr) { return !((yr % 4) || (!(yr % 100) && (yr % 400))); };




