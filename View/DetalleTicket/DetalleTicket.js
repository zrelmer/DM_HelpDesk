function init() {
    
}
// -----------------------------------------------
// ------------- summernote para ingesar detalles
// -----------------------------------------------

$(document).ready(function() {
    var id = getUrlParameter('Id_Ticket');
//    console.log(id);
    $('#Desc_Detalle').summernote({
        height: 300,
        placeholder: 'Escribe Aquí...',
        dialogsInBody: true,
        lang: 'es-ES',
        callbacks: {
                onImageUpload: function(image) {
                    console.log("Image detect...");
                    myimagetreat(image[0]);
                },
                onPaste: function (e) {
                    console.log("Text detect...");
                }
        }
    });
// -----------------------------------------------
// ------------- Custom keyboard shortcuts--------
// -----------------------------------------------
    // Custom keyboard shortcuts
    $(document).on('keydown', function(e) {
        if (e.ctrlKey && e.key === 'b') {
            document.execCommand('bold');
            e.preventDefault();
        }
        if (e.ctrlKey && e.key === 'i') {
            document.execCommand('italic');
            e.preventDefault();
        }
        if (e.ctrlKey && e.key === 'u') {
            document.execCommand('underline');
            e.preventDefault();
        }
        if (e.ctrlKey && e.key === 'c') {
            navigator.clipboard.writeText(window.getSelection().toString());
            e.preventDefault();
        }
        if (e.ctrlKey && e.key === 'x') {
            navigator.clipboard.writeText(window.getSelection().toString()).then(() => {
                document.execCommand('delete');
            });
            e.preventDefault();
        }
        if (e.ctrlKey && e.key === 'v') {
            navigator.clipboard.readText().then(text => {
                document.execCommand('insertText', false, text);
            });
            e.preventDefault();
        }
        if (e.key === 'Delete') {
            document.execCommand('delete');
            e.preventDefault();
        }
    });
// -----------------------------------------------
// ------------- DESCRIPCION DEL TICKET DE USUARIO
// -----------------------------------------------

    $('#tickd_descripusu').summernote({
        height: 300,
        lang: 'es-ES',
        callbacks: {
                onImageUpload: function(image) {
                    console.log("Image detect...");
                    myimagetreat(image[0]);
                },
                onPaste: function (e) {
                    console.log("Text detect...");
                }
        }
    });
    // SE BLOEUQEA EL CAMPO DE DESCRIPCION
    $('#tickd_descripusu').summernote('disable');



// -----------------------------------------------
// -------------  CONTROLA MOSTRAR DETALLE DEL TICKET
// -----------------------------------------------
fetch('../../Controller/ticket.php?option=MostrarTicketDetalle_ticket', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({ Id_Ticket: id })
})
.then(response => response.text())
.then(data => {
     // console.log(data);
    document.getElementById('lbldetalle').innerHTML = data;
})
.catch(error => console.error('Error:', error));

// -----------------------------------------------
// -------------  CONTROLA MOSTRAR DETALLE DEL TICKET POR ID
// -----------------------------------------------
fetch('../../Controller/ticket.php?option=MostrarTicketId', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({ Id_Ticket: id })
})
// -----------------------------------------------
// Solicitud HTTP y procesamiento de la respuesta JSON:
.then(response => response.json())
.then(data => {
    // console.log(data);
    // Actualización de elementos HTML con los datos recibidos:
    $('#lblestado').html(data.Nom_EstatusTicket);
    if (data.Nom_EstatusTicket === 'Cerrado') {
        $('#pnldetalle').hide();
    }
    $('#lblnomusuario').html(data.Nom_Usuario);
    $('#lblfechcreacion').html(data.Fecha_Creacion);
    // lblnomidticket
    $('#lblnomidticket').html(" Detalle Ticket - " + data.Id_Ticket);
    // cat_nom
    $('#cat_nom').val(data.Nom_Categoria);
    // tick_titulo
    $('#tick_titulo').val(data.Tit_Ticket);
        // tickd_descripusu
    $('#tickd_descripusu').summernote('code', data.Desc_Ticket);
})
.catch(error => console.error('Error:', error));
});
// $('#pnldetalle').hide();


// Definición de la función:
var getUrlParameter = function getUrlParameter(sParam) {
    // Obtención de la cadena de consulta de la URL:
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    // Iteración sobre los parámetros:
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

$(document).on("click","#btnenviar", function() {
    var Id_Ticket = getUrlParameter('Id_Ticket');
    var Id_Usuario = $('#usercli_idx').val();
    var Desc_Detalle = $('#Desc_Detalle').val();
    // CONTROLAMOS QUE EL CAMPO DE DESCRIPCION NO ESTE VACIO -  CONSULTA DE CAMPO VACIO
    if($('#Desc_Detalle').summernote('isEmpty') ){
        swal("Advertencia", "Campo descripción no pueden estar vacio.", "warning");
        // return;
    // SI EL CAMPO CONTIENE DATOS ENTONCES INICA ESTA CONDICION
    }else{
        // Se envía la solicitud Fetch para registrar el detalle del ticket:
        fetch('../../Controller/ticket.php?option=InsertarDetalleTicket', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ Id_Ticket: Id_Ticket, Id_Usuario: Id_Usuario, Desc_Detalle: Desc_Detalle })
        })
        // SI LA SOLICITUD FALLA ENTONCES MUESTRA UN ERROR
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la respuesta: ${response.statusText}`);
            }
            return response.text();
        })
        // AL ENVIARSE LA CONSULTA SE LIMPIA LOS DATOS DEL SUMMERNOTE
        .then(data => {
            // Limpia los campos y muestra la alerta de éxito
            $('#Desc_Detalle').val('').summernote('reset'); // Limpiar Summernote
            swal("Correcto", "Registrado Correctamente", "success");
    
            // Actualiza el detalle del ticket sin refrescar la página
            fetch('../../Controller/ticket.php?option=MostrarTicketDetalle_ticket', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ Id_Ticket: Id_Ticket })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('lbldetalle').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        })
        .catch(error => {
            swal("Error", "No se pudo registrar el ticket. Inténtalo nuevamente.", "error");
            console.error("Error en la solicitud Fetch:", error);
        });
    }
    
});

$(document).on("click", "#btncerrarticket", function() {
    swal({
            title: "GNA Support",
            text: "¿Desea cerrar el ticket?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Cerrar Ticket",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                var Id_Ticket = getUrlParameter('Id_Ticket');
                fetch('../../Controller/ticket.php?option=ActualizarTicket', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ Id_Ticket: Id_Ticket })
                })
                .then(response => response.json()) // Parsea la respuesta como JSON
                .then(data => {
                    if (data.status === "success") {
                        swal({
                            title: "Correcto",
                            text: "Ticket cerrado correctamente",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });

                        // Ocultar el panel de detalle
                        $('#pnldetalle').hide();

                        // Actualizar el estado del ticket en la interfaz
                        $('#lblestado').html("Cerrado"); // Cambia el estado a "Cerrado"
                    } else {
                        swal("Error", data.message, "error");
                    }
                })
                .catch(error => {
                    swal("Error", "No se pudo cerrar el ticket. Inténtalo nuevamente.", "error");
                    console.error("Error en la solicitud Fetch:", error);
                });
            } else {
                swal({
                    title: "Cancelado",
                    text: "No se cerró el ticket",
                    type: "error",
                    confirmButtonClass: "btn-danger"
                });
            }
        });
});


init();