
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_submodulos', 'autocomplete' => "off")) ?>

            <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Permisos de roles</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Rol:</td>
                    <td><?php form_dropdown_autoload(array("admin/menu/rol",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'rol_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Modulo:</td>
                    <td><?php $modulos=form_dropdown_autoload(array("admin/menu/modulos",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'menumodulos_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>SubModulos:</td>
                    <td><?php $submodulos=form_dropdown_autoload(array("admin/menu/submodulos",array("id","valor"),"submodulos",array("padre_id"=>$modulos['value'])), array(),'class=""',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'menusubmodulos_id',"guardar"=>TRUE),$modulos); ?></td>
                </tr>
                <tr>
                    <td>Programas:</td>
                    <td><?php form_dropdown_autoload(array("admin/menu/programas",array("id","valor"),"getProgramas",array("padre_id"=>$submodulos['value'])), array(),'class=""',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'menuprogramas_id',"guardar"=>TRUE),$submodulos); ?></td>
                </tr>
                <tr>
                    <td>Permisos:</td>
                    <td>Agregar<?php echo form_checkbox_autoload(array("class"=>"","grupo"=>"grptipo","cntchecks"=>"0"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'agregar')); ?>&nbsp;Modificar<?php echo form_checkbox_autoload(array("class"=>"","grupo"=>"grptipo","cntchecks"=>"0"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'modificar')); ?>&nbsp;Eliminar<?php echo form_checkbox_autoload(array("class"=>"","grupo"=>"grptipo","cntchecks"=>"0"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'eliminar')); ?></td>
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


        
