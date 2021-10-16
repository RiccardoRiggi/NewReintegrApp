<?php 
    function isAttivo($nomePagina){
        if(strpos($_SERVER['PHP_SELF'],$nomePagina)){
            echo "active";
        }else{
            echo "";
        }
    }
?>


<div class="pt-5 pb-4"></div>
<nav class="bottom-nav">
    <ul>
        <li>
            <a href="selezionaVeicolo.php" class="<?php isAttivo("selezionaVeicolo.php"); ?><?php isAttivo("selezionaProdotto.php"); ?><?php isAttivo("selezionaQuantita.php"); ?>">
                <i class="fas fa-hand-holding-medical"></i>
                <span class="bottom-nav-label">Reintegra<br>Un Mezzo</span>
            </a>
        </li>
        <li>
            <a href="scriviMessaggio.php" class="<?php isAttivo("scriviMessaggio.php"); ?>">
                <i class="fas fa-envelope"></i>
                <span class="bottom-nav-label">Invia Un<br>Messaggio</span>
            </a>
        </li>
        <li>
            <a href="logout.php" class="<?php isAttivo("logout.php"); ?>">
                <i class="fas fa-sign-out-alt"></i>
                <span class="bottom-nav-label">Effettua<br>Il Logout</span>
            </a>
        </li>
    </ul>
</nav>