
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_usuarios', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Usuarios</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Usuario:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'usuario')); ?></td>
                </tr>
                <tr>
                    <td>Clave:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '16',"type"=>"password"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'clave')); ?></td>
                </tr>
                <tr>
                    <td>Reescriba Clave:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '16',"type"=>"password"),'','',array('name'=>'clave1')); ?></td>
                </tr>
                <tr>
                    <td>Pregunta Secreta 1:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'pregunta1')); ?></td>
                </tr>
                <tr>
                    <td>Respuesta Secreta 1:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'respuesta1')); ?></td>
                </tr>
                <tr>
                    <td>Pregunta Secreta 2:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'pregunta2')); ?></td>
                </tr>
                <tr>
                    <td>Respuesta Secreta 1:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'respuesta2')); ?></td>
                </tr>
                <tr>
                    <td>Rol:</td>
                    <td><?php form_dropdown_autoload(array("admin/menu/rol",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'rol_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
            </div>
<? echo form_close() ?>
    

