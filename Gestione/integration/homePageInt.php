<?php

include '../business/homePageBusiness.php';

function stampaGrafico()
{
    $resultOne = getUltimiSetteGiorni();
    $resultTwo = getUltimiSetteGiorniReintegri();

    $data = "";
    $label = "";

    $reintegro = $resultTwo->fetch_assoc();
    if ($resultOne->num_rows > 0) {
        while ($row = $resultOne->fetch_assoc()) {
            if ($row["giorno"] == $reintegro["data_reintegro"]) {
                $data = $data . "," . $reintegro["n"];
                $label = $label . ',"' . $row["dataLabel"] . '"';
                $reintegro = $resultTwo->fetch_assoc();
            } else {
                $data = $data . ",0";
                $label = $label . ',"' . $row["dataLabel"] . '"';
            }
        }
    }
    $label = substr($label, 1, strlen($label));
    $data = substr($data, 1, strlen($data));
    return 'var ctx = document.getElementById("myChart").getContext(\'2d\');
        var myChart = new Chart(ctx, {
            type: \'line\',
            data: {
                labels: [' . $label . '],
                datasets: [{
                    label: \'Mezzi reintegrati\',
                    data: [' . $data . '],
                    backgroundColor: [
                        \'rgba(231, 74, 59, 0.8)\',
                    ],
                    borderColor: [
                        \'rgba(231 ,74 , 59,1)\',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                        }
                    }],
                },
                legend:{
                    display: false,
                }
            }
        });';
}


function stampaSchedaProdottiDaReintegrate()
{
    $result = getNumeroProdottiEsauritiInMagazzinoMiliti();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            return '<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="listaStrategica.php?t=reintegrare">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Prodotti da reintegrare: </div></a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">' . $row["n"] . '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-syringe fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>  
</div>';
        }
    }
}

function stampaSchedaProdottiEsauriti()
{
    $result = getNumeroProdottiEsauritiInMagazzino();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            return '<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="listaStrategica.php?t=esauriti">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Prodotti esauriti in magazzino: </div></a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">' . $row["n"] . '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-syringe fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>  
</div>';
        }
    }
}

function stampaSchedaProdottiInScadenza()
{
    $result = getNumeroProdottiInScadenza();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            return '<div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                <a href="listaStrategica.php?t=scadenza"><div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Prodotti in scadenza: </div></a>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">' . $row["n"] . '</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-syringe fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
        </div>';
        }
    }
}

function stampaSchedaProdottiScaduti()
{
    $result = getNumeroProdottiScaduti();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return '<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="listaStrategica.php?t=scaduti"><div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Prodotti scaduti: </div></a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">' . $row["n"] . '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-syringe fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>  
</div>';
        }
    }
}

function stampaClassificaHomePage()
{
    $finale = '<ul class="list-group">';

    $result = getClassificaReintegri();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $finale = $finale .'<li class="list-group-item d-flex justify-content-between align-items-center">
        ' . $row["nome"] . ' ' . $row["cognome"] . '
        <span class="badge badge-danger badge-pill">' . $row["n"] . '</span>
      </li>';
        }
    }
    $finale = $finale . '</ul>';
    return $finale;
}
