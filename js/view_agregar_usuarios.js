'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnRegistrarUsuarios').addEventListener('click',registrarUsuarios);
}

function registrarUsuarios(){

    let form_data = new FormData();
    form_data.append('opc','guardar_usuarios');
    form_data.append('registrarnombre',$('#registrar_nombre').val());
    form_data.append('registrarempleado',$('#registrar_empleado').val());
    form_data.append('rol',$('#rol').val());
    form_data.append('contra',$('#contra').val());

    console.log('loritos')

    $.ajax({
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            console.log('Se registro el usuario.')
        },
        error: function(xhr, status, error){
            console.log(error)
        }
    })

}