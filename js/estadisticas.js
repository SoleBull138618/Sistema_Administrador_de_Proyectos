'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('btnProgramador').addEventListener('click',verGraficoProgramador);
    // document.getElementById('btnLineas').addEventListener('click',verPrueba);
    document.getElementById('btnServicio').addEventListener('click',verGraficoServicio);

}



function verGraficoProgramador(){
    
    var chart1;

    var options = {
        chart: {
            type: 'column',
            renderTo: 'contenedor',
        },
        title:{
            text: 'Gráfica de Proyectos por Programador.'
        },
        xAxis:{
            type: 'category'
        },
        yAxis:{
            title:{
                text: 'Loritos'
            }
        },
        plotOptions:{
            series:{
                borderWidth: 1,
                dataLabels:{
                    enabled: true,
                    format: '{point.y:0f}'
                }
            }
        },
        tooltip:{
            headerFormat: "<span style='font-size:11px'>{series.name}</span><br>",
            pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y:.0f}<b>"
        },
        series:[{
            name: 'programador',
            colorByPoint: true,
            data: []
        }]
    };

    let form_data = new FormData();
    form_data.append('opc','GraficaPorProgramador');

    $.ajax({
        async: false,
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(result) {
            options.series[0].data = result.info_grafica_programador;
            chart1 = new Highcharts.Chart(options);
        }
    })
}

// function verPrueba(){
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
// }

function verGraficoServicio(){

    var chart1;

    var options = {
        chart: {
            type: 'column',
            renderTo: 'contenedor',
        },
        title:{
            text: 'Gráfica de Proyectos por Servicio.'
        },
        xAxis:{
            type: 'category'
        },
        yAxis:{
            title:{
                text: 'Loritos'
            }
        },
        plotOptions:{
            series:{
                borderWidth: 1,
                dataLabels:{
                    enabled: true,
                    format: '{point.y:0f}'
                }
            }
        },
        tooltip:{
            headerFormat: "<span style='font-size:11px'>{series.name}</span><br>",
            pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y:.0f}<b>"
        },
        series:[{
            name: 'Servicios',
            colorByPoint: true,
            data: []
        }]
    };

    let form_data = new FormData();
    form_data.append('opc','GraficaPorServicio');

    $.ajax({
        async: false,
        type: 'POST',
        url: '../php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(result) {
            options.series[0].data = result.info_grafica_servicio;
            chart1 = new Highcharts.Chart(options);
        }
    })

    // Highcharts.chart('contenedor',{
    //     chart:{
    //         type: 'column'
    //     },
    //     xAxis:{
    //         categories:['Rojo','Verde','Negro']
    //     },
    //     series:[{
    //         data: [{
    //             name:'Color 1',
    //             color:'#ff0035',
    //             y:1
    //         },
    //         {
    //             name:'Color 1',
    //             color:'#28a745',
    //             y:3 
    //         },
    //         {
    //             name:'Color 1',
    //             color:'blak',
    //             y:5
    //         }]
    //     }],
    // });
}

