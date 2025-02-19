// VARIABLES GLOBALES
var tabla = null; // Variable global para la instancia de DataTables
var id_usuario = $('#usercli_idx').val(); // ID del usuario logueado
var id_rol = $('#rol_idx').val(); // Rol del usuario logueado

// Configuración de DataTables
const dataTableOptions = {
    dom: 'Bfrtip',
    searching: true,
    lengthChange: false,
    colReorder: true,
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    responsive: true,
    bInfo: true,
    iDisplayLength: 10,
    autoWidth: false,
    language: {
        sProcessing: "Procesado...",
        sLengthMenu: "Mostrar _MENU_ registrados",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registrados)",
        sSearch: "Buscar",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": activar para ordenar la columna de manera ascendente",
            sSortDescending: ": activar para ordenar la columna de manera descendente"
        }
    },
    columns: [
        { title: "ID" },
        { title: "Categoría" },
        { title: "Título" },
        { title: "Estatus" },
        { title: "Fecha Creación" },
        { title: "Acciones" }
    ]
};

// Función para construir la URL y el cuerpo de la solicitud
function getRequestConfig() {
    const isClient = id_rol == 1;
    const url = isClient
        ? "../../Controller/ticket.php?option=ListarTicketsUsuario"
        : "../../Controller/ticket.php?option=ListarTickets";
    const body = isClient
        ? new URLSearchParams({ id_Usuario: id_usuario })
        : null;

    return { url, body };
}

// Función para inicializar la tabla
function inicializarTabla() {
    return $('#ticket_datos').DataTable(dataTableOptions);
}

// Función para cargar los datos
async function cargarDatos() {
    const { url, body } = getRequestConfig();

    try {
        const response = await fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: body
        });

        if (!response.ok) throw new Error(`Error en la solicitud: ${response.statusText}`);

        const data = await response.json();

        if (data.aaData && data.aaData.length > 0) {
            tabla.clear().rows.add(data.aaData).draw();
        } else {
            console.log("No hay datos disponibles");
            tabla.clear().draw();
        }
    } catch (error) {
        console.error("Error al cargar los datos:", error);
        alert("Hubo un problema al cargar los datos. Por favor, inténtalo de nuevo.");
    }
}

// Función para ver detalles del ticket
function ver(Id_Ticket) {
    window.open(`http://localhost:80/DM_HelpDesk/View/DetalleTicket/index.php?Id_Ticket=${Id_Ticket}`, '_blank');
}

// Inicialización
$(document).ready(function () {
    tabla = inicializarTabla();
    cargarDatos();
});