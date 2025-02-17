<?php
class Ticket extends Conectar {
    public function insert_ticket($id_Usuario, $id_Categoria, $tit_Ticket, $desc_Ticket) {
        try {
            $Conexion = parent::Conexion();
            parent::set_names();
            $sql = "CALL InsertarTicket(?, ?, ?, NOW(), ?, 1, 1)";
            $sql = $Conexion->prepare($sql);
            $sql->bindValue(1, $id_Usuario);
            $sql->bindValue(2, $id_Categoria);
            $sql->bindValue(3, $tit_Ticket);
            $sql->bindValue(4, $desc_Ticket);
            $sql->execute();
            return $sql->rowCount();
        } catch (Exception $e) {
            error_log("Error en insert_ticket: " . $e->getMessage());
            return false;
        }
    }
}