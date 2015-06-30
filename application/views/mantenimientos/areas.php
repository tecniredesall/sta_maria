
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Mantenimientos Areas</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
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

