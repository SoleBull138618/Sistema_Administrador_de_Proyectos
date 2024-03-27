'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    document.getElementById('contra_user').addEventListener('keyup',validacion_contra);
    $('#btnValidaDatos').on('click', validaFormulario);

    $('[onlyNumber]').on('keydown', e => {
    
        let regex = new RegExp('[0-9]');
        return regex.test(e.key) || e.key == 'Backspace' || e.key == "Tab";
    });
}

function validacion_contra(e){
    
    let regex = new RegExp('(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])');
    let elem = e.target;

    if(regex.test(elem.value) && elem.value.length >= elem.getAttribute('minlength')){
        elem.setAttribute('isValid', true)
    }else{
        elem.setAttribute('isValid', false);
    }

}

function validaFormulario(){

    let isOk = true;

    $('[required]').each((index, elem) => {

        if(elem.value.trim().length == 0){

            isOk = false;

        }

    });

    if(!$('#contra_user').attr('isValid')){
        isOk = false;
    }


    if(isOk){
        logeaUsuario();
    }else{
        alert('Te faltan datos por llenar');
        return false;
    }

}

function logeaUsuario(){

    let form_data = new FormData();
    form_data.append('opc', 'logeaUsuario');
    form_data.append('username', $('#username').val());
    form_data.append('contrasenia', $('#contra_user').val());

    $.ajax({
        async: false,
        type: 'POST',
        url: 'php/funciones.php',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            alert(data.mensaje);
            
            if(data.estado){
                $('#btnSubmit').show();
                $('#btnValidaDatos').hide();
            }
        },
        error: function(xhr, status, error){
            console.log(error);
        }
    });

}
