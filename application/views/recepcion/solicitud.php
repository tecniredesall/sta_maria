
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Solicitudes</span>
                <hr class="hr_titulo_formulario"/>
            </div>
             <table align="center" cellpadding="3" cellspacing="3"  style="width: 100%">
                <tr>
                    <td style="width: 40px">Busqueda:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form  autocomplete','size' => '40', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'bsq')); ?></td>
                    <td></td>
                </tr>
                
            </table>
            </div>
<table id="tbServicios" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>
        <th style="width: 3%"></th>
        <th style="width: 45%">Items</th>
        <th style="width: 15%"> Costo Unidad</th>
        <th style="width: 10%">Cantidad</th>
        <th style="width: 20%">Total</th>
        <th style="width: 7%"></th>
    </thead>
    <tbody>
    </tbody>
    
</table>



<script type="text/javascript">

    
        
        var table;
        var base_url;
        var myWindow;
        var ver1;
        
        var imgBorrar='<img class="delete" width="15px" src="http://localhost/sta_maria/img/icons/delete.png" alt="Eliminar Registro" title="Eliminar Registro" style="margin-left: 1px">';
        var imgAgendar='<img class="cal" width="15px" src="http://localhost/sta_maria/img/icons/calendar.png" alt="Agendar" title="Agendar" style="margin-left: 2px"/>';
        var imgApply='<img  width="15px" src="http://localhost/sta_maria/img/iconos/apply.png" alt="Agendado" title="Agendado" style="margin-left: 2px"/>'
        var inputCnt='<input type="text" id="input_cant" style="width: 60px" maxlength="3" size="10" class="req_txt numeros form input_cant" name="solicitud_model[cnt]" value="1"  autocomplete="off">';
        var imgOpciones=imgAgendar+imgApply;


        
    $(document).ready(function() {

         $(window).on('beforeunload', function(event){
                $(document).data("ObjWCalendar").close();
         });

        table = $("#tbServicios").DataTable({"sScrollY": 300,"bJQueryUI": true,"bPaginate":false});
        $.list=$("#tbServicios").list();

        $(document).data({"ObjWCalendar":"false"});
        base_url=$(this).data('base_url');
        var idTr=0
        $(".agregar").on("click",function(){
                $('#addRow').click();
        });
        
       
        
       
    
        $('#tbServicios tbody').on( 'click', 'img.delete', function () {
               var row= $.encontrarRowId(table,$(this));
               row[0].remove().draw();
               $("#tbServicios").list().removeRow(row[1]);
               
        });
    
        $('#tbServicios tbody').on( 'click', 'img.cal', function () {
                
                var row= $.encontrarRowId(table,$(this));
                $(document).data({"idServicio":row[1]});
                
                
               if($(document).data("ObjWCalendar")=="false")
               {
                   myWindow = window.open(base_url+"/recepcion/agendar", "Agendar");
                   $(document).data({"ObjWCalendar":myWindow});
                   
               }
        });
        
        $('#solicitud_model_bsq').autocomplete({
            serviceUrl:$(this).data('base_url')+"/globales/autocomplete/",
            type: "post",
            params: { modelo:'recepcion/solicitud_model',fn:"autocompleteServicio"},
            onSelect: $.AutoCompletecallBack
            
        
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
    
    
    
        
        
    
    $.AutoCompletecallBack=function(element)
    {
        
        if(emptytxt(element.value))
        {
            $(this).data({"AutoCompldata_old":-1})
        }else
        {
            if($(this).data("AutoCompldata_old")!=element.data)
            {
                $(this).data({"AutoCompldata_old":element.data});

                $.ajax({
                    type: "post",
                    data:{"mod":"recepcion/solicitud","fn":"AddItems","cnt":"1","param1":element.data,"tipo":"autocomplete"},
                    url: base_url+"/globales/json",
                    cache: true,
                    dataType: "json",
                    success: function(datos)
                           {
                                    $.each(datos, function(i,item)
                                    {  
                                        var rowNode = table.row.add( [imgBorrar,item.nombre,item.precio,inputCnt,item.precio,imgOpciones]).draw().node();
                                        $(rowNode).attr("id",item.id);
                                        $("#tbServicios").list().addRow(item.id, new Array(["items",[item.nombre]],["cant",[1]],["color",item.color],["agendado",[0]]),$.listAddRow);
                                        //$(document).data();
                                    });
                                    
                                    $(".numeros").keypress(function(evnt)
                                    {
                                        return validar(evnt,numeros);
                                    });

                                     $('.input_cant').on( 'change', function (e) {
                                         id=$(this).parent().parent().attr("id");
                                         $("#tbServicios").list().setColumn(id, "cant", new Array($(this).val()),$.listSetColumn);
                                         

                                     });

                           }
                });
                
            }
            $("#solicitud_model_bsq").val("");
        }
        

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

    
    
    $.encontrarRowId=function(datatable,objSource)
    {
        var data= new Array();
        data[0]=datatable.row($(objSource).parents('tr')); 
        data[1]=data[0].nodes().to$().attr("id");
        return data;
    }
    
   
       
       
     
       
       
       
  

    
    
  
    
   

</script>



<? echo form_close() ?>


 
