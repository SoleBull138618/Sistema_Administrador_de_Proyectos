'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnProyectos').addEventListener('click',verProyecto);
    document.getElementById('btnEstadisticas').addEventListener('click',verProyecto);
    
}

function verProyecto(){
    
    let elementValue = this.getAttribute('value')
    let newSrc = '';

    switch (elementValue){
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