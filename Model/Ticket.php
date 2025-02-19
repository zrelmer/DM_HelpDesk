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
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- MOSTRAMOS LOS DETALLES DE UN TICKET ---------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
     // funcion para listar los tickets por ticket
     public function MostrarTicketDetalle_ticket($Id_Ticket){
        try {
            // Conexión a la base de datos
            $Conexion = parent::Conexion();
            // Resolvemos los problemas con las mayúsculas y minúsculas
            parent::set_names();
            // Llamamos al procedimiento almacenado
            $sql = "CALL obtener_detalles_ticket(?)";
            $stmt = $Conexion->prepare($sql); // Cambio: $sql -> $stmt
            $stmt->bindValue(1, $Id_Ticket); // Cambio: $sql -> $stmt
            // Ejecutar la llamada al procedimiento almacenado
            $stmt->execute(); // Cambio: $sql -> $stmt
            // Devolver los resultados
            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio: $sql -> $stmt
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            error_log("Error en MostrarTicketDetalle_ticket: " . $e->getMessage());
            throw new Exception("Hubo un problema al obtener los detalles del ticket.");
        }
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- MOSTRAMOS LOS DETALLES DE UN TICKET POR ID --------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
     // funcion para listar los tickets por id
    public function MostrarTicketId($id_ticket) {
        try {
            // Conexion a la BD
            $Conexion = parent::Conexion();
            // Resolvemos los problemas con las mayusculas y minusculas
            parent::set_names();
            // Llamamos al procedimiento almacenado
            $sql = "CALL ObtenerDetalleTicketId(?)";
            $stmt = $Conexion->prepare($sql);
            $stmt->bindValue(1, $id_ticket);
            // Ejecutar la llamada al procedimiento almacenado
            $stmt->execute();
            // Devolver el nÃºmero de filas afectadas
            return $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return $sql->rowCount();
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            error_log("Error en MostrarTicketId: " . $e->getMessage());
            throw new Exception("Hubo un problema al obtener los detalles del ticket.");
        }
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- INSERTAR DETALLE TICKET ---------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
     // funcion para insertar un detalle de un ticket
     public function InsertarDetalleTicket($Id_Ticket, $Id_Usuario, $Desc_Detalle){
        try {
            // ConexiÃ³n a la base de datos
            $Conexion = parent::Conexion();
            // Controlamos los inconvenientes con las mayÃºsculas y minÃºsculas
            parent::set_names();
            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL InsertarDetalleTicket(?, ?, ?, NOW(), 1)";
            $stmt = $Conexion->prepare($sql);
            $stmt->bindValue(1, $Id_Ticket);
            $stmt->bindValue(2, $Id_Usuario);
            $stmt->bindValue(3, $Desc_Detalle);
        
            // Ejecutar la llamada al procedimiento almacenado
            $stmt->execute();
            // Devolver el nÃºmero de filas afectadas
        return $stmt->rowCount();
        } catch (PDOException $e) {
            // Capturar y loguear el error
            error_log("Error en insertar detalle : " . $e->getMessage());
            return false;
        } finally {
            // Cerrar la conexión
            $Conexion = null;
        }
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- ACTUALIZAR TICKET ---------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
public function ActualizarTicket($id_ticket) {
    try {
        // Conexión a la base de datos
        $Conexion = parent::Conexion();
        // Controlamos los inconvenientes con las mayúsculas y minúsculas
        parent::set_names();

        // Preparar la llamada al procedimiento almacenado
        $sql = "CALL UpdateEstatusTicket(?)";
        $stmt = $Conexion->prepare($sql);

        // Verificar si la preparación de la sentencia fue exitosa
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . implode(" ", $Conexion->errorInfo()));
        }

        // Vincular el parámetro
        $stmt->bindValue(1, $id_ticket, PDO::PARAM_INT);

        // Ejecutar la llamada al procedimiento almacenado
        $stmt->execute();

        // Verificar si se afectó alguna fila
        if ($stmt->rowCount() > 0) {
            return true; // Ticket actualizado correctamente
        } else {
            return false; // No se encontró el ticket o no se actualizó
        }
    } catch (Exception $e) {
        // Log del error (opcional)
        error_log("Error en ActualizarTicket: " . $e->getMessage());
        // Retornar false o lanzar una excepción personalizada
        return false;
    }
}
    

}