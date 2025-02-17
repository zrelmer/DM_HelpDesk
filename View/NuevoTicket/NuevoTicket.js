function init() {
    document.querySelector('#ticket_form').addEventListener('submit', function(e) {
        guardar(e);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Configuración de Summernote
    $('#desc_Ticket').summernote({
        placeholder: 'Descripción del ticket',
        tabsize: 2,
        height: 400,
        dialogsInBody: true,
        lang: 'es-ES',
        shortcuts: false,
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function () {
                console.log("Text detect...");
            }
        },
    });

    // Llenar el combobox usando Fetch
    fetch("../../Controller/categoria.php?option=combo")
        .then(response => response.text())
        .then(data => {
            document.querySelector('#id_Categoria').innerHTML = data;
        })
        .catch(error => {
            console.error("Error al cargar categorías:", error);
            swal("Error", "No se pudieron cargar las categorías. Inténtalo nuevamente.", "error");
        });
});

function guardar(e) {
    e.preventDefault();

    if ($('#desc_Ticket').summernote('isEmpty') || $('#tit_Ticket').val().trim() == '') {
        swal("Advertencia", "Los campos Título y Descripción no pueden estar vacíos.", "warning");
        return;
    }

    const form = document.querySelector("#ticket_form");
    const formData = new FormData(form);

    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="ladda-label">Enviando...</span><span class="ladda-spinner"></span>';

    fetch("../../Controller/ticket.php?option=insert", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(datos => {
        document.querySelector("#tit_Ticket").value = '';
        $('#desc_Ticket').val('').summernote('reset');
        swal("Correcto", "Registrado Correctamente", "success");
    })
    .catch(error => {
        swal("Error", "No se pudo registrar el ticket. Inténtalo nuevamente.", "error");
        console.error("Error en la solicitud Fetch:", error);
    })
    .finally(() => {
        submitButton.disabled = false;
        submitButton.innerHTML = '<span class="ladda-label">Enviar Ticket</span><span class="ladda-spinner"></span>';
    });
}

init();