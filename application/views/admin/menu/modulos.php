
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('name' => 'form_alumno', 'id' => 'form_alumno', 'autocomplete' => "off")) ?>

            <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Menu&nbsp;( 1 Nivel ) </span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alafa form','size' => '40', 'maxlength' => '30'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>titulo</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '100'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'titulo')); ?></td>
                </tr>
                <tr>
                    <td>Tiene Panel</td>
                    <td><?php echo form_checkbox_autoload(array("class"=>"","grupo"=>"grptipo","cntchecks"=>"0"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'isprog')); ?></td>
                </tr>
                <tr>
                    <td>Panel</td>
                    <td><?php echo form_input_autoload(array("class"=>'alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'panel')); ?></td>
                </tr>
                <tr>
                    <td>orden</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt numeros form','size' => '40', 'maxlength' => '6'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'orden')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array( 'class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
            </div>

        
<? echo form_close() ?>

    <?php
            table(array("Nombre"=>"nombre","Titulo"=>"titulo","Panel"=>"panel"),array(),$datatabla,'id_data_table',array("eliminar"=>array(),"actualizar"=>array()));
    ?>
