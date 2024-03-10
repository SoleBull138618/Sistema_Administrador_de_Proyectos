'use strict';

$(document).ready(eventListeners);

function eventListeners(){

    llenaTablaVerProyectos();

    $('[data-manipulation-button] input[type=button]').on('click', function(){

        let parent = this.parentNode;
        let parentRow = $(`#${parent.getAttribute('data-manipulation-button')}`)[0]; //'marco'+name;  "marco"+name; `marco${name}`

        if(this.value == 'Editar'){
            console.log('Esta editandome')


            
            let id = parentRow.id.substring('project_'.length);

            fnLlenaComentarios(id) //Manda a llenar #update_comentarios
            fnLlenaId(id) //Manda a llenar #id
            $('#hiddenId').val(id); //Agregamos el id oculto a la ventana modal

            window.modal.showModal();
        }
        else if(this.value == 'Borrar'){

            console.log("Esta borrandome")
            $(parentRow).hide()
        }

    });

    document.getElementById('btnCerrarUsuarios').addEventListener('click',function(){
        $('#hiddenId').val(); //Eliminamos el id oculto a la ventana modal
    });

    // Boton para actualizar el nuevo comentario en la bd.
    document.getElementById('btnActualizarComentario').addEventListener('click',ActualizarComentario);

    document.getElementById('btnFiltrarUsuarios').addEventListener('click',FiltrarProyectos);

}

function llenaTablaVerProyectos(){

    let form_data = new FormData();
    form_data.append('opc','info_tabla_proyectos');

    $.ajax({
        async: false,
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            $("#tabla_proyectos tbody").append(respuesta.info_proyectos);
        }
    })

}

function fnLlenaComentarios(id){

    let form_data = new FormData();
    form_data.append('opc','comentario_old_tabla_proyectos');
    form_data.append('id',id);

    $.ajax({
        async: false,
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            $("#old_comentarios").html(respuesta.old_comentario);
        }
        ,error:function(xhr, status, error){
            console.log(error)
        }
    })


}

function fnLlenaId(id){

    $("#ver_id_proyecto").html(id);
}

function ActualizarComentario(id){

    // union_comentario = old_comentarios + '|' + update_comentarios;
    // id = id.substring('project_'.length);

    let old_comentario =  '';

    $('#old_comentarios td').each(function(i, e){
        old_comentario += e.textContent + '|';
    });

    old_comentario = old_comentario.substring(0, old_comentario.length-1); //Quitamos el ultimo pipe
    

    let form_data = new FormData();
    form_data.append('opc','actualizar_comentario_proyecto');
    form_data.append('update_avance_actual',$('#update_avance_actual').val());
    form_data.append('update_comentarios',$('#update_comentarios').val());
    form_data.append('old_comentarios', old_comentario);
    form_data.append('id',$('#hiddenId').val());

    $.ajax({
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            console.log('Se actualizo el comentario.')
            // console.log(old_comentarios)
        },
        error: function(xhr, status, error){
            console.log(error)
        }
    })
}

function FiltrarProyectos(){

    let filtrar_servicio = '';
    let filtrar_estatus = '';
    let filtrar_programador = '';

    $('#filtro_servicio option').each(function(i, e){
        filtrar_servicio += "'" + $(e).val() + "',";
    });

    filtrar_servicio = filtrar_servicio.substring(0,filtrar_servicio.length-1)

    $('#filtro_estatus option').each(function(i, e){
        filtrar_estatus += "'" + $(e).val() + "',";
    });

    filtrar_estatus = filtrar_estatus.substring(0,filtrar_estatus.length-1)

    $('#filtro_programador option').each(function(i, e){
        filtrar_programador += "'" + $(e).val() + "',";
    });

    filtrar_programador = filtrar_programador.substring(0,filtrar_programador.length-1)

    filtrar_servicio = $('#filtro_servicio').val() ? "'" + $('#filtro_servicio').val() + "'" : filtrar_servicio;
    filtrar_estatus = $('#filtro_estatus').val() ? "'" + $('#filtro_estatus').val() + "'" :filtrar_estatus;
    filtrar_programador = $('#filtro_programador').val() ? "'" + $('#filtro_programador').val() + "'" :filtrar_programador;

    let form_data = new FormData();
    form_data.append('opc','FiltrarProyecto');
    form_data.append('filtrar_servicio',filtrar_servicio);
    form_data.append('filtrar_estatus',filtrar_estatus);
    form_data.append('filtrar_programador', filtrar_programador);
    
    $.ajax({
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(respuesta) {
            $("#tabla_proyectos tbody").html(respuesta.info_proyectos);
        },
        error: function(xhr, status, error){
            console.log(error)
        }
    })
}