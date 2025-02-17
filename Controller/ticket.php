<?php
# Hacemos uso de la conexión
require_once("../Config/conexion.php");
# Hacemos uso del modelo Ticket
require_once("../Model/Ticket.php");
# Creamos una instancia del modelo Ticket
$ticket = new Ticket();

# Validamos la opción del controlador
if (isset($_GET["option"]) && $_GET["option"] == "insert") {
    try {
        // Verificamos que todas las claves necesarias están en $_POST
        $id_usuario = isset($_POST['id_Usuario']) ? $_POST['id_Usuario'] : null;
        $id_categoria = isset($_POST['id_Categoria']) ? $_POST['id_Categoria'] : null;
        $tit_ticket = isset($_POST['tit_Ticket']) ? $_POST['tit_Ticket'] : null;
        $desc_ticket = isset($_POST['desc_Ticket']) ? $_POST['desc_Ticket'] : '';

        // Validamos que no haya campos obligatorios vacíos antes de insertar
        if ($id_usuario && $id_categoria && $tit_ticket) {
            // Insertamos el ticket en la base de datos
            $ticket->insert_ticket($id_usuario, $id_categoria, $tit_ticket, $desc_ticket);
            echo json_encode(["status" => "success", "message" => "Ticket insertado correctamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios para insertar el ticket."]);
        }
    } catch (Exception $e) {
        error_log("Error en el controlador: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "No se pudo insertar el ticket."]);
    }
}