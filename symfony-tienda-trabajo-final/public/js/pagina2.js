$(function(){
    $("#aco").accordion();
    $("#tituloEmpresa").mouseenter(function() {
        $("#tituloEmpresa").animate({
            "background-color": "#hsla(0, 46%, 31%, 0.800)",
            "color": "white"
            }, 1000);
    })
    $("#tituloEmpresa").mouseleave(function() {
        $("#tituloEmpresa").animate({
            "background-color": "white",
            "color": "#732a2a"
            }, 1000);
    })
});
 