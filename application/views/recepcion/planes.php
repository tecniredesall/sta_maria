
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_'.instancia_controller()->modelo, 'autocomplete' => "off")) ?>

            <div class="formulario divplanes" >
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Creacion de Plan</span>
                <hr class="hr_titulo_formulario"/>
            </div>
             <div  class="divplanes">
                <table  align="center" cellpadding="3" cellspacing="3"  style="width: 100%">
                <tr>
                    <td style="width: 40%" align="right">Cedula Paciente:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_cedula  form','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'pacientes_bsq')); ?></td>
                    <td style="width: 40%" align="right">Nombres paciente</td>
                    <td><?php echo form_input_autoload(array("class"=>'txt alfa form','size' => '40', 'maxlength' => '20',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                    
                </tr>
                <tr>
                    <td colspan="4"><hr class="hr_titulo_formulario"/><td/>
                </tr>
                
                <tr>
                    <td style="width: 40%" align="right">Nombre Plan:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre_plan')); ?></td>
                    <td style="width: 40%" align="right">Costo Plan:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_moneda alfa form','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'costo_plan')); ?></td>
                </tr>
               
                <tr>
                    <td colspan="4" align="center"><br/><?php echo form_submit(array('class' => 'guardar_plan btn', 'id' => 'guardar_plan', 'value' => 'Crear Plan', 'type' => 'button')); ?><?php echo form_submit(array('class' => 'open_servicios', 'id' => 'btn_seleccionar', 'value' => 'Seleccionar', 'type' => 'button')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Cancelar')); ?></td>
                </tr>
                
            </table>
             </div>


            </div>


             <div class="formulario divsolicitudes">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Seleccion de Servicios</span>
                <hr class="hr_titulo_formulario"/>
            </div>

             <div  class="divsolicitudes">
                <table align="center" cellpadding="3" cellspacing="3"  style="width: 100%">
                    <tr>
                        <td style="width: 40px">Busqueda:</td>
                        <td><?php echo form_input_autoload(array("class"=>'txt alfa autocomplete','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'servicios_bsq')); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><br/><?php echo form_submit(array('class' => 'open_planes', 'id' => 'btn_enviar', 'value' => 'Regresar', 'type' => 'button')); ?></td>
                    </tr>
                </table>
             </div>

            </div>




<div  class="divsolicitudes" >
    <table id="tbServicios" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>
        <th style="width: 3%"></th>
        <th style="width: 45%">Items</th>
        <th style="width: 15%"> Costo Unidad</th>
        <th style="width: 10%" class="cantidad">Cantidad</th>
        <th style="width: 20%" class="total">Total</th>
        <th style="width: 7%"></th>
    </thead>
    <tbody>
    </tbody>
    
</table>
</div>




<script type="text/javascript">


        ndo=null
        var prueba;
    $(document).ready(function()
    {
        
        $("#btn_seleccionar").attr("disabled","disabled");
        $(document).data("modelo","<?php echo instancia_controller()->modelo?>");
        $(document).data("plan_id","<?php echo $plan_id?>");
        mod=$(document).data("modelo");
        plan_id=$(document).data("plan_id");
        paciente_id=-1;
        
        
        $("#guardar_plan").on("click",function(){
            if(!emptytxt($("#"+mod+"_nombre_plan").val()))
            {

                if(!$(this).hasClass("btnEnviar"))
                {
                    $(this).addClass("btnEnviar");
                    $(this).val("Guardar Plan");
                    $("#btn_seleccionar").removeAttr("disabled");
                    $("#"+mod+"_pacientes_bsq").attr("disabled","disabled");
                }else
                {
                    if(!emptytxt($("#"+mod+"_costo_plan").val()))
                    {
                        var jsonString="";
                        var cant=0;
                        var ids=$("#tbServicios").list().getIds();
                        for(var i=0;i<ids.length;i++)
                        {
                            cant=$("#tbServicios").list().getColumn(ids[i], "cant");
                            if(i==0)
                            {
                                jsonString='{"servicios_id":"'+ids[i]+'","cant":"'+cant+'"}';
                            }else
                            {
                                jsonString=jsonString+',{"servicios_id":"'+ids[i]+'","cant":"'+cant+'"}';
                            }

                        }
                        jsonString=$.parseJSON('{"json":['+jsonString+']}');
                         $.ajax({
                            type: "post",
                            data:{"mod":"recepcion/planes","fn":"savePlan","cnt":"4","param1":paciente_id,"param2":plan_id,"param3":$("#"+mod+"_nombre_plan").val(),"param4":jsonString,"tipo":"autocomplete"},
                            url: $(window).data('base_url_index')+"/globales/json",
                            cache: true,
                            dataType: "json",
                            success: function(datos)
                                   {

                                            $.each(datos, function(i,item)
                                            {
                                                if(item.save==1)
                                                {
                                                    $("form").submit()
                                                };
                                                
                                                
                                            });
                                   }
                        });
                    }
                }

            }
        });



        
        
        $("#"+mod+"_costo_plan").attr("disabled", "disabled");
        


        $('#tbPlanes tbody ').on( 'click', 'tr', function ()
        {
            $('#tbPlanes tbody tr').removeClass("row_selected");
            $(this).addClass('row_selected');
            trid=$(this).attr("id");
            
        });
        

      
        
        $.AutoCompletecallBack=function(element)
        {
            
            $("#"+mod+"_pacientes_bsq").attr("disabled","disabled");
            paciente_id=element.data;
            
            $("#"+mod+"_nombre").val(element.nombres);
            
            $("#tbPlanes").data("paciente_id", element.data);
            $.ajax({
                    type: "post",
                    data:{"mod":"recepcion/admision","fn":"AddItemsPlans","cnt":"1","param1":element.data,"tipo":"autocomplete"},
                    url: $(window).data('base_url_index')+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {
                                    
                                    $.each(datos, function(i,item)
                                    {
   
                                    });

                           }
                });
                
            
        }

        $.onInvalidateSelection=function(element)
        {
            paciente_id=-1;
            $("#admision_model_nombre").val("");
            $("#btn_seleccionar").attr("disabled","disabled");
        }
        
        $.onNotSuggestion=function(element)
        {
            paciente_id=-1
            $("#btn_seleccionar").attr("disabled","disabled");
            $("#admision_model_nombre").val("");
            if(confirm("Registrar Paciente"))
            {
                
                action=$("form#form_admision_model").attr("action")
                $("form#form_admision_model").attr("action",action+"/redireccionar/1");
                $("form#form_admision_model").submit();
            }
        }


        $('#'+mod+'_pacientes_bsq').autocomplete({
                serviceUrl:$(window).data('base_url_index')+"/globales/autocomplete/",
                type: "post",
                params: { modelo:'recepcion/admision_model',fn:"autocompletePacientes"},
                onSelect: $.AutoCompletecallBack,
                onInvalidateSelection : $.onInvalidateSelection,
                showNoSuggestionNotice:true,
                onNotSuggestion:$.onNotSuggestion
        });
        
        
        
    });



        var table;
        

        


    $(document).ready(function() {

        var base_url;
        var myWindow;
        var ver1;

        var imgBorrar='<img class="delete" width="15px" src="'+$(window).data("base_url_img")+'/icons/delete.png" alt="Eliminar Registro" title="Eliminar Registro" style="margin-left: 1px">';
        var imgAgendar='<img class="cal" width="15px" src="'+$(window).data("base_url_img")+'/icons/calendar.png" alt="Agendar" title="Agendar" style="margin-left: 2px"/>';
        var imgApply='<img  width="15px" src="'+$(window).data("base_url_img")+'/iconos/apply.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var inputCnt='<input type="text" id="input_cant" style="width: 60px" maxlength="3" size="10" class="req_integer input_cant" name="solicitud_model[cnt]" value="1"  autocomplete="off">';
        var imgOpciones=imgAgendar+imgApply;


        $.inicializar=function(){
        
    $.servCompleteCallBack=function(element)
    {
        
               $.ajax({
                    type: "post",
                    data:{"mod":"recepcion/solicitud","fn":"AddItems","cnt":"1","param1":element.data,"tipo":"autocomplete"},
                    url: $(window).data("base_url_index")+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {
                                    $.each(datos, function(i,item)
                                    {
                                        

                                        var rowNode = table.row.add( [imgBorrar,item.nombre,FloatTomonedaBsf(item.precio),inputCnt,FloatTomonedaBsf(item.precio),imgOpciones]).draw().node();
                                        $(rowNode).attr("id",item.id);
                                        $("#tbServicios").list().addRow(item.id, new Array(["items",[item.nombre]],["cant",[1]],["precio",FloatTomonedaBsf(item.precio)],["color",item.color],["agendado",[0]]),$.listAddRow);
                                        $("tr#"+item.id+" input[type='text']").attr("id","tbServicios_input_"+item.id);
                                        
                                        $("#"+mod+"_costo_plan").list().addRowOverWrite(item.id, new Array(["precio",item.precio]));
                                        $.fnCmpCosto();
                                    });

                                    $(".req_integer").keypress(function(evnt)
                                    {
                                        return validar(evnt,numeros);
                                    });

                                     $('.input_cant').on( 'change', function (e) {

                                         if($(this).val()==0 || emptytxt($(this).val()))
                                         {
                                             $(this).val(1);
                                         }
                                         var id=$(this).parent().parent().attr("id");
                                         $("#tbServicios").list().setColumn(id, "cant", new Array($(this).val()),$.listSetColumn);
                                         var precio=$("#tbServicios").list().getColumn(id, "precio");
                                         var costo=BsToFloat(precio)*$(this).val();
                                         $("tr#"+id+" td:eq(4)").html(FloatTomonedaBsf(costo));
                                         $("#"+mod+"_costo_plan").list().addRowOverWrite(id, new Array(["precio",costo]));
                                         $.fnCmpCosto();
                                         

                                     });

                           }
                });
            $("#planes_model_servicios_bsq").val("");
        


    }

    $.fnCmpCosto=function()
    {
        ids=$("#"+mod+"_costo_plan").list().getIds();
        $("#"+mod+"_costo_plan").val("");
        var costo=0;
        for(var i=0;i<ids.length;i++)
        {
            costo=costo+$("#"+mod+"_costo_plan").list().getColumn(ids[i], "precio");
        }
        $("#"+mod+"_costo_plan").val(costo)
    }

    $.listAddRow=function(_index_,_id_,_data_)
    {
         if($(document).data("ObjWCalendar")!="false")
         {
            
             $(document).data("ObjWCalendar").$.agregarLstServicios(_id_,_data_[0][1],_data_[1][1],_data_[2][1]);

         }
    }

    $.listSetColumn=function(_index_,_id_,_column_,_value_)
    {
        
        if($(document).data("ObjWCalendar")!="false")
         { 
             $(document).data("ObjWCalendar").$.changeListServ(_id_,_value_);

         }
    }

    $.listRemoveColumn=function(_id_)
    {

        if($(document).data("ObjWCalendar")!="false")
         {
             $(document).data("ObjWCalendar").$.changeListServ(_id_,_value_);

         }
    }



    $.encontrarRowId=function(datatable,objSource)
    {
        var data= new Array();

        data[0]=datatable.row($(objSource).parents('tr'));
        data[1]=data[0].nodes().to$().attr("id");
        return data;
    }

    



    }

        $.inicializar();
        
         $(window).on('beforeunload', function(event){
                $(document).data("ObjWCalendar").close();
         });

        table = $("#tbServicios").DataTable({"sScrollY": 300,"bJQueryUI": true,"bPaginate":false});
        
        $.list=$("#tbServicios").list();

        $(".divsolicitudes").show();
        $(".divsolicitudes").hide();
        $(".open_servicios").on("click",function()
        {
            $(".divplanes").hide();
            $(".divsolicitudes").show();
            table.draw();
            
        });
        
        $(".open_planes").on("click",function()
        {
            $(".divplanes").show();
            $(".divsolicitudes").hide();

            table.draw();
        });





        $(document).data({"ObjWCalendar":"false"});
        
        var idTr=0
        $(".agregar").on("click",function(){
                $('#addRow').click();
        });





        $('#tbServicios tbody').on( 'click', 'img.delete', function () {
               var row= $.encontrarRowId(table,$(this));
               row[0].remove().draw();

               if($(document).data("ObjWCalendar")!="false")
               {
                   $("#tbServicios").list().removeRow(row[1],$(document).data("ObjWCalendar").$.removeListServ(row[1]));
               }else
               {
                   $("#tbServicios").list().removeRow(row[1]);
               }
               $("#"+mod+"_costo_plan").list().removeRow(row[1]);
               $.fnCmpCosto();
               
               

        });

        $('#tbServicios tbody').on( 'click', 'img.cal', function () {

                var row= $.encontrarRowId(table,$(this));
                $(document).data({"idServicio":row[1]});


               if($(document).data("ObjWCalendar")!="false")
               {
                   $(document).data("ObjWCalendar").close();
                   
               }
               myWindow = window.open($(window).data('base_url_index')+"/recepcion/agendar", "Agendar");
               $(myWindow).data("plan_id",$(document).data("plan_id"));
               $(document).data({"ObjWCalendar":myWindow});

        });

        $.paramsOnChangeValue=function()
        {
            var ids=$("#tbServicios").list().getIds();
            var string_ids="";
            if(ids.length>0){
                for(i=0;i<ids.length;i++)
                {
                    if(i==0)
                    {
                        string_ids=ids[i];
                    }else
                    {
                        string_ids=string_ids+","+ids[i];
                    }
                }
                return {"json[servicios_id]":string_ids};
            }
                return {};
            
        };
        
        $('#'+mod+'_servicios_bsq').autocomplete({
            serviceUrl:$(window).data('base_url_index')+"/globales/autocomplete/",
            type: "post",
            params: { modelo:'recepcion/solicitud_model',fn:"autocompleteServicio"},
            paramsOnChangeValue:$.paramsOnChangeValue,
            onSelect: $.servCompleteCallBack
        });

        

        $.wCalendarOpened=function()
        {
            return $(document).data("idServicio");
        };

        $.wCalendarCerrar=function()
        {
            $(document).data({"ObjWCalendar":"false"});
        };


        




       
});


</script>





<? echo form_close() ?>