<hr class="bg-white">



<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-laptop-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ReintegrApp</div>
    </a>


   

    <!-- Divider -->
    <hr class="sidebar-divider">

    

    <?php
    include '../integration/sidebarInt.php';
    echo generaMenu();
    ?>

 

    


</ul>