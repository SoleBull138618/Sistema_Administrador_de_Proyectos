'use strict';

$(document).ready(eventListeners);

// window.addEventListener('load', eventListeners);

function eventListeners(){

    llenaTablaUsuarios();

    $('[data-manipulation-button] input[type=button]').on('click', function(){

        let parent = this.parentNode;
        let parentRow = $(`#${parent.getAttribute('data-manipulation-button')}`)[0]; //'marco'+name;  "marco"+name; `marco${name}`

        if(this.value == 'Borrar'){
            console.log("Esta borrandome")
            $(parentRow).hide()

            let empleado = parentRow.empleado.substring('n'.length);
            console.log("Empleado")
        }
        else if(this.value == 'Editar'){
            console.log('Esta editandome')
        }

    });
}

function llenaTablaUsuarios(){

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

}
