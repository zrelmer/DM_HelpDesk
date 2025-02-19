<?php
#HACEMOS USO DE LA CONEXION A LA BASE DE DATOS Y RUTA
require_once("../../Config/conexion.php");
#condicional para saber si el usuario esta logeado
if(isset($_SESSION["Id_Usuario"])){

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HACEMOS USO DEL MAIHEAD PARA MOSTRAR EL ENCABEZADO -->
    <?php require_once("../MainHead/head.php"); ?>
    <link href="../../public/img/ric.png" rel="shortcut icon">
    <title>Detalle Ticket</title>
</head>
<body class="with-side-menu">
    <!-- HACEMOS USO DEL FOLDER DEL MAINHEDER PARA MOSTRAL EL HEADER -->
	<?php require_once("../MainHeader/header.php"); ?>

    <div class="mobile-menu-left-overlay"></div>

    <!-- HACEMOS USO DEL FORDER MAIN NAVA MUESTRA EL NAVEGADOR -->
    <?php require_once("../MainNav/nav.php")?>

    <!-- Contenido de la pagina -->
    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3 id="lblnomidticket"></h3>
                        <!-- <div id="lblestado">Abierto</div> -->
                        <span  id="lblestado"></span>
                        <span class="label label-pill label-primary" id="lblnomusuario"></span>
                        <span class="label label-pill label-default"  id="lblfechcreacion"></span>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="#">Home</a></li>
                            <li class="active">Detalle Ticket</li>
                        </ol><!--.breadcrumb-->
                    </div><!--.tbl-cell-->
                </div><!--.tbl-row-->
          </div><!--.tbl-->
            </header><!--.section-header-->
            <div class="box-typical box-typical-padding">
                <div class="row">
                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="cat_nom">Categoria</label>
                            <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                        </fieldset><!--.form-group-->
                    </div><!--.col-lg-6-->

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="tick_titulo">Titulo</label>
                            <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                        </fieldset>
                    </div><!--.col-lg-6-->

                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="tickd_descripusu">Descripción</label>
                            <div class="summernote-theme-1">
                                <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                            </div><!--.summernote-theme-1-->
                        </fieldset>
                    </div><!--.col-lg-12-->
                </div><!--.row-->
            </div><!--.box-typical-->
            <section class="activity-line" id="lbldetalle"></section><!--.activity-line-->
            <div class="box-typical box-typical-padding" id="pnldetalle">
                <p>Ingrese su duda o Consulta</p>
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="Desc_Detalle">Descripción</label>
                            <div class="summernote-theme-1">
                                <textarea id="Desc_Detalle" name="Desc_Detalle" class="summernote" name="name"></textarea>
                            </div><!--.summernote-theme-1-->
                        </fieldset><!--.form-group-->
                    </div><!--.col-lg-12-->
                    <div class="col-lg-12">
                        <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                        <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerrar Ticket</button>
                    </div>
                </div><!--.row-->
            </div><!--.box-typical-->
        </div><!--.container-fluid-->
    </div><!--.page-content-->
    <!-- HACEMOS USO DE LOS ARCHIVOS JS DE LA PAGINA -->
    <?php require_once("../MainJs/Js.php");?>
	<!-- AGREGAMOS EL ARCHIVO JS QUE VA CONTRALAR EL HTML DE HOME -->
	<script type="text/javascript" src="DetalleTicket.js"></script>

</body>
</html>
<?php
// Si no hay una sesion iniciada
}else{
	#Crear una instancia de la clase Conectar y luego llamar al método:
    $conectar = new Conectar();
    header("Location:".$conectar->ruta()."index.php");
}