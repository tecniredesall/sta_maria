
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Salida de Solicitudes</span>
                <hr class="hr_titulo_formulario"/>
            </div>
                   <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">
                
                <tr>
                    <td width="5%"></td>
                    <td>Solicitudes</td>
                    <td><?php form_dropdown_autoload(array("invfarmacias/solicitudes",array("id","salas_id")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'sol_salas_id',"guardar"=>TRUE)); ?></td>

                </tr>

                   </table>
                <div class="div_encabezado_formulario" >
                    <hr class="hr_titulo_formulario"/>
                </div>
                <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">

                
                <tr>
                    <td height="10px"></td>
                 </tr>
                <tr align="left">
                    <td width="5%"></td>
                    <td width="15%"></td>
                    <td width="30%">Total Productos Agregados</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_integer  form','size' => '40', 'maxlength' => '4',"disabled"=>"disabled"),'0','',array('modelo'=>instancia_controller()->modelo,'name'=>'total')); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="center"><br/><?php echo form_submit(array('class' => 'btn_save', 'id' => 'btn_enviar', 'value' => 'Pagar', 'type' => 'button')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Cancelar')); ?></td>
                </tr>
            </table>
                   
            </div>



           



<div  class="divproductos" >
    <table id="tbProductos" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>

        <th style="width: 10%" class="cantidad">Check</th>
        <th style="width: 45%">Items</th>
        <th style="width: 15%"> Costo Unidad</th>
        <th style="width: 10%" class="cantidad">Unidades Solicitadas</th>
        <th style="width: 10%" class="cantidad">Unidades Entregadas</th>
    </thead>
    <tbody>
    </tbody>

</table>
</div>
<div class="modal_div modalmask" >
    <div class="formulario modal_div_interno">
        <table id="tbProductosDetalles" cellpadding="0" cellspacing="0" border="0" class="display">
        <thead>
            <th style="width: 10%" class="">Check</th>
            <th style="width: 30%" class="">Producto</th>
            <th style="width: 10%">Marca</th>
            <th style="width: 10%">Empaque</th>
            <th style="width: 10%">U. Empaque</th>
            <th style="width: 10%">Medida</th>
            <th style="width: 10%" class="">Existencia Empaques</th>
            <th style="width: 10%" class="">Existencia Unidades</th>
            <th style="width: 10%" class="">txt</th>
            
        </thead>
        <tbody>
            <th style="width: 10%" class="">Check</th>
            <th style="width: 30%" class="">Producto</th>
            <th style="width: 10%">Marca</th>
            <th style="width: 10%">Empaque</th>
            <th style="width: 10%">U. Empaque</th>
            <th style="width: 10%">Medida</th>
            <th style="width: 10%" class="">Existencia Empaques</th>
            <th style="width: 10%" class="">Existencia Unidades</th>
            <th style="width: 10%" class="">txt</th>
        </tbody>

        </table>
    </div>
</div>

<? echo form_close() ?>

<script>
 var jsonString;
    $(document).ready(function() {
        var model='<?php echo instancia_controller()->modelo?>';
        var datos=<?php echo $datatabla?>;
        var inputCnt='<input type="text" id="input_cant" style="width: 60px" maxlength="3" size="10" class="req_integer input_cant" name="'+model+'[cnt]" value="0"  autocomplete="off" disabled=disabled>';
        var inputCheck='<input type="checkbox" cntchecks="1" grupo="grp0" class="req_check fnClick" name="'+model+'[seleccion]">';
        var table = $("#tbProductos").DataTable({"sScrollY": 300,"bJQueryUI": true,"bPaginate":false});
        var table2 = $("#tbProductosDetalles").DataTable({"sScrollY": 250,"bJQueryUI": true,"bPaginate":false,
            "columns": 
            [
                { "data": "check" },
                { "data": "producto" },
                { "data": "marca" },
                { "data": "empaque" },
                { "data": "cnt_empaque" },
                { "data": "medida" },
                { "data": "empaque_final" },
                { "data": "unidad_final" },
                { "data": "txt" },

            ]
        });
        table2.clear().draw();
        function cal_ItemEmpty (event,obj,values)
        {
            
        }

        function calcularCantItems(event,obj,values)
        {
            var row=$(obj).closest("tr");
            var u_final=parseInt(row.find("td").eq(6).html());

            var prd_id=$("#tbProductosDetalles").data("prd_id");
            var tdcant=$("#tbProductos tr#"+prd_id+" td");
            var cnt_sol=$("#tbProductosDetalles").list().getColumn(prd_id, "cnt_sol");


            var total=0;
            $("#tbProductosDetalles tr td input[type='text']").each(function()
            {
                total=parseInt(total)+parseInt($(this).val());
            });
            
            //alert("total:"+total+" inventario"+u_final+" solicitud:"+cnt_sol);
            

            if(u_final<$(obj).val())
            {
                alert("Debe Ingresar una cantidad menor o igual al del Inventario");
                $(obj).val(0);
                return;
            }else
            {
                
                if((cnt_sol-total)<0)
                {
                    alert("Debe Ingresar una cantidad menor al de la solicitud");
                    $(obj).val(0);
                    return;
                }
            }
            
           
        }

        function cantProductos()
        {
            var total=0;
            $("#tbProductos tr td input[type='text']").each(function()
            {
                total=parseInt(total)+parseInt($(this).val());
            });
            $("input[type='text']#inventarios_model_total").val(total);
            
        }
        
        $(".modal_div").hide();
        $.each(datos, function(i,item)
        {
            
            var rowNode = table.row.add( [inputCheck,item.cod_unico,item.nombre,item.cant_unidades,inputCnt]).draw().node();
            $(rowNode).attr("id",item.id);
            $("tr#"+item.id+" input[type='text']").attr("id","tbServicios_input_"+item.id);
            $("tr#"+item.id+" input[type='checkbox']").val(item.id);
            var txt=$("tr#"+item.id+" input[type='text']");
            var check=$("tr#"+item.id+" input[type='checkbox']");

            check.attr("name",model+'[seleccion]'+'['+item.id+']');
            //check.addClass("button_modal_div");
            txt.attr("name",model+'[cnt]'+'['+item.id+']');
        });

        

        function OnUnSelect(event,Obj,row,id)
        {
             var txt=$("tr#"+id+" input[type='text']");
             txt.removeClass("Error");
             txt.attr("disabled","disabled");
             txt.val(0);
        }

        function OnSelect(event,Obj,row,id)
        {
            var txt=$("tr#"+id+" input[type='text']");
            txt.removeAttr("disabled");
            txt.val("");
        }

        
        function tbProdOnUnselect(event,Obj,row,id)
        {
                $("#tbProductos tr#"+id+" td").list().removeData();
                row.find("input[type='text']").val("0");
                cantProductos();
                
        }

        function tbProdOnSelect(event,Obj,row,id)
        {
            cargarInventario(event,row,id);
        }

    checkTable("#tbProductos input[type='checkbox'].fnClick",tbProdOnSelect,tbProdOnUnselect);
        




        
        

      
        


        function cargarInventario(event,row,producto_id)
        {
            
            
            table2.clear().draw();
            ajaxJson({"mod":"invfarmacias/inventarios","fn":"fnInventarioProd","cnt":"1","param1":producto_id,"tipo":"modaltabla"},onReady,null,onEach);

             function onReady(status)
             {
                 if(status=="success"){
                     
                     $("#tbProductosDetalles").data("prd_id",producto_id);
                     $("#tbProductosDetalles").list().addRowOverWrite(producto_id, new Array(["prd_id",producto_id],["cnt_sol",row.find("td").eq(3).html()]))

                    modalDiv(event);
                    checkTable("#tbProductosDetalles input[type='checkbox'].fnClick",OnSelect,OnUnSelect);
                    table2.draw();
                 }
             }

             function onEach(i,item)
             {

                
                var rowNode = table2.row.add({"check":inputCheck,"producto":item.nombre,"marca":item.marca,"empaque":item.empaque,"cnt_empaque":item.cant_empaque,"medida":item.medida+item.medida_parcial,"empaque_final":item.cant_empaque_final,"unidad_final":item.cant_unidades_total_final,"txt":inputCnt} ).draw().node();
                $(rowNode).attr("id",item.prod_detalles_id);
                var txt=$("tr#"+item.prod_detalles_id+" input[type='text']");
                var check=$("tr#"+item.prod_detalles_id+" input[type='checkbox']");
                txt.attr("id","tbServicios_input_"+item.prod_detalles_id);
                check.val(item.id);
                
                var tdcant=$("#tbProductos tr#"+producto_id+" td");
                if(tdcant.list().getIndex(item.prod_detalles_id)!=-1)
                {
                    txt.val(tdcant.list().getColumn(item.prod_detalles_id,"cant"));
                }
                
                changeTxt(txt,calcularCantItems,cal_ItemEmpty,item.prod_detalles_id);
             }

        }

        inizializateParams(null,function()
        {

            var tb_det=$("#tbProductosDetalles");
            var td_prd=$("#tbProductos");
            var prd_id=tb_det.data("prd_id");
            var data=td_prd.find("tr#"+prd_id+" td");
            var total=0;

            tb_det.find("input[type='text']").each(function()
            {
                var row=$(this).closest("tr");
                var id=row.attr("id");
                if(emptytxt($(this).val()) || parseInt($(this).val())==0)
                {
                        data.list().removeRow(id, null)
                }else
                {
                    data.list().addRowOverWrite(id, new Array(["prd",prd_id],["cnt",parseInt($(this).val())]));
                    total=parseInt(total)+parseInt($(this).val());
                }
            });
            
            if(total==0)
            {
                td_prd.find("tr#"+prd_id+" input[type='checkbox'].fnClick").prop('checked', false);
                td_prd.find("tr#"+prd_id+" input[type='checkbox'].fnClick").change();
            }else
            {
                data.find("input[type='text']").val(total);
                cantProductos();
            }
        });

        $(".btn_save").on("click",function(event)
        {

            var onReady=function (status)
            {

            }

            var onfnData=function (data)
            {
                alert(data[0].act)
            }

            var params=[];
            $("#tbProductos tr").each(function(item)
            {
                var trid=$(this).attr("id")
                if(trid!=null)
                {
                    var array = [];
                    var ids=$("#tbProductos tr#"+trid+" td").list().getIds();
                    if(ids.length>0){
                        for(var i=0;i<ids.length;i++)
                        {
                            var cnt=$("#tbProductos tr#"+trid+" td").list().getColumn(ids[i], "cnt");
                            //alert("dt"+ids[i]+" cnt"+cnt);
                            array.push({"dets":ids[i],"cnt":cnt});
                        }
                        params.push(({"prd_id":trid,"inv":array}));
                    }
                }
            });
            

            ajaxJson({"mod":"invfarmacias/inventarios","fn":"saveSalInvPrin","cnt":"2","param1":1,"param2":params,"tipo":"modaltabla"},onReady,onfnData,null);
        });
        

    });







   



</script>


