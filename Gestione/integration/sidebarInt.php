<?php

include '../business/sidebarBusiness.php';


function generaMenu()
{

    $result = selezionaPadri();

    $esito = '<div class="sidebar-wrapper">
    <div class="sidebar-linklist-wrapper">
        <div class="link-list-wrapper">
            ';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $espandibile = selezionaFigli($row["voce_id"]);
            $esito = $esito . '<li class="nav-item">
                    <a class="nav-link collapsed"  data-toggle="collapse" data-target="#' . $row["url"] . '" aria-expanded="true" aria-controls="' . $row["url"] . '">
                    <i class="' . $row["icona"] . '"></i>
                    <span>' . $row["etichetta"] . '</span>
                    </a>



                    <div id="' . $row["url"] . '" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opzioni disponibili:</h6>
                        ';
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