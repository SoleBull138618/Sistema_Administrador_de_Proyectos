let form_data = new FormData();
form_data.append('opc','info_tabla_proyectos');

$.ajax({
    type: 'POST',
    url: '../php/funciones.php',
    data: form_data,
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function(respuesta) {
        $("#tabla_proyectos").append(respuesta.info_proyectos);
    }
})