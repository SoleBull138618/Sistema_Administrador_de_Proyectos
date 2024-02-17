'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnSubirProyectos').addEventListener('click',verProyecto);
    document.getElementById('btnEditarProyectos').addEventListener('click',verProyecto);
    document.getElementById('btnSubirArchivos').addEventListener('click',verProyecto);
    document.getElementById('btnProyectos').addEventListener('click',verProyecto);
    document.getElementById('btnEstadisticas').addEventListener('click',verProyecto);
    
}

function verProyecto(){
    
    let elementValue = this.getAttribute('value')
    let newSrc = '';

    switch (elementValue){
        case 'Subir Proyectos':
            newSrc = 'views/new_proyect.html'
            break;
        case 'Editar Proyectos':
            newSrc = 'views/editar_proyecto.html'
            break;
        case 'Subir Archivos':
            newSrc = 'views/agregar_archivos.html'
            break;
        case 'Proyectos':
            newSrc = 'views/proyectos.html'
            break;
        case 'Estadisticas':
            newSrc = 'views/estadisticas.html'
            break;
        default:
            console.log('chale')
            break;
    }

    console.log(newSrc)

    document.getElementById('framecito').src = newSrc;

}