<?php
    if($proceso_ins=="E")
    {
        $script="
             parent.window.document.location.reload();
        ";
        instancia_controller()->addjscss_lib->agregar_script($script);
    }else{
?>

<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

            <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Crear Curso</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Turno:</td>
                    <td><?php $turno=form_dropdown_autoload(array("mantenimientos/turnos",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'turnos_id',"guardar"=>TRUE)); ?></td>
                </tr>
                
                <tr>
                    <td>Profesor:</td>
                    <td><?php form_dropdown_autoload(array("registro/profesores",array("id","valor"),'getCmbProfesores',array("cmpBsq"=>$turno['value'],"profesores_id"=>instancia_controller()->profesores_id,"fecha_inicio"=>instancia_controller()->fecha_inicio,"fecha_fin"=>instancia_controller()->fecha_fin)), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'profesores_id',"guardar"=>TRUE),$turno); ?></td>
                </tr>
                <tr>
                    <td>Espacios:</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/espacios",array("id","valor"),'getCmbEspaciosLibres',array("cmpBsq"=>$turno['value'],"espacios_id"=>instancia_controller()->espacios_id,"fecha_inicio"=>instancia_controller()->fecha_inicio,"fecha_fin"=>instancia_controller()->fecha_fin)), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'espacios_id',"guardar"=>TRUE),$turno); ?></td>
                </tr>
                <tr>
                    <td>Curso a Elejir:</td>
                    <td><?php form_dropdown_autoload(array("infocursos/desccursos",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'desc_cursos_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
                
            </div>
<? echo form_close() ?>
<?php }?>






