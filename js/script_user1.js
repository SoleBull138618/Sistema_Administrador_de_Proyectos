'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnProyectos').addEventListener('click',verProyecto);
    document.getElementById('btnEstadisticas').addEventListener('click',verProyecto);
    document.getElementById('btnAgregarUsuarios').addEventListener('click',verProyecto);
    document.getElementById('btnModificarUsuarios').addEventListener('click',verProyecto);
    
}

function verProyecto(){
    
    let elementValue = this.getAttribute('value')
    let newSrc = '';

    switch (elementValue){
        case 'Proyectos':
            newSrc = 'views/ver_proyecto.html'
            break;
        case 'Estadisticas':
            newSrc = 'views/estadisticas.html'
            break;
        case 'Agregar Usuarios':
            newSrc = 'views/agregar_usuarios.html'
            break;
        case 'Modificar Usuarios':
            newSrc = 'views/modificar_usuarios.html'
            break;
        default:
            console.log('chale')
            break;
    }

    console.log(newSrc)

    document.getElementById('framecito').src = newSrc;

}