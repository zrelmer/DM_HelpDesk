<?php
    #HACEMOS USO DE LA CONEXION
    require_once("../Config/conexion.php");
    #HACEMOS USO DEL MODELO CATEGORIA
    require_once("../Model/Categoria.php");
    #CREAMOS UNA INSTANICA DEL MODELO CATEGORIA
    $categoria = new Categoria();

    if ($_GET["option"] == "combo") {
        // LO QUE DEVUELVE GET CATEGORIA LO ALMACENARA EN LA VARIABLE DATOS
        $datos = $categoria->get_categoria();
        #COMPROBAOS QUE ESA VARIABLE SE UN ARREGLEO Y QUE SEA MAYOR A CERO
        if (is_array($datos)== true and count($datos)>0) {
            #DECLARAMOS UN HTML
            $html = "";
            foreach ($datos as $i => $dato) {
                $html .= "<option value='".$dato['Id_Categoria']."'>".$dato['Nom_Categoria']."</option>";
            }
            echo $html;
        }
    }