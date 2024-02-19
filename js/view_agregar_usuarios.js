'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnRegistrarUsuarios').addEventListener('click',registrarUsuarios);
}

function registrarUsuarios(){

    let form_data = new FormData();
    form_data.append('opc','guardar_usuarios');
    form_data.append('registrarnombre');
    form_data.append('registrarempleado');
    form_data.append('rol');
    form_data.append('contra');

    $.ajax({
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            console.log('Se registro el usuario.')
        }
    })

}