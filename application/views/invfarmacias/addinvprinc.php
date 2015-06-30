
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar productos A Inventarios Principales</span>
                <hr class="hr_titulo_formulario"/>
            </div>
                   <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">
                
                <tr>
                    <td width="5%"></td>
                    <td>Inventario</td>
                    <td><?php form_dropdown_autoload(array("invfarmacias/confinvprincipal",array("id","nombre")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'conf_inv_principal_id',"guardar"=>TRUE)); ?></td>

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
                    <td><?php echo form_input_autoload(array("class"=>'req_integer  form','size' => '40', 'maxlength' => '4',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'total')); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Cancelar')); ?></td>
                </tr>
            </table>
                   
            </div>



           



<div  class="divproductos" >
    <table id="tbProductos" cellpadding="0" cellspacing="0" border="0" class="display">
    <thead>

        <th style="width: 10%" class="cantidad">Check</th>
        <th style="width: 45%">Items</th>
        <th style="width: 15%"> Costo Unidad</th>
        <th style="width: 10%" class="cantidad">Cantidad</th>
        <th style="width: 20%" class="total">Total</th>
    </thead>
    <tbody>
    </tbody>

</table>
</div>

<? echo form_close() ?>

<script>
var row;
    $(document).ready(function() {
        var model='<?php echo instancia_controller()->modelo?>';
        var datos=<?php echo $datatabla?>;
        var inputCnt='<input type="text" id="input_cant" style="width: 60px" maxlength="3" size="10" class="req_integer input_cant" name="'+model+'[cnt]" value="0"  autocomplete="off" disabled=disabled>';
        var inputCheck='<input type="checkbox" cntchecks="1" grupo="grp0" class="req_check fnClick" name="'+model+'[seleccion]">';
        var table = $("#tbProductos").DataTable({"sScrollY": 300,"bJQueryUI": true,"bPaginate":false});
        $.each(datos, function(i,item)
        {
            
            var rowNode = table.row.add( [inputCheck,item.cod_unico,item.nombre,item.descripcion,inputCnt]).draw().node();
            $(rowNode).attr("id",item.id);
            $("tr#"+item.id+" input[type='text']").attr("id","tbServicios_input_"+item.id);
            $("tr#"+item.id+" input[type='checkbox']").val(item.id);
            var txt=$("tr#"+item.id+" input[type='text']");
            var check=$("tr#"+item.id+" input[type='checkbox']");

            check.attr("name",model+'[seleccion]'+'['+item.id+']');
            txt.attr("name",model+'[cnt]'+'['+item.id+']');

            txt.keyup(function(event)
            {
                if(enterTab(event))
                {
                    if(!emptytxt(txt.val()))
                    {
                        calcularCantItems();
                    }
                }
            });


            txt.blur(function(event)
            {
                    if(!emptytxt(txt.val()))
                    {
                        calcularCantItems();
                        
                    }
            });




        });

        function calcularCantItems()
        {
            var total=0;
            $("#tbProductos input[type='text']").each(function()
            {
                total=parseInt(total)+parseInt($(this).val());
            });
            $("input[type='text']#inventarios_model_total").val(total);
        }

        
        

        $("#tbProductos input[type='checkbox'].fnClick").on("change",function(event){

            
            var row=$(this).parent().parent();
            var id=row.attr("id");
            var txt=$("tr#"+id+" input[type='text']");
            
            
            if ( row.hasClass("row_selected") ) {
                row.removeClass("row_selected");
                txt.removeClass("Error");
                txt.attr("disabled","disabled");
                txt.val(0);
            }
            else {

                txt.removeAttr("disabled");
                txt.val("");
                row.addClass("row_selected");
                
            }
        });

    });


</script>


