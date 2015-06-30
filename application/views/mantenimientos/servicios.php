
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Mantenimientos Servicios</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>Precio:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_moneda form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'precio')); ?></td>
                </tr>
              
               
                <tr>
                    <td>Tiempo Realización:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Horas</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/horas",array("id","hora")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'horas_id',"guardar"=>TRUE)); ?></td>
                    <td>Minutos</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/minutos",array("id","minutos")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'minutos_id',"guardar"=>TRUE)); ?></td>
                </tr>
                 <tr>
                    <td>Descripción:</td>
                    <td><?php echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'descripcion')); ?></td>
                </tr>
                
                
               
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
            </div>
<? echo form_close() ?>
    <?php
            table_crud_basico();
    ?>
<a onclick="ok()">Cerrar</a>
<script>
  
    
    function ok()
    {
        $("#servicios_model_nombre").val("catt");
    }
</script>