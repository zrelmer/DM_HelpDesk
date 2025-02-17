<?php
	if ($_SESSION["Id_Rol"]==1){ 
?>

	<nav class="side-menu">
			<ul class="side-menu-list">

				<li class="green with-sub">
					<a href="../Home/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Inicio</span>
					</a>
				</li>
				<li class="green with-sub">
					<a href="../NuevoTicket/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Nuevo Ticket</span>
					</a>
				</li>

				<li class="green with-sub">
					<a href="../ConsultarTicket/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Consultar Ticket</span>
					</a>
				</li>
			</ul>	
	</nav><!--.side-menu-->

<?php
	}else{
?>
	<nav class="side-menu">
			<ul class="side-menu-list">

				<li class="green with-sub">
					<a href="../Home/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Inicio</span>
					</a>
				</li>
				<li class="green with-sub">
					<a href="../NuevoTicket/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Mantenimiento Usuario</span>
					</a>
				</li>

				<li class="green with-sub">
					<a href="../ConsultarTicket/">
						<i class="font-icon glyphicon glyphicon-th"></i>
						<span class="lbl">Consultar Ticket</span>
					</a>
				</li>
			</ul>	
	</nav><!--.side-menu-->

<?php
	}
?>