<?php
class Ticket extends Conectar {

#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- INSERTAMOS UN TICKET ------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
    public function insert_ticket($id_Usuario, $id_Categoria, $tit_Ticket, $desc_Ticket) {
        try {
            // Conexión a la base de datos
            $Conexion = parent::Conexion();
            // Configurar el manejo de caracteres (mayúsculas y minúsculas)
            parent::set_names();
    
            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL InsertarTicket(?, ?, ?, NOW(), ?, 1, 1)";
            $stmt = $Conexion->prepare($sql);
    
            // Vincular parámetros
            $stmt->bindValue(1, $id_Usuario, PDO::PARAM_INT);
            $stmt->bindValue(2, $id_Categoria, PDO::PARAM_INT);
            $stmt->bindValue(3, $tit_Ticket, PDO::PARAM_STR);
            $stmt->bindValue(4, $desc_Ticket, PDO::PARAM_STR);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Retornar el número de filas afectadas
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Capturar y loguear el error
            error_log("Error en insert_ticket: " . $e->getMessage());
            return false;
        } finally {
            // Cerrar la conexión
            $Conexion = null;
        }
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- LISTAMOS LOS TICKETS DE UN USUARIO ----------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
    public function ListarTicketsUsuario($id_Usuario) {
        try {
            // Conexión a la base de datos
            $Conexion = parent::Conexion();
            // Controlamos los inconvenientes con las mayúsculas y minúsculas
            parent::set_names();
            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL ListarTicketsUsuario(?)";
            $stmt = $Conexion->prepare($sql); // Cambio: $sql -> $stmt
            $stmt->bindValue(1, $id_Usuario); // Cambio: $sql -> $stmt
            // Ejecutar la llamada al procedimiento almacenado
            $stmt->execute(); // Cambio: $sql -> $stmt
            // Devolver el número de filas afectadas
            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio: $sql -> $stmt
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            error_log("Error en ListarTicketsUsuario: " . $e->getMessage());
            throw new Exception("Hubo un problema al listar los tickets del usuario.");
        }
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- LISTAMOS TODOS LOS TICKETS DE USUARIOS ------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
    // funcion para listar los tickets
    public function ListarTickets() {
        try {
            // Conexión a la base de datos
            $Conexion = parent::Conexion();
            // Controlamos los inconvenientes con las mayúsculas y minúsculas
            parent::set_names();
            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL ListarTickets()";
            $stmt = $Conexion->prepare($sql); // Cambio: $sql -> $stmt
            // Ejecutar la llamada al procedimiento almacenado
            $stmt->execute(); // Cambio: $sql -> $stmt
            // Devolver el número de filas afectadas
            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio: $sql -> $stmt
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            error_log("Error en ListarTickets: " . $e->getMessage());
            throw new Exception("Hubo un problema al listar los tickets.");
        }
    }
}