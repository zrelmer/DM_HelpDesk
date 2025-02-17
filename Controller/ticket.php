<?php
# Hacemos uso de la conexión
require_once("../Config/conexion.php");
# Hacemos uso del modelo Ticket
require_once("../Model/Ticket.php");
# Creamos una instancia del modelo Ticket
$ticket = new Ticket();
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- INSERTAMOS UN TICKET ------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
# Validamos la opción del controlador
if (isset($_GET["option"]) && $_GET["option"] == "insert") {
    try {
        // Verificamos que todas las claves necesarias están en $_POST
        $id_usuario = $_POST['id_Usuario'];
        $id_categoria = $_POST['id_Categoria'];
        $tit_ticket = $_POST['tit_Ticket'];
        $desc_ticket = $_POST['desc_Ticket'] ?? ''; // Si no está presente, se asigna una cadena vacía

        // Validamos que no haya campos obligatorios vacíos antes de insertar
        if (!empty($id_usuario) && !empty($id_categoria) && !empty($tit_ticket)) {
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
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- LISTAMOS LOS TICKETS DE UN USUARIO ----------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
}elseif (isset($_GET["option"]) && $_GET["option"] == "ListarTicketsUsuario") {
    // Verificar si el parámetro está presente
    if (isset($_POST['id_Usuario']) && !empty($_POST['id_Usuario'])) {
        $id_usuario = $_POST['id_Usuario'];
        # Llamamos a la función ListarTicketsUsuario
        try {
            // Obtener los datos del usuario
            $datos = $ticket->ListarTicketsUsuario($id_usuario);
            $data = [];
            # Recorremos los datos obtenidos
            foreach ($datos as $row) {
                $sub_array = [];
                $sub_array[] = $row["Id_Ticket"];
                $sub_array[] = $row["Nom_Categoria"];
                $sub_array[] = $row["Tit_Ticket"];
                # controlamos los estados del ticket
                if ($row["Nom_EstatusTicket"]=="Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }elseif($row["Nom_EstatusTicket"]=="En Proceso"){
                    // $sub_array[] = '<span class="label label-pill label-primary">En Proceso</span>';
                    $sub_array[] = '<span class="label label-pill label-warning">En Proceso</span>';
                    
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                }
                $sub_array[] = $row["Fecha_Creacion"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["Id_Ticket"].');" id="'.$row["Id_Ticket"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-eye"></i></div></button>';
                $data[] = $sub_array;
            }
            # Mostramos los datos obtenidos
            $results = [
                "aEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            ];
            echo json_encode($results);
        # Capturar y manejar errores
        } catch (Exception $e) {
            // Capturar y manejar errores
            error_log("Error en ListarTicketsUsuario: " . $e->getMessage());
            echo json_encode(["error" => "Hubo un problema al listar los tickets del usuario."]);
        }
    } else {
        // Respuesta en caso de que falte el parámetro
        echo json_encode(["error" => "El parámetro id_Usuario es obligatorio."]);
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- LISTAMOS TODOS LOS TICKETS DE USUARIOS ------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------

}elseif (isset($_GET["option"]) && $_GET["option"] == "ListarTickets") {
    $datos = $ticket->ListarTickets();
    $data = [];
    
    foreach ($datos as $row) {
        $sub_array = [];
        $sub_array[] = $row["Id_Ticket"];
        $sub_array[] = $row["Nom_Categoria"];
        $sub_array[] = $row["Tit_Ticket"];
        if ($row["Nom_EstatusTicket"]=="Abierto"){
            $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
        }elseif($row["Nom_EstatusTicket"]=="En Proceso"){
            // $sub_array[] = '<span class="label label-pill label-primary">En Proceso</span>';
            $sub_array[] = '<span class="label label-pill label-warning">En Proceso</span>';
            
        }else{
            $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
        }
        // $sub_array[] = $row["Nom_EstatusTicket"];
        $sub_array[] = $row["Fecha_Creacion"];
        $sub_array[] = '<button type="button" onClick="ver('.$row["Id_Ticket"].');" id="'.$row["Id_Ticket"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-eye"></i></div></button>';
        $data[] = $sub_array;
    }
    
    $results = [
        "aEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    ];
    echo json_encode($results);
}