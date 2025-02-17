function init(){
}

$(document).ready(function() {

});

$(document).on("click", "#btnti", function () {
    if ($('#Id_Rol').val()==1) {
        $('#lbltitulo').html("Acceso TI");
        $('#btnti').html("Iniciar como usuario");
        $('#Id_Rol').val(2);
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnti').html("Iniciar como TI");
        $('#Id_Rol').val(1);
    }


   
    
    // if ($('#rol_id').val()==1){
    //     $('#lbltitulo').html("Acceso Soporte");
    //     $('#btnti').html("Acceso Usuario");
    //     $('#rol_id').val(2);
    //     $("#imgtipo").attr("src","public/2.jpg");
    // }else{
    //     $('#lbltitulo').html("Acceso Usuario");
    //     $('#btnsoporte').html("Acceso Soporte");
    //     $('#rol_id').val(1);
    //     $("#imgtipo").attr("src","public/1.jpg");
    // }
});

init();