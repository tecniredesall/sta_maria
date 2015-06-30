
$(document).ready(function()
{
    $("#form_usuarios").submit(function()
    {
        if($("#usuarios_model_clave").val()==$("#clave1").val())
        {
           
            return true;
        }else
        {   
            $("#clave1").val("");
            $("#usuarios_model_clave").val("");
            alert("Las claves son diferentes");
            return false;
        }
    });


   
});