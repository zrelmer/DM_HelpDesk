<?php
    require_once("config/conexion.php");
    if(isset($_POST["enviar"]) and $_POST["enviar"]=='si'){
        require_once("Model/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>

<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Servicio de Soporte</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="./public/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144"> -->
	<!-- <link href="./public/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114"> -->
	<!-- <link href="./public/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72"> -->
	<!-- <link href="./public/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png"> -->
	<!-- <link href="./public/img/favicon.png" rel="icon" type="image/png"> -->
	<link href="./public/img/ric.png" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="./public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="./public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="./public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <!-- INICIO DE FORMULARIOR -->
                <form class="sign-box" actiom="" method="post" id="login_form">
                    <!-- CONTROLAMOS EL ROL DE USUARIO  -->
                    <input type="hidden" id="Id_Rol" name="Id_Rol" value="1">
                    <div class="sign-avatar">
                        <img src="./public/img/ric.jpg" alt="">
                    </div>
                    <header class="sign-title" id="lbltitulo" >Sesion Usuario</header>

                    <?php
                        if(isset($_GET['m'])){
                            switch($_GET['m']){
                                case "1";
                                ?>
                                    <!-- CREAMOS UNA ALERTA -->
                                    <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <i class="font-icon font-icon-warning"></i>
                                        El Usuario y/o Contraseña son Incorrectos
						            </div>
                                <?php
                                break;

                                case "2";
                                ?>

                                    <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <i class="font-icon font-icon-warning"></i>
                                            Los campos estan vacios
						            </div>
                                <?php
                                break;
                            }
                        }
                    ?>

                    <div class="form-group">
                        <!-- <input type="text" id="Email_Usuario" name="Email_Usuario" class="form-control" placeholder="Correo o Usuario"/> -->
                        <input type="text" id="User_Nom" name="User_Nom" class="form-control" placeholder="Nombre Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="Pass_Usuario" name="Pass_Usuario" class="form-control" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <!-- <div class="checkbox float-left">
                            <input type="checkbox" id="signed-in"/>
                            <label for="signed-in">Mantenme registrado</label>
                        </div> -->
                        <div class="float-right reset">
                            <a href="reset-password.html">Olvide Contraseña</a>
                        </div>
                        <div class="float-left reset">
                            <a href="#" id="btnti" >Iniciar como TI</a>
                        </div>
                    </div>

                    <input type="hidden" name="enviar" class="from-control" value="si">
                    <button type="submit" class="btn btn-rounded">Iniciar Sesion</button>
                    <p class="sign-note">Nuevo Usuario? <a href="sign-up.html">Crear Cuenta</a></p>
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
            </div>
        </div>
    </div><!--.page-center-->


<script src="./public/js/lib/jquery/jquery.min.js"></script>
<script src="./public/js/lib/tether/tether.min.js"></script>
<script src="./public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="./public/js/plugins.js"></script>
<script type="text/javascript" src="./public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="./public/js/app.js"></script>
<script type="text/javascript" src="index.js" ></script>
</body>
</html>