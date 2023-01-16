window.onload = function(){
    document.getElementById("email").focus();
    document.getElementById("formulario").onsubmit = validar;
    document.getElementById("formulario").onsubmit = limpiarFormulario;


}


function limpiarFormulario(){
    document.getElementById("formulario").reset();
}


function validar(event){
    var valor = document.getElementById("contraseña").value;
    if (valor.length == 0) {
        alert("La contraseña esta vacía debes introducir los datos");
        event.preventDefault();
    }
    var valor = document.getElementById("contraseña2").value;
    if (valor.length == 0) {
        alert("La contraseña esta vacía debes introducir los datos");
        event.preventDefault();
    }

    valor = document.getElementById("telefono").value;
    if( !(/^\d{9}$/.test(valor)) ) {
        alert("El telefono debe tener 9 dígitos");
        event.preventDefault();
    }
}
