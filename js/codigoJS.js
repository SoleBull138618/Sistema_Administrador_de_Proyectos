'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnColumnas').addEventListener('click',verGrafico);
    document.getElementById('btnLineas').addEventListener('click',verPrueba);
    document.getElementById('btnArea').addEventListener('click',verArea);

}

function verGrafico(){
    // alert("ola");
    console.log('loritos');
    Highcharts.chart('contenedor',{
        chart:{
            type: 'line'
        },
        title:{
            text:'Valores mensuales'
        },
        xAxis:{
            categories:['Ene','Feb','Mar']
        },
        series:[{
            data: [2,3,4]
        }],
    });
}

function verPrueba(){
    Highcharts.chart('contenedor',{
        xAxis:{
            minPadding: 0.05,
            maxPadding: 0.05
        },
        series:[{
            data: [
                [0,29.9],
                [1,71.5],
                [3,106.4]
            ]
        }],
    });
}

function verArea(){

    Highcharts.chart('contenedor',{
        chart:{
            type: 'column'
        },
        xAxis:{
            categories:['Rojo','Verde','Negro']
        },
        series:[{
            data: [{
                name:'Color 1',
                color:'#ff0035',
                y:1
            },
            {
                name:'Color 1',
                color:'#28a745',
                y:3 
            },
            {
                name:'Color 1',
                color:'blak',
                y:5
            }]
        }],
    });
}