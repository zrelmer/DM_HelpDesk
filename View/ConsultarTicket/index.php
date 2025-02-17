<?php
#HACEMOS USO DE LA CONEXION A LA BASE DE DATOS Y RUTA
require_once("../../Config/conexion.php");
#condicional para saber si el usuario esta logeado
if(isset($_SESSION["Id_Usuario"])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HACEMOS USO DEL MAIHEAD PARA MOSTRAR EL ENCABEZADO -->
    <?php require_once("../MainHead/head.php"); ?>
    <link href="../../public/img/ric.png" rel="shortcut icon">
    <title>Consultar Ticket</title>
</head>
<body class="with-side-menu">
    <!-- HACEMOS USO DEL FOLDER DEL MAINHEDER PARA MOSTRAL EL HEADER -->
	<?php require_once("../MainHeader/header.php"); ?>
    <div class="mobile-menu-left-overlay"></div>

<!-- HACEMOS USO DEL FORDER MAIN NAVA MUESTRA EL NAVEGADOR -->
<?php require_once("../MainNav/nav.php")?>
    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Consultar Ticket</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../Home/">Inicio</a></li>
                                <li class="active">Consultar Ticket</li>
                            </ol>
                        </div><!--tbl-cell -->
                    </div><!--tbl-row -->
                </div><!--tbl -->
            </header><!--section-header -->
            <div class="box-typical box-typical-padding">
                <!--Tabla de los tickets -->
                <table id="ticket_datos" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <!--Cabecera de la tabla -->
                    <thead>
                        <!--Cabecera de la tabla -->
                        <tr>
                            <th style="width: 5%;">No. Ticket</th>
                            <th style="width: 10%;">Categoría</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Título</th>
                            <th style="width: 5%;">Estatus</th>
                            <th style="width: 5%;">Fecha Creacion</th>
                            <th class="text-center" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- EN ESTE APARTADO DE LLANARAN LOS DATOS DE LA TABLAS DESDE JS-->
                    </tbody>
                </table><!--ticket_datos-->
            </div><!--box-typical box-typical-padding -->
        </div><!--container-fluid -->
    </div><!--page-content -->
    <!-- HACEMOS USO DE LOS ARCHIVOS JS DE LA PAGINA -->
    <?php require_once("../MainJs/Js.php");?>
	<!-- AGREGAMOS EL ARCHIVO JS QUE VA CONTRALAR EL HTML DE HOME -->
	<script type="text/javascript" src="consultarTicket.js"></script>
</body>
</html>

<?php
// Si no hay una sesion iniciada se redirecciona al index
}else {
    #Crear una instancia de la clase Conectar y luego llamar al método:
    $conectar = new Conectar();
    header("Location:".$conectar->ruta()."index.php");
}