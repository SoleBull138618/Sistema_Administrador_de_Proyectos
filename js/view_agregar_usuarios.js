'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnRegistrarUsuarios').addEventListener('click',registrarUsuarios);
}

function registrarUsuarios(){

    let form_data = new FormData();
    form_data.append('opc','guardar_usuarios');

    $.ajax({
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            
        }
    })

}