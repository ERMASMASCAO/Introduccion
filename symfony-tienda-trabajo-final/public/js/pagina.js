window.onload = function(){
    // document.getElementById("registration_form_email").focus();
    // document.getElementById("formulario").onsubmit = validar;
    // document.getElementById("formulario").onsubmit = limpiarFormulario;
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
    
    //Immediately-Invoked Function Expression (IIFE)
    (function(){
        const infoProduct = $("#infoProduct");
        $( "a.open-info-product" ).click(function(event) {
        event.preventDefault();
        const id = $( this ).attr('data-id');
        const href = `/api/show/${id}`;
        $.get( href, function(data) {
            $( infoProduct ).find( "#productName" ).text(data.name);
            $( infoProduct ).find( "#productPrice" ).text(data.price);
            $( infoProduct ).find( "#productImage" ).attr("src", "/img/" + data.photo);
            infoProduct.modal('show');
        })
        });
        $(".closeInfoProduct").click(function (e) {
        infoProduct.modal('hide');
        });
    })();
}
