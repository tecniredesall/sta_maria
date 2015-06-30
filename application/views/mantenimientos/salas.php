
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Mantenimientos Salas</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>Identificación:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'identificacion')); ?></td>
                </tr>
                <tr>
                    <td>Cantidad de Personas:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt numeros form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cant')); ?></td>
                </tr>
                <tr>
                    <td>Espacio Fisico:</td>
                    <td><span>Si:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'fijo')); ?>&nbsp;&nbsp;<span>No:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'f',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'fijo')); ?></td>
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

