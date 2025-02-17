<?php
// echo"Hola Ingresaste a la pagina home";
#HACEMOS USO DE LA CONEXION A LA BASE DE DATOS Y RUTA
require_once("../../Config/conexion.php");
#condicional para saber si el usuario esta logeado
if(isset($_SESSION["Id_Usuario"])){

?>
<!DOCTYPE html>
<html>
	<!-- HACEMOS USO DEL MAIHEAD PARA MOSTRAR EL ENCABEZADO -->
    <?php require_once("../MainHead/head.php"); ?>
	<link href="../../public/img/ric.ico" rel="shortcut icon">
    <title>Home</title>
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
			Blank page.
		</div>
	</div>

	<!-- HACEMOS USO DE LOS ARCHIVOS JS DE LA PAGINA -->
    <?php require_once("../MainJs/Js.php");?>
	<!-- AGREGAMOS EL ARCHIVO JS QUE VA CONTRALAR EL HTML DE HOME -->
	<script type="text/javascript" src="home.js"></script>
</body>
</html>
<?php
// Si no hay una sesion iniciada
}else{
	#Crear una instancia de la clase Conectar y luego llamar al método:
    $conectar = new Conectar();
    header("Location:".$conectar->ruta()."index.php");
}

