'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnAltaProyectos').addEventListener('click',registrarProyectos);
}

function registrarProyectos(){

    let form_data = new FormData();
    form_data.append('opc','guardar_proyectos');
    form_data.append('nombreproyecto',$('#alta_nomproyecto').val());
    form_data.append('fecha_alta',$('#fecha_de_alta').val());
    form_data.append('origenpeticion',$('#alta_orgienpeticion').val());
    form_data.append('servicio',$('#alta_servicio').val());
    form_data.append('descripcion',$('#alta_descripcion').val());
    form_data.append('tipo_proyecto',$('#alta_tipo_proyecto').val());
    form_data.append('clasipro',$('#alta_clasificacion').val());
    form_data.append('haypeti',$('#alta_hay_peticion').val());
    form_data.append('arqui',$('#alta_arqui').val());
    form_data.append('desarrollador',$('#alta_programador').val());
    form_data.append('fecha_compromiso',$('#alta_fecha_compromiso').val());

    // console.log('loritos')

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