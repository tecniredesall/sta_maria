
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Agregar Entidades Adscritas</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>Rif:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'rif')); ?></td>
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
    <?php
            table_crud_basico();
    ?>

