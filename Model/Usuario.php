<?php 
    #DEFINE LA CLASES USUARIO Y HEREDA LA CLASE CONECTAR DE conexion.php
    class Usuario extends Conectar{
        #CREAMOS UN METODO LLAMDO LOGIN PARA INICIO DE SESION
        public function Login(){
            $conectar=parent::Conexion();
            parent::set_names();
            #VERIFICA EL ENVIO DE FORMULARIO 
            if(isset($_POST["enviar"])){
                #OBTENCION DE LOS DATOS DEL FORMULARIO
                $usuario = isset($_POST["User_Nom"]) ? $_POST["User_Nom"] : null;
                $pass = isset($_POST["Pass_Usuario"]) ? $_POST["Pass_Usuario"] : null;
                $rol = isset($_POST["Id_Rol"]) ? $_POST["Id_Rol"] : null;
                #VALIDACION DE CAMPOS VACIOS
                if (empty($usuario) and empty($rol) and empty($pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql = "CALL verificar_usuario(?, ?, ?)";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usuario);
                    $stmt->bindValue(2,$pass);
                    $stmt->bindValue(3,$rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array( $resultado ) and count($resultado)> 0){
                        $_SESSION["Id_Usuario"] = $resultado["Id_Usuario"];
                        $_SESSION["Nom_Usuario"] = $resultado["Nom_Usuario"];
                        $_SESSION["Ape_Usuario"] = $resultado["Ape_Usuario"];
                        $_SESSION["User_Nom"] = $resultado["User_Nom"];
                        $_SESSION["Id_Rol"] = $resultado["Id_Rol"];
                        header("Location:".Conectar::ruta()."View/Home");
                    }else {
                        header("Location:".Conectar::ruta()."index.php?m=1");
                    }
                }
            }

        }
    }