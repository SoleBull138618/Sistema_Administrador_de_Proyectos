
let form_data = new FormData();
form_data.append('opc','info_tabla_usuarios');

$.ajax({
    type: 'POST',
    url: '../php/funciones.php',
    // data: {opc: "info_tabla_usuarios"},
    data: form_data,
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function(respuesta) {
        $("#tabla_usuarios").append(respuesta.info_empleado);
    }
})
