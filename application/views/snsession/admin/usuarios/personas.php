
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_personas', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Datos Basicos</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Cedula:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt mask_cedula form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cedula')); ?></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombres')); ?></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'apellidos')); ?></td>
                </tr>
                <tr>
                    <td>Fecha Nacimiento:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_fecha form','size' => '10', 'maxlength' => '10'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'fecha_nac')); ?></td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td><span>Masculino:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'sexo')); ?>&nbsp;&nbsp;<span>Femenino:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'f',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'sexo')); ?></td>
                </tr>
                <tr>
                    <td>Teléfono Celular:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt telefono form', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'tlf_celular')); ?></td>
                </tr>
                <tr>
                    <td>Teléfono Local:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt telefono form', 'maxlength' => '20'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'tlf_local')); ?></td>
                </tr>
                <tr>
                    <td>Correo Electrónico:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_email form', 'maxlength' => '90'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'correo')); ?></td>
                </tr>
                <tr>
                    <td>Twiter:</td>
                    <td><?php echo form_input_autoload(array("class"=>'alfa form', 'maxlength' => '100'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'twitter')); ?></td>
                </tr>
                <tr>
                    <td>Facebook:</td>
                    <td><?php echo form_input_autoload(array("class"=>'alfa form', 'maxlength' => '100'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'facebook')); ?></td>
                </tr>
                <tr>
                    <td>Trabaja:</td>
                    <td><span>Si:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'trabaja')); ?>&nbsp;&nbsp;<span>No:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'f',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'trabaja')); ?></td>
                </tr>
                <tr>
                    <td>Ocupacion:</td>
                    <td><?php echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'profesion_otra')); ?></td>
                </tr>
                <tr>
                    <td>Intituto de Procedencia:</td>
                    <td><?php echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'instituto_otra')); ?></td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td><?php $estado=form_dropdown_autoload(array("mantenimientos/estados",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'estados_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/ciudades",array("id","valor"),"getCiudades",array("padre_id"=>$estado['value'])), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'ciudades_id',"guardar"=>TRUE),$estado); ?></td>
                </tr>
                <tr>
                    <td>Municipio:</td>
                    <td><?php $municipio=form_dropdown_autoload(array("mantenimientos/municipios",array("id","valor"),"getMunicipios",array("padre_id"=>$estado['value'])), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'municipios_id',"guardar"=>TRUE),$estado); ?></td>
                </tr>
                <tr>
                    <td>Parroquia:</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/parroquias",array("id","valor"),"getParroquias",array("padre_id"=>$municipio['value'])), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'parroquias_id',"guardar"=>TRUE),$municipio); ?></td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td><?php echo form_textarea_autoload(array("class"=>'','size' => '20', 'maxlength' => '250'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'direccion')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
            </div>
<? echo form_close() ?>
    

