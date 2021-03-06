<?php

include '../business/sidebarBusiness.php';

function isEspanso($resultTwo){
    
    while($rowTwo = $resultTwo->fetch_assoc()) {
        if(strpos($_SERVER['PHP_SELF'],$rowTwo["url"]))
            return true;
    }
    return false;
}


function generaMenu()
{

    $result = selezionaPadri();

    $esito = '<div class="sidebar-wrapper">
    <div class="sidebar-linklist-wrapper">
        <div class="link-list-wrapper">
            ';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if(isEspanso(selezionaFigli($row["voce_id"]))){
                //CODICE SE DEVE ESSERE ESPANSO
                $esito = $esito . '<li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" data-target="#' . $row["url"] . '" aria-expanded="true" aria-controls="' . $row["url"] . '">
                    <i class="' . $row["icona"] . '"></i>
                    <span>' . $row["etichetta"] . '</span>
                    </a>



                    <div id="' . $row["url"] . '" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opzioni disponibili:</h6>
                        ';
            }else{
                //CODICE SE NON LO DEVE ESSERE
                $esito = $esito . '<li class="nav-item">
                    <a class="nav-link collapsed"  data-toggle="collapse" data-target="#' . $row["url"] . '" aria-expanded="true" aria-controls="' . $row["url"] . '">
                    <i class="' . $row["icona"] . '"></i>
                    <span>' . $row["etichetta"] . '</span>
                    </a>



                    <div id="' . $row["url"] . '" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opzioni disponibili:</h6>
                        ';
            }
            
            $resultTwo = selezionaFigli($row["voce_id"]);
            while ($rowTwo = $resultTwo->fetch_assoc()) {
                if ($rowTwo["isVisibile"]) {
                    $esito = $esito . '<a class="collapse-item" href="' . $rowTwo["url"] . '">' . $rowTwo["etichetta"] . '</a>';
                }
            }
            $esito = $esito . '
                    </div>
                </div>





                    ';
        }
    }

    $esito = $esito . '</li>
        </div>
    </div>
</div>';
    return $esito;
}





?>