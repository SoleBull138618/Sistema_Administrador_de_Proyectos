'use strict';

window.addEventListener('load', eventListeners);

function eventListeners(){

    // document.getElementById('contra_user').addEventListener('keyup',validacion_contra);
    // $('input[type=submit]').on('click', validaFormulario);
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
        console.log('simona')
    }

}