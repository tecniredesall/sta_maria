
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Farmacia - Productos</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>Categoria</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/categorias",array("id","categoria")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'categorias_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <!--<tr>
                      <td>Sub-Categoria</td>
                    <td><?php //form_dropdown_autoload(array("mantenimientos/subcategorias",array("id","minutos")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'subcategorias_id',"guardar"=>TRUE)); ?></td>
                </tr>-->
                <tr>
                    <td>Tipo de Medida</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/medidas",array("id","medida")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'medidas_id',"guardar"=>TRUE)); ?></td>
                </tr>
             
                <tr>
                    <td>Tipo de uso</td>
                </tr>
                <tr>
                            <td><span>Parcial:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'f',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'istotal')); ?></td>
                            <td><span>Total:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'t',FALSE,'',array('modelo'=>instancia_controller()->modelo,'name'=>'istotal')); ?></td>
                </tr>
                <tr>
                    <td>Medida:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_integer form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'medida_parcial')); ?></td>
                </tr>
                <tr>
                    <td>Código Asignado:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cod_unico')); ?></td>
                </tr>
                <tr>
                    <td>Marcas</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/marcas",array("id","marca")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'marcas_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Empaque</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/empaques",array("id","empaque")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'empaques_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Unidades por empaque:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_integer form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cant_empaque')); ?></td>
                </tr>
                <tr>
                    <td>Codigo Barras:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '50'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cod_barras')); ?></td>
                </tr>
                 <tr>
                    <td>Descripción:</td>
                    <td><?php echo  form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'descripcion')); ?></td>
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
