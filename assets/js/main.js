// Validaciones
function validEmail(){
    if(document.querySelector('#email') != null){
        var emailInput = document.querySelector('#email');
        var regex = /^[a-zA-Z0-9.+_-]+@(uac|autonoma)\.edu.co(\W|$)/;
            regex.test(emailInput.value)
                ? (emailInput.parentElement.classList.add('icon-valid'))
                : (emailInput.parentElement.classList.remove('icon-valid'));
        }
}
function validateEmail(){
    if(document.querySelector('#email') != null){
        const emailInput = document.querySelector('#email');
        emailInput.addEventListener('click',function(){
            validEmail();
        })
        emailInput.addEventListener('input', validEmail, false);
      }
}validateEmail();

function validIdentification(){
    if(document.querySelector('#id-number') != null){
        var numInput = document.querySelector('#id-number');
        var valueinput = document.querySelector('#id-type');
        if (valueinput.value == 'cedula') {
          $('#id-number').attr('maxlength','10');
          numInput.value.length == 10
          ? (numInput.parentElement.classList.add('icon-valid'))
          : (numInput.parentElement.classList.remove('icon-valid'));
        }else if (valueinput.value == 'ti') {
          $('#id-number').attr('maxlength','11');
          numInput.value.length == 11
          ? (numInput.parentElement.classList.add('icon-valid'))
          : (numInput.parentElement.classList.remove('icon-valid'));
        }else {
          $('#id-number').attr('maxlength','8');
          numInput.value.length == 8
          ? (numInput.parentElement.classList.add('icon-valid'))
          : (numInput.parentElement.classList.remove('icon-valid'));
        }
    }
}
function validateIdentification(){
    if(document.querySelector('#id-number') != null){
        const numInput = document.querySelector('#id-number');
        numInput.addEventListener('click',function(){
            validIdentification();
        })
        numInput.addEventListener('input', validIdentification, false);
      }
}validateIdentification();

function validPass(){
    if(document.querySelector('#pwd-confirm') != null){
        var numInput = document.querySelector('#pwd-confirm');
        var pwd = document.querySelector('#pwd');
        numInput.value == pwd.value
          ? (numInput.parentElement.classList.add('icon-valid'))
          : (numInput.parentElement.classList.remove('icon-valid'));
    }
}
function validatePass(){
    if(document.querySelector('#pwd-confirm') != null){
        const numInput = document.querySelector('#pwd-confirm');
        numInput.addEventListener('click',function(){
            validPass();
        })
        numInput.addEventListener('input', validPass, false);
      }
}validatePass();

// Solo letras
$('#name, #lastname').bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Solo numeros
$('#id-number').bind('keypress', function(event) {
  var regex = new RegExp("^[0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// limpiar input number
$('#id-type').click(function() {
    $('#id-number').val('');
    $('.input-id-number').removeClass('icon-valid');
});

// limpiar input password confirm

$('#pwd').click(function() {
    $('.input-pwd-confirm').removeClass('icon-valid');
});
