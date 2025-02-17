<?php
    class Categoria extends Conectar{

        public function get_categoria(){
            // Llamar de conexión de la clase Conectar
            $Conexion = parent::Conexion();
            // Controlar los inconvenientes con las mayúsculas y minúsculas
            parent::set_names();
            // Llamar al procedimiento almacenado para listar las categorías activas
            $sql = "CALL ListarCategoriasActivas()";
            // Conectar y preparar el SQL
            $sql = $Conexion->prepare($sql);
            // Ejecutar el SQL
            $sql->execute();
            // Retornar lo que nos devuelve la consulta en una variable resultado
            return $resultado = $sql->fetchAll();
        }
    }
?>
