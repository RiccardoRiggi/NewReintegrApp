<?php

include '../business/prodottiBusiness.php';

function stampaEtichettaSingola($id){
    $result = getEtichettaSingola($id);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return '<div class="cointainer-fluid">
            <div class="row">
                <div class="col-3">
    
                </div>
                <div class="col-6">
                    <?php echo $scheda; ?>
                    <div class="row border">
                        <div class="col">
                            <div class="row">
                                <div class="col-3 pt-2">
                                    <figure class="figure">
                                        <img src="https://chart.apis.google.com/chart?cht=qr&chs=150x150&chl='.$row["etichetta"].'">
                                    </figure>
                                </div>
                                <div class="col-9">
                                    <div class="row pt-3">
                                        <div class="col text-center">
                                            <p class="text-monospace">'.NOME_ASSOCIAZIONE.'</p>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col text-center">
                                            <p class="text-monospace h4">'.$row["nome"].'</p>
                                            <p class="text-monospace h6">'.$row["descrizione"].'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="col-3">
    
                </div>
            </div>
        </div>';
        }
    }else{
        header('location: errore404.php');
    }
}

function stampaTutteEtichette(){
    $finale="";
    $result = getListaEtichette();
    if ($result->num_rows > 0) {
        $numero=0;
        while($row = $result->fetch_assoc()) {
            $finale=$finale.stampaEtichettaSingola($row["prodotto_id"]);
            $numero++;
            if($numero==6){
                $numero=0;
                $finale=$finale.generaBr();
            }
        }
    }
    return $finale;
}

function stampaDeterminatiBadge($lista){
    $finale="";
    $numeroId=substr_count($lista,";");
    $numero=0;
    for($c=0;$c<$numeroId;$c++){
        $idAttuale=substr($lista,0,strpos($lista,";"));
        $lista=substr($lista,strlen($idAttuale)+1);
        $finale=$finale.stampaEtichettaSingola($idAttuale);   
        $numero++;
            if($numero==6){
                $numero=0;
                $finale=$finale.generaBr();
            } 
    }
    return $finale;
}

function generaBr(){
    return '<br/><br/><br/><br/><br/><br/><br/><br/>';
}

?>