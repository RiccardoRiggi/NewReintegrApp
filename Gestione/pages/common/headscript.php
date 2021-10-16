<!-- FAVICON -->
<link rel="icon" href="../img/favicon.png" type="image/png" />

<!-- META TAG RICHIESTI -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">

<!-- BOOTSTRAP ITALIA -->
<script>window.__PUBLIC_PATH__ = "../fonts"</script>
<!--<link rel="stylesheet" href="../css/bootstrap-italia.min.css">
<script src="../js/bootstrap-italia.bundle.min.js"></script>-->
<meta name="theme-color" content="#e74a3b">

<!-- SB ADMIN 2 -->
<script>window.__PUBLIC_PATH__ = "../fonts"</script>
<link rel="stylesheet" href="../css/sb-admin-2.css">
<script src="../plugin/jquery/jquery.min.js"></script>
<script src="../js/sb-admin-2.js"></script>
<script src="../plugin/bootstrap/js/bootstrap.bundle.js"></script>


<meta name="theme-color" content="#0066CC">

<!-- FONTAWESOME -->
<!-- CDN: <script src="https://kit.fontawesome.com/07e1cca567.js" crossorigin="anonymous"></script> -->
<link href="../plugin/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet">

<!-- CSS CUSTOM -->
<link rel="stylesheet" href="../css/custom.css">

<!-- JS CUSTOM -->
<script src="../js/custom.js"></script>    

<!-- CHART CHARTS -->
<script src="../js/chart.bundle.js"></script>    

<!-- DATATABLE -->
<script src="../plugin/datatables.js"></script>   
<link rel="stylesheet" href="../plugin/datatables.min.css">

<!-- IMPOSTAZIONI TABELLA LISTA UTENTI -->
<script>
    
    $(document).ready(function() {
        $('#tabellaUtenti').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [5,6,7] }
                ],
                "order": [[ 1, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaProdotti').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [1,2,3,4] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );
    
    $(document).ready(function() {
        $('#tabellaListaBadgeAccesso').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [5,6,] }
                ],
                "order": [[ 1, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaRuoli').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [2,3,4,5] }
                ],
                "order": [[ 0, "asc" ],[ 1, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaListaEtichette').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [0,3] }
                ],
                "order": [[ 1, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaSacche').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [2,3] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaZaini').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [2,3] }
                ],
                "order": [[ 1, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaProdottiNonNelleSacche').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [1,2] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaProdottiNelleSacche').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [4,5] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaSaccheSemplici').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [1] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaZainiSemplici').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [1] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaReintegri').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [5] }
                ],
                "order": [[ 0, "desc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaClassificaReintegri').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [] }
                ],
                "order": [[ 0, "desc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaDettaglioReintegro').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaNotifiche').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [] }
                ],
                "order": [[ 0, "desc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaProdottiStrategica').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [3] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );

    $(document).ready(function() {
        $('#tabellaScadenza').DataTable(
            {
                "columnDefs": [
                    { "orderable": false, "targets": [1] }
                ],
                "order": [[ 0, "asc" ]]
            });
    } );
    

    
    

    
    
    
    
    
    
</script>

<meta charset="utf-8">

<!-- META CREDITO -->
<meta name="author" content="Riccardo Riggi">







