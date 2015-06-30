
$(document).ready(function()
{
    $("#clave1").val("");
    $("#usuarios_model_clave").val("");
    $("#usuarios_model_respuesta1").val("");
    $("#usuarios_model_respuesta2").val("");
    
    
    $(".item_otro_table").live("click",function()
    {
        retorno=confirm("¿Bloquear/Desbloquear el Usuario ?");
        return retorno;
    });

});