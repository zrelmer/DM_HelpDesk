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

#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- MOSTRAMOS LOS DETALLES DE UN TICKET ---------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------    
}elseif (isset($_GET["option"]) && $_GET["option"] == "MostrarTicketDetalle_ticket") {
    $datos = $ticket->MostrarTicketDetalle_ticket($_POST['Id_Ticket']);
    ?>
        <?php
            foreach ($datos as $row) {
                ?>
                <article class="activity-line-item box-typical">
                    <div class="activity-line-date">
                        <!-- <?php echo $row["Fecha_Creacion"]; ?> -->
                        <?php echo date("d/m/Y", strtotime($row["Fecha_Creacion"]));?>
                    </div>
                    <header class="activity-line-item-header">
                        <div class="activity-line-item-user">
                            <div class="activity-line-item-user-photo">
                                <a href="#">
                                    <img src="../../public/img/photo-64-1.jpg" alt="">
                                </a>
                            </div>
                            <div class="activity-line-item-user-name"> <?php echo $row["Nom_Usuario"].' '.$row["Ape_Usuario"]; ?> </div>
                            <div class="activity-line-item-user-status">
                                <?php
                                    if (isset($row['Id_Rol'])) {
                                        if ($row['Id_Rol'] == 1) {
                                            echo 'Usuario';
                                        } else {
                                            echo 'Tecnico';
                                        }
                                    } else {
                                        echo 'Role not defined';
                                    }
                                ?>
                            </div>
                        </div>
                    </header>
                    <div class="activity-line-action-list">
                        <section class="activity-line-action">
                            <div class="time">
                                <!-- <?php echo $row["Fecha_Creacion"]; ?> -->
                                <?php echo date("H:i:s", strtotime($row["Fecha_Creacion"]));?>
                            </div>
                            <div class="cont">
                                <div class="cont-in">
                                    <p> 
                                        <?php echo $row["Desc_Detalle"];?>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            <?php
        }
    ?>
<?php
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- MOSTRAMOS LOS DETALLES DE UN TICKET x ID ----------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
}elseif(isset($_GET["option"]) && $_GET["option"] == "MostrarTicketId"){ 
    $datos = $ticket->MostrarTicketId($_POST['Id_Ticket']);
    if (is_array($datos) && count($datos) > 0) {
        foreach($datos as $row){
            $output["Id_Ticket"] = $row["Id_Ticket"];
            $output["Id_Usuario"] = $row["Id_Usuario"];
            $output["Nom_Categoria"] = $row["Nom_Categoria"];
            $output["Tit_Ticket"] = $row["Tit_Ticket"];
            $output["Desc_Ticket"] = $row["Desc_Ticket"];
    
            if ($row["Nom_EstatusTicket"] == "Abierto") {
                $output["Nom_EstatusTicket"] = '<span class="label label-pill label-success">Abierto</span>';
            } elseif ($row["Nom_EstatusTicket"] == "En Proceso") {
                $output["Nom_EstatusTicket"] = '<span class="label label-pill label-warning">En Proceso</span>';
            } else {
                $output["Nom_EstatusTicket"] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
    
            $output["tick_estado_texto"] = $row["Est_Ticket"];
            $output["Fecha_Creacion"] = date("d/m/Y H:i:s", strtotime($row["Fecha_Creacion"]));
            $output["Nom_Usuario"] = $row["Nom_Usuario"];
            $output["Ape_Usuario"] = $row["Ape_Usuario"];
            $output["Nom_Categoria"] = $row["Nom_Categoria"];
        }
        echo json_encode($output);
    }
#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- INSERTA DETALLE DE TICKET  ----------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------
}elseif(isset($_GET["option"]) && $_GET["option"] == "InsertarDetalleTicket"){
    $Id_Ticket = isset($_POST['Id_Ticket']) ? $_POST['Id_Ticket'] : null;
    $Id_Usuario = isset($_POST['Id_Usuario']) ? $_POST['Id_Usuario'] : null;
    $Desc_Detalle = isset($_POST['Desc_Detalle']) ? $_POST['Desc_Detalle'] : '';
    $ticket->InsertarDetalleTicket($Id_Ticket, $Id_Usuario, $Desc_Detalle);

#--------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------- CERRAR TICKET  ------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------------------------------------------

// }elseif(isset($_GET["option"]) && $_GET["option"] == "ActualizarTicket"){ # CONTROLADOR PARA ACTUALIZAR TICKET
//     $id_ticket = isset($_POST['Id_Ticket']) ? $_POST['Id_Ticket'] : null;
//     $ticket->ActualizarTicket($id_ticket);
}elseif (isset($_GET["option"]) && $_GET["option"] == "ActualizarTicket") {
    try {
        // Obtener el ID del ticket desde POST
        $id_ticket = isset($_POST['Id_Ticket']) ? $_POST['Id_Ticket'] : null;

        // Validar que el ID del ticket no sea nulo
        if (!$id_ticket) {
            echo json_encode(["status" => "error", "message" => "ID del ticket no proporcionado."]);
            exit;
        }

        // Llamar al método para actualizar el ticket
        $ticket = new Ticket();
        $resultado = $ticket->ActualizarTicket($id_ticket);

        // Retornar una respuesta JSON
        if ($resultado) {
            echo json_encode(["status" => "success", "message" => "Ticket cerrado correctamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo cerrar el ticket."]);
        }
    } catch (Exception $e) {
        // Log del error (opcional)
        error_log("Error en el controlador ActualizarTicket: " . $e->getMessage());
        // Retornar un mensaje de error
        echo json_encode(["status" => "error", "message" => "Ocurrió un error al cerrar el ticket."]);
    }
}