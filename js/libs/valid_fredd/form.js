fnvalidarFormulario=null;
inicializar_form=function()
{
    
$(document).ready(function()
{
    var form=$("form");
    var cmps_txt= $(".req_txt , .req_integer , .req_cedula , .req_moneda , .req_telefono, .req_fecha, .req_email");
    var cmps_cmb= $(".req_cmb");
    var cmps_check=$(".req_check");
    var cmps_radio= $(".req_radio");
    var cmps_area= $(".req_area");

    var cmps_moneda=$(".req_moneda");
    var cmps_email= $(".req_email");
    var cmps_fecha= $(".req_fecha");
    
    
    $(".req_fecha , .fecha").inputmask("y-m-d",{"placeholder": "yyyy-mm-dd","clearIncomplete": true});
    $( ".req_fecha , .fecha" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            showOn: "button",
            buttonImage: $(window).data("base_url_img")+"/iconos/calendar.gif",
            buttonImageOnly: true,
            dateFormat:'yy-mm-dd',
            currentText: 'Hoy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            yearRange: '1920:2013'
    });
    
    
    

    $(".req_telefono ,.mask_telefono , .telefono").inputmask('(0C) 999-99-99',{
                definitions: {
                    'C': {
                        validator: "(2\\d{2}|416|426|414|424|412)",
                        cardinality: 3,
                        prevalidator: [
                        {validator: "[2|4]", cardinality: 1},
                        {validator: "(41|42|2\\d)", cardinality: 2},
                        {validator: "(416|426|414|424|412)", cardinality: 3}
                    ]
                    }
                },
                 "placeholder": "0",
                 "clearIncomplete": true
            });
    $(".req_cedula ,.mask_cedula , .cedula").inputmask("V-9{5}[9{0,3}][-9{0,1}]{0,1}",{
                definitions: {
                    "V": {
                        validator: "[V|J|E]",
                        cardinality: 1,
                        casing: "upper"
                    }
                },
                 "placeholder": " ",
                 "greedy": false,
                 "skipOptionalPartCharacter": " ",
                 "clearIncomplete": true
            });
     
    
    
    
    $(".req_moneda , .moneda ").inputmask("Bs");
    $(".req_integer , .integer ").inputmask("integer");
    

    $(".numeros").keypress(function(evnt)
    {
        return validar(evnt,numeros);
    });

    $(".letras").keypress(function(evnt)
    {
        return validar(evnt,letras);
    });

    $(".alfa").keypress(function(evnt)
    {
        return validar(evnt,numeros+letras+signos+'():.,;-+*#$/%<>=@&!?');
    });

    $(".url").keypress(function(evnt)
    {
        return validar(evnt,numeros+letras+".-_");
    });



     $(".req_email , .email , .correo ").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            },"clearIncomplete": true
    });


    $(".validar , .submit ").click(function()
    {
        
          return validarFormulario();
    });

    $(".btnsubmit").click(function()
    {
        
        if(validarFormulario())
        {
          form.submit();
        }     
    });


   

    function validarFormulario()
    {

            var vldtxt=validarCmpTexto(cmps_txt);
            var vldcmb=validarCombos(cmps_cmb);
            var vldtemail=validarCmpEmail(cmps_email);
            var vldtfecha=validarCmpfecha(cmps_fecha);
            var vldarea=validarCmpArea(cmps_area);
            var vldradios=validarRadios(cmps_radio);
            var vldchecks=validarChecks(cmps_check);

            if(vldtxt && vldcmb && vldtemail && vldtfecha && vldarea && vldradios  && vldchecks)
            {
                    eliminarCmbvacios($("select"));
                    return true;
            }else
            {
                    showErrors();
                    return false;
            }
    }

    

    function showErrors()
    {
            most_band="0";
            $("#tmp_error").slideDown(1500,function(){}).delay(4000).slideUp(1000, function()
            {
                most_band="1";
            });
    }


    $(".req_txt , .req_area , .req_cmb , .req_fecha , .req_email , .req_moneda , .req_cedula , .req_integer , .req_telefono").focus(function()
    {
        
            removerClassError($(this));
    });

    $(".req_radio").click(function()
    {
            removerClassError($(".span_rad_"+$(this).attr("id")));
    });

    $(".req_check").click(function()
    {
            removerClassError($(".span_check_"+$(this).attr("grupo")));
    });

});

/*
 *para no validar agregar clase not_validate
 *
 **/

}

inicializar_form();