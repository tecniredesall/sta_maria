var base_url;
    $(document).ready(function()
    {

        
        $("#pagos_model_cash").on("change",function()
        {
            var efectivo=$(this).val();
            var total=$("#pagos_model_total_pagar").val();
            $("#pagos_model_turned").val(FloatFormatToFloat(efectivo)-FloatFormatToFloat(total));
            
        });

        
        $("tr td.precio").each(function()
        {
            $(this).html(FloatTomonedaBsf($(this).html()));
            
        });

        $("#pagos_model_total").attr("disabled","disabled");
        $("#pagos_model_iva").attr("disabled","disabled");
        $("#pagos_model_total_total").attr("disabled","disabled");
        $("#pagos_model_total").attr("disabled","disabled");
        $("#pagos_model_iva").addClass("not_validate");

        $("input#btn_enviar.button_modal_div").click(function()
        {
           var val=$("#pagos_model_total").val();
           $("#pagos_model_total_pagar").val(val);
           $("#pagos_model_turned").val("");
           $("#pagos_model_cash").val("");
        });
        

        base_url=$(this).data('base_url');
        $("#id_data_table input[type='checkbox'].fnClick").on("change",function(event){


           row=$(this).parent().parent().parent();
           //alert(row.attr("id"));

           precio=$(this).parent().parent().siblings(".precio").html();
           total=$("#pagos_model_total").val();


           total=FloatFormatToFloat(total);
           precio=BsToFloat(precio);

           if(this.checked==true)
           {
                total=total+precio;

           }else
           {
               total=total-precio;
           }
           $("#pagos_model_total").val(total);

        });

        $("input:radio[id=datos_pago_tipo_pago]").change(function(){

            val=$(this).val();
            if(val==1)
            {
              $.cash_show();
            }else
            if(val==2)
            {
                $.card_show();
            }else
            if(val==3)
            {
                $.credit_show();
            }else
            {
                $.inicializarPago();
            }

            inicializar_form();

        });

       if($("input:radio[id=pagos_model_tipo_pago]:checked").val()==1)
       {
            $('#desc_procesos_model_cant').val("-1");
            $('#desc_procesos_model_cant').hide();
       }

       $.inicializar=function()
        {
            $.inicializarPago();
            $("#pagos_model_total").attr("disabled","disabled");
        }

        $.inicializarPago=function()
        {
            $("#cash").hide();
            $("#pagos_model_cash").val("");
            $("#pagos_model_cash").addClass("not_validate");
            $("#pagos_model_turned").attr("disabled","disabled");
            $("#pagos_model_turned").val("");
            $("#pagos_model_turned").addClass("not_validate");

            $("#card").hide();
            $("#datos_pago_tarjeta_ci_tarjeta").val("");
            $("#datos_pago_tarjeta_ci_tarjeta").addClass("not_validate");
            $("#datos_pago_tarjeta_bancos_id").val("seleccione");
            $("#datos_pago_tarjeta_bancos_id").addClass("not_validate");
            $("#datos_pago_tarjeta_ref").val("");
            $("#datos_pago_tarjeta_ref").addClass("not_validate");
            $("#datos_pago_tarjeta_last4_digit").val("");
            $("#datos_pago_tarjeta_last4_digit").addClass("not_validate");

            $("#credit").hide();
            
            $("input[id=datos_pago_tarjeta_tdc_tipo]").each(function()
            {
                this.checked=false;
                $(this).addClass("not_validate");
            });
        }
        
        $.cash_show=function()
        {
              $.inicializarPago();
              $("#cash").show();
              $("#pagos_model_cash").removeClass("not_validate , error");
              
        }

        $.card_show=function()
        {
            $.inicializarPago();
            $("#card").show();
            $("#datos_pago_tarjeta_ci_tarjeta").removeClass("not_validate , error");
            $("#datos_pago_tarjeta_bancos_id").removeClass("not_validate , error");
            $("#datos_pago_tarjeta_ref").removeClass("not_validate , error");
            $("#datos_pago_tarjeta_last4_digit").removeClass("not_validate , error");
        }

        $.credit_show=function()
        {
            $.card_show();
            $("#credit").show();
             $("input[id=datos_pago_tarjeta_tdc_tipo]").each(function()
             {
                this.checked=false;
                $(this).removeClass("not_validate , error");
                removerClassError($(".span_rad_"+$(this).attr("id")));
                
             });
        }


        $.inicializar();
       
       

    });


