<?php

    include '../business/checkListBusiness.php';

    function stampaMezzo($id){
        $result=selezionaVeicolo($id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale='<div class="row pt-5">
                <div class="col-5">
                        <a class="text-decoration-none" href="index.php"><i class="text-dark h3 fas fa-laptop-medical"></i><span class="text-sans-serif h3 text-dark"> ReintegrApp</span></a>
                        <p class="lead">'.NOME_ASSOCIAZIONE.'</p>
                </div>
                <div class="col-7 text-center">
                    <h3>CheckList '.$row["tipo"].' '.$row["codice_mezzo"].'</h3>
                    <small>Stampato alle ore '.$row["data_attuale"].' da '.$_SESSION["operatore"].'</small>
                </div>
            </div>';
            $finale=$finale.stampaElencoProdottiNelMezzo($id); 
            $finale=$finale.stampaElencoSaccheNelMezzo($id);  
            $finale=$finale.stampaElencoZainiNelMezzo($id); 
            return $finale;
            }
        }else{
            header('location: errore404.php');
        }
    }

    function stampaElencoProdottiNelMezzo($id){

        $finale='<h3>Prodotti nel mezzo</h3>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Flag</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Note</th>
                </tr>
            </thead>
            <tbody>';
        $result = selezionaProdottiNelVeicolo($id);    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <th scope="col"></th>
                <td scope="col">'.$row["nome"].'</td>
                <td scope="col" class="text-center">'.$row["quantita_totale"].'</td>
                <td scope="col"></td>
            </tr>';
            }
        }



        return $finale.'</tbody></table>';                      

    }

    function stampaElencoZainiNelMezzo($id){
        $finale="";
        $result = selezionaListaZaini($id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<h3>'.$row["nome"].'</h3>';
                $finale=$finale.stampaElencoProdottiNelloZaino($row["zaino_id"]);
                $finale=$finale.stampaElencoSaccheNelloZaino($row["zaino_id"]);
            }
        }    
        return $finale;
    }

    function stampaElencoProdottiNelloZaino($id){
        $finale='<table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Flag</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Note</th>
                </tr>
            </thead>
            <tbody>';
        $result = selezionaProdottiNelloZaino($id);    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <th scope="col"></th>
                <td scope="col">'.$row["nome"].'</td>
                <td scope="col" class="text-center">'.$row["quantita_totale"].'</td>
                <td scope="col"></td>
            </tr>';
            }
        }



        return $finale.'</tbody></table>';

    }

    function stampaElencoSaccheNelMezzo($id){
        $finale="";
        $result = getListaSacche($id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<h3>'.$row["nome"].' - '.$row["colore"].' (Sul mezzo)</h3>';
                $finale=$finale.stampaElencoProdottiNellaSacca($row["id"]);
            }
        }    
        return $finale;
    }

    function stampaElencoSaccheNelloZaino($id){
        $finale="";
        $result = getListaSaccheNelloZaino($id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<h3>'.$row["nome"].' - '.$row["colore"].' (Nello zaino)</h3>';
                $finale=$finale.stampaElencoProdottiNellaSacca($row["id"]);
            }
        }    
        return $finale;
    }

    function stampaElencoProdottiNellaSacca($id){
        $finale='<table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Flag</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Note</th>
                </tr>
            </thead>
            <tbody>';
        $result = selezionaProdottiNellaSacca($id);    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<tr>
                <th scope="col"></th>
                <td scope="col">'.$row["nome"].'</td>
                <td scope="col" class="text-center">'.$row["quantita_totale"].'</td>
                <td scope="col"></td>
            </tr>';
            }
        }



        return $finale.'</tbody></table>'; 
    }
