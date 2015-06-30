
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_'.instancia_controller()->modelo, 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Admision Pacientes</span>
                <hr class="hr_titulo_formulario"/>
            </div>
             <table align="center" cellpadding="3" cellspacing="3"  style="width: 100%">
                <tr>
                    <td style="width: 40%" align="right">Cedula Paciente:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_cedula  form','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'bsq')); ?></td>
                    
                </tr>
                
            </table>
            </div>


<table id="tbPlanes" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>
        
        <th style="width: 45%">Nombre del Plan</th>
        <th style="width: 15%">Total</th>
        <th style="width: 15%">Cancelado</th>
        <th style="width: 5%">Pagar</th>
        <th style="width: 5%">Calendario</th>
        
    </thead>
    <tbody>
    </tbody>
</table>
<table id="tbCitas" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>
        
        
        <th style="width: 30%">Servicio</th>
        <th style="width: 10%">Precio</th>
        <th style="width: 10%">Fecha</th>
        <th style="width: 10%">Hora</th>
        <th style="width: 20%">Estatus</th>
        <th style="width: 5%">Cambiar Cita</th>
        <th style="width: 5%">Pagar</th>
        <th style="width: 5%">Ingreso</th>
        <th style="width: 5%">Ejecutado</th>
        
    </thead>
    <tbody>
    </tbody>

</table>


<script type="text/javascript">


        
    $(document).ready(function() {

        
        var imgCalendario='<img class="calendario" width="15px" src="'+$(window).data('base_url_img')+'/iconos/calendar.gif" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgPagar='<img class="pagar" width="15px" src="'+$(window).data('base_url_img')+'/icons/coins.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgPagarCita='<img class="pagarCita" width="15px" src="'+$(window).data('base_url_img')+'/icons/coins.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgPagado='<img class="pagado activado" width="15px" src="'+$(window).data('base_url_img')+'/iconos/valid.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgIngreso='<img class="activar"  width="15px" src="'+$(window).data('base_url_img')+'/iconos/apply.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgCambiar='<img class="cambiar" width="15px" src="'+$(window).data('base_url_img')+'/iconos/calendar.gif" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgCancelar='<img class="desplazado" width="15px" src="'+$(window).data('base_url_img')+'/iconos/error.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        //var imgCancelar='<img class="desplazado" width="15px" src="'+$(window).data('base_url_img')+'/iconos/error.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var imgEspera='<img class="espera" width="15px" src="'+$(window).data('base_url_img')+'/iconos/info.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'

        var tablePlanes = $("#tbPlanes").DataTable(
        {
            "sScrollY": 120,
            "bJQueryUI": true,
            "bPaginate":false
        });

        var tableCitas = $("#tbCitas").DataTable({"sScrollY": 150,"bJQueryUI": true,"bPaginate":false});

        $('#tbPlanes tbody ').on( 'click', 'tr', function ()
        {
            $('#tbPlanes tbody tr').removeClass("row_selected");
            $(this).addClass('row_selected');
            trid=$(this).attr("id");
            
            tableCitas.clear().draw();
            $.ajax({
                    type: "post",
                    data:{"mod":"recepcion/admision","fn":"AddItemsCita","cnt":"1","param1":trid,"tipo":"autocomplete"},
                    url: $(window).data('base_url_index')+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {
                                    $("#tbCitas").data("bsqId", trid);
                                    $.each(datos, function(i,item)
                                    {
                                        var st=item.status_id;
                                        imgActivar=imgCancelar;
                                        imgEjecutar=imgCancelar;
                                        if(item.status_id==2 || item.status_id==3)
                                        {
                                                if(item.status_id==2)
                                                {
                                                    imgActivar=imgEspera;
                                                }else
                                                {
                                                    imgActivar=imgIngreso;
                                                }
                                        }
                                        imgPago=imgPagarCita;

                                        if(st>=1 && st<=5)
                                        {
                                            
                                            imgPago=imgPagado;
                                            if(st==1 || st==5)
                                            {
                                                imgActivar=imgPagado;
                                            }
                                        }else
                                        {
                                            imgActivar=imgCancelar;
                                        }

                                        if(st==1)
                                        {
                                            imgEjecutar=imgPagado;
                                        }


                                        var rowNode = tableCitas.row.add( [item.nombre_servicio,FloatTomonedaBsf(item.precio),item.fecha_agendada,item.hora_cita,item.status_nombre,imgCambiar,imgPago,imgActivar,imgEjecutar]).draw().node();
                                        $(rowNode).attr("id",item.id);
                                        if(item.admitido=="t")
                                            {
                                                $(rowNode).addClass("row_activate");
                                            }
                                    });

                                    $("#tbCitas").off("click","img.pagar , img.cambiar , img.activar",$.fnopcionesCitas);
                                    $("#tbCitas").on("click","img.pagar , img.cambiar , img.activar",$.fnopcionesCitas);

                           }
                });
        });

        $.fnopcionesCitas=function(event){

        
                                            var agenda_id=$(this).parent().parent().attr("id");
                                            $("#tbCitas").data("solicitudes_id", agenda_id);

                                            if($(this).hasClass("cambiar")){
                                                myWindow = window.open($(window).data("base_url")+"/recepcion/agendar", "Agendar");
                                                $(document).data({"ObjWCalendar":myWindow});
                                            }
                                            if($(this).hasClass("pagar")){
                                                plan_id=$("#tbPlanes").data("plan_id");


                                                    var myWindow;
                                                    if(myWindow=$(document).data("ObjWPagos"))
                                                    {

                                                        myWindow.close();
                                                    }
                                                    param="/"+$("#tbPlanes").data("paciente_id")+"/"+plan_id+"/"+agenda_id
                                                    myWindow = window.open($(window).data("base_url_index")+"/caja/pagos/pagoPlan"+param, "pagos");
                                                    myWindow.focus();
                                                    $(document).data({"ObjWPagos":myWindow});





                                            }
                                            if($(this).hasClass("activar")){
                                                var tr=$(this).parent().parent();

                                                $(this).parent().append(imgPagado);
                                                $(this).remove();
                                                 $.ajax({
                                                    type: "post",
                                                    data:{"mod":"recepcion/admision","fn":"activarCita","cnt":"1","param1":agenda_id,"tipo":"activar"},
                                                    url: $(window).data('base_url_index')+"/globales/json",
                                                    cache: true,
                                                    dataType: "json",
                                                    success: function(datos)
                                                           {
                                                                    var row_activate=tr;
                                                                    $.each(datos, function(i,item)
                                                                    {
                                                                        if(item.act==1)
                                                                        {
                                                                            row_activate.removeClass("row_activate");
                                                                            row_activate.addClass("row_activate");
                                                                        }
                                                                    });
                                                                    

                                                           }
                                                });

                                                

                                                
                                            }
                                    }
        
  
        $.AutoCompletecallBack=function(element)
        {
            $("#tbPlanes").data("paciente_id", element.data);
            tablePlanes.clear().draw();
            tableCitas.clear().draw();
            $.ajax({
                    type: "post",
                    data:{"mod":"recepcion/admision","fn":"AddItemsPlans","cnt":"1","param1":element.data,"tipo":"autocomplete"},
                    url: $(window).data('base_url_index')+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {

                                    if(datos.length<=0)
                                    {
                                        $("#admision_model_bsq").val("");
                                        alert("El paciente no tiene citas previstas");
                                    }

                                    $.each(datos, function(i,item)
                                    {

                                        imgPago=imgPagar;
                                        if(item.pagado=="t")
                                        {
                                            imgPago=imgPagado;
                                        }
                                        var rowNode = tablePlanes.row.add( [item.nombre,FloatTomonedaBsf(item.total),FloatTomonedaBsf(item.abonado),imgPago,imgCalendario]).draw().node();
                                        $(rowNode).attr("id",item.id);
                                        
                                        
                                        
                                    });



                                    $("#tbPlanes").on("click","img.pagar , img.calendario",function(event)
                                    {
                                            plan_id=$(this).parent().parent().attr("id");
                                            $("#tbPlanes").data("plan_id", plan_id);
                                            if($(this).hasClass("calendario")){
                                                myWindow = window.open($(window).data("base_url_index")+"/recepcion/agendar", "Agendar");
                                                $(document).data({"ObjWCalendar":myWindow});
                                            }
                                            if($(this).hasClass("pagar")){


                                                        var myWindow;
                                                        if(myWindow=$(document).data("ObjWPagos"))
                                                        {
                                                            myWindow.close();
                                                        }
                                                        param="/"+$("#tbPlanes").data("paciente_id")+"/"+plan_id;
                                                        myWindow = window.open($(window).data("base_url_index")+"/caja/pagos/pagoPlan"+param, "pagos");
                                                        myWindow.focus();
                                                        $(document).data({"ObjWPagos":myWindow});
                                                        
                                                    
                                                    
                                                    


                                                    
                                                   
                                            }
                                    });
                           }
                });
                
            
        }

        $.onInvalidateSelection=function(element)
        {
            tablePlanes.clear().draw();
            tableCitas.clear().draw();
        }
        
        $.onNotSuggestion=function(element)
        {
            if(confirm("Registrar Paciente"))
            {
                
                action=$("form#form_admision_model").attr("action")
                $("form#form_admision_model").attr("action",action+"/redireccionar/1");
                $("form#form_admision_model").submit();
            }else
            {
                $("#admision_model_bsq").val("");
            }

            
        }


        $('#admision_model_bsq').autocomplete({
                serviceUrl:$(window).data('base_url_index')+"/globales/autocomplete/",
                type: "post",
                params: { modelo:'recepcion/admision_model',fn:"autocompletePacientes"},
                onSelect: $.AutoCompletecallBack,
                onInvalidateSelection : $.onInvalidateSelection,
                showNoSuggestionNotice:true,
                onNotSuggestion:$.onNotSuggestion
        });
        
        
        
    });

    

 
</script>

<? echo form_close() ?>

<style>

table.display tr.odd.row_activate td {
    background-color: #78ce9f;
}

table.display tr.even.row_activate td {
    background-color: #addbc2;
}

</style>