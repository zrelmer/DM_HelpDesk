<?php
    #LLAMAMOS A LA CADENA DE CONEXION
    require_once("../../Config/conexion.php");
    #DESTRUIMOS LA SESION
    session_destroy();
    #Crear una instancia de la clase Conectar y luego llamar al método:
    $conectar = new Conectar();
    header("Location:".$conectar->ruta()."index.php");
    exit();