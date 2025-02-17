<?php
#HACEMOS USO DE LA CONEXION A LA BASE DE DATOS Y RUTA
require_once("../../Config/conexion.php");
#condicional para saber si el usuario esta logeado
if(isset($_SESSION["Id_Usuario"])){

?>
<!DOCTYPE html>
<html>
	<!-- HACEMOS USO DEL MAIHEAD PARA MOSTRAR EL ENCABEZADO -->
    <?php require_once("../MainHead/head.php"); ?>
	<link href="../../public/img/ric.png" rel="shortcut icon">
    <title>Nuevo Ticket</title>
</head>
<body class="with-side-menu">
	<!-- HACEMOS USO DEL FOLDER DEL MAINHEDER PARA MOSTRAL EL HEADER -->
	<?php require_once("../MainHeader/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>
	
	<!-- HACEMOS USO DEL FORDER MAIN NAVA MUESTRA EL NAVEGADOR -->
	<?php require_once("../MainNav/nav.php")?>

	<!-- CONTENIDO DE LA PAGINA -->
	<div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Nuevo Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="../Home/">Inicio</a></li>
								<li class="active">Nuevo Ticket</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">

			<!-- <div class="alert alert-blue-dirty alert-fill alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<smile>En esta ventana, puedes crear un nuevo ticket para reportar un problema o hacer una consulta. Por favor, completa todos los campos.</smile>
			</div> -->
				<p>
					 
				</p>

				<h5 class="m-t-lg with-border">Generar Ticket</h5>

				<form method="post" id="ticket_form">

					<input type="hidden" id="id_Usuario" name="id_Usuario" value="<?php echo $_SESSION["Id_Usuario"]?>">


					<div class="form-group row">
						<label class="col-sm-2 form-label semiblod" for="id_Categoria">Categoria:</label>
						<div class="col-sm-10">
							<select id="id_Categoria" name="id_Categoria" class="form-control">
								
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-label semiblod" for="tit_Ticket">Titulo:</label>
						<div class="col-sm-10">
							<input type="text" id="tit_Ticket" name="tit_Ticket" enable class="form-control" id="inputPassword">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-label semiblod" for="desc_Ticket">Descripción:</label>
						<div class="col-sm-10">
							<div class="summernote-theme-3 " class="summernote" placeholder="first placeholder">
								<textarea id="desc_Ticket" name="desc_Ticket" class="summernote"></textarea>
							</div>
						</div>
					</div>
					<button type="submit" name="action" value="add" class="btn btn-inline btn-primary ladda-button" data-style="expand-left"><span class="ladda-label">Enviar Ticket</span><span class="ladda-spinner"></span></button>
				</form>
			</div>
		</div>
	</div>

	

	<!-- HACEMOS USO DE LOS ARCHIVOS JS DE LA PAGINA -->
    <?php require_once("../MainJs/Js.php");?>
	<!-- AGREGAMOS EL ARCHIVO JS QUE VA CONTRALAR EL HTML DE HOME -->
	<script type="text/javascript" src="nuevoTicket.js"></script>
</body>
</html>
<?php
// Si no hay una sesion iniciada
}else{
	#Crear una instancia de la clase Conectar y luego llamar al método:
    $conectar = new Conectar();
    header("Location:".$conectar->ruta()."index.php");
}
