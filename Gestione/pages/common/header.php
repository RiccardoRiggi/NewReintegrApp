<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="listaNotifiche.php" id="alertsDropdown">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="numeroNotifiche">0</span>
            </a>

        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="listaMessaggi.php">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter" id="numeroMessaggi">0</span>
            </a>

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="modificaUtente.php?id=<?php echo $_SESSION["utente_id"]; ?>" id="userDropdown">
                <span class="text-secondary">Bentornato <?php echo $_SESSION["operatore"]; ?>!</span>

            </a>

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="lockscreen.php">
                <i class="fas fa-user-lock fa-fw text-danger"></i> <span class="pl-1 text-secondary">Blocca</span>
                <!-- Counter - Messages -->
            </a>

        </li>


        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="logout.php">
                <i class="fas fa-sign-out-alt fa-fw text-danger"></i> <span class="pl-1 text-secondary">Logout</span>
            </a>

        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<script>
    var xhttp = new XMLHttpRequest();
    var xhttpTwo = new XMLHttpRequest();
    var lockScreen = new XMLHttpRequest();
    aggiornaNumeri();

    setInterval(function() {

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != document.getElementById("numeroMessaggi").innerHTML) {
                    document.getElementById("bottoneNuovoMessaggioDalServizio").click();
                    document.getElementById("numeroMessaggi").innerHTML = this.responseText;
                }
            }
        };
        xhttp.open("GET", "../api/messaggi.php", true);
        xhttp.send();

        xhttpTwo.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != document.getElementById("numeroNotifiche").innerHTML) {
                    document.getElementById("bottoneNuovaNotificaDalServizio").click();
                    document.getElementById("numeroNotifiche").innerHTML = this.responseText;
                }

            }
        };
        xhttpTwo.open("GET", "../api/notifiche.php", true);
        xhttpTwo.send();

        lockScreen.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "KO") {
                    window.location.replace("lockscreen.php");
                }
            }
        };
        lockScreen.open("GET", "../api/lock.php", true);
        lockScreen.send();
    }, 10000);

    function aggiornaNumeri() {
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != document.getElementById("numeroMessaggi").innerHTML) {
                    document.getElementById("numeroMessaggi").innerHTML = this.responseText;
                }
            }
        };
        xhttp.open("GET", "../api/messaggi.php", true);
        xhttp.send();

        xhttpTwo.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != document.getElementById("numeroNotifiche").innerHTML) {
                    document.getElementById("numeroNotifiche").innerHTML = this.responseText;
                }

            }
        };
        xhttpTwo.open("GET", "../api/notifiche.php", true);
        xhttpTwo.send();
    }
</script>


<?php include 'alert.php'; ?>