<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../../public/img/images.jpeg" alt="">
	            <img class="hidden-lg-up" src="../../public/img/ric.jpg" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>

	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="../../public/img/empresario.png" alt="">
								<span class="lblclientenomx"><?php echo $_SESSION["User_Nom"]?></span>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <!-- <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a> -->
	                            <!-- <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Configuración</a> -->
								
	                            <!-- <div class="dropdown-divider">
								</div> -->
	                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesión</a>
	                        </div>
	                    </div>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>

                    <input type="hidden" id="usercli_idx" value="<?php echo $_SESSION["Id_Usuario"]?>">

					<input type="hidden" id="rol_idx" value="<?php echo $_SESSION["Id_Rol"]?>">               

                    <div class="dropdown dropdown-typical">
                        <a href="#" class="green with-sub dropdown-toggle no-arr">
                            <!-- <span class="font-icon font-icon-user"></span> -->
                            <!-- <span class="lblclientenomx"><?php echo $_SESSION["User_Nom"]?></span> -->
                        </a>
                    </div>


                    <!-- <div class="dropdown dropdown-typical">
                        <a href="#" class="dropdown-toggle no-arr">
                            <span class="font-icon font-icon-user"></span>
                           
                        </a>
                    </div> -->

                    <!-- <div class="dropdown dropdown-typical">
                        <a href="#" class="dropdown-toggle no-arr">
                            <span class="font-icon font-icon-contacts"></span>
                            
                        </a>
                    </div> -->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
</header><!--.site-header-->