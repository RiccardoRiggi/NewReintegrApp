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
            <a href="loginCredenziali.php" class="<?php isAttivo("loginCredenziali.php"); ?><?php isAttivo("loginPasswordDimenticata.php"); ?>">
                <i class="fas fa-key"></i>
                <span class="bottom-nav-label">Credenziali</span>
            </a>
        </li>
        <li>
            <a href="loginQr.php" class="<?php isAttivo("loginQr.php"); ?><?php isAttivo("loginTokenPerso.php"); ?>">
                <i class="fas fa-qrcode"></i>
                <span class="bottom-nav-label">Token cartaceo</span>
            </a>
        </li>
    </ul>
</nav>