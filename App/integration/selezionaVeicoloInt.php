<?php

    include '../business/veicoloBusiness.php';

    function stampaListaVeicoli(){
        $finale="";
        $result = selezionaTuttiVeicoli();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<a class="text-decoration-none" href="selezionaProdotto.php?mezzo_id='.$row["mezzo_id"].'"><div class="container pt-3">
                <div class="row shadow p-3 rounded bg-white m-1">
                    <div class="col-2">
                        '.stampaIconaMezzo($row["tipo"]).'
                    </div>
                    <div class="col-10">
                        <h5 class="text-dark">'.$row["codice_mezzo"].' - '.$row["tipo"].'</h5>
                    </div>
                </div>
            </div></a>';
            }
        }
        return $finale;
    }

    function stampaIconaMezzo($tipo){
        if($tipo=="Ambulanza"){
            return '<i class="fas fa-ambulance h1 testo-blu"></i>';
        }else if($tipo=="Automedica"){
            return '<i class="fas fa-taxi h1 testo-blu"></i>';
        }else{
            return '<i class="fas fa-car h1 testo-blu"></i>';
        }
    }

?>