
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_submodulos', 'autocomplete' => "off")) ?>

            <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Menu&nbsp;(3 Nivel)</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Modulo:</td>
                    <td><?php $modulos=form_dropdown_autoload(array("admin/menu/modulos",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'menumodulos_id',"guardar"=>FALSE)); ?></td>
                </tr>
                <tr>
                    <td>SubModulos:</td>
                    <td><?php form_dropdown_autoload(array("admin/menu/submodulos",array("id","valor"),"submodulos",array("padre_id"=>$modulos['value'])), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'menusubmodulos_id',"guardar"=>TRUE),$modulos); ?></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '30'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>titulo</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '100'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'titulo')); ?></td>
                </tr>
                <tr>
                    <td>Tiene Panel:</td>
                    <td><?php echo form_checkbox_autoload(array("class"=>"","grupo"=>"grptipo","cntchecks"=>"0"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'isprog')); ?></td>
                </tr>
                <tr>
                    <td>Panel:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'panel')); ?></td>
                </tr>
                <tr>
                    <td>orden:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt numeros form','size' => '40', 'maxlength' => '6'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'orden')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
            </div>
<? echo form_close() ?>

    <?php
            table($campos,array(),$datatabla,'id_data_table',array("eliminar"=>array(),"actualizar"=>array()));
    ?>


        
