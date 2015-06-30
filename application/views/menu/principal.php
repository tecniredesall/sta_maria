
<?= form_open('menu/insertar', array('name' => 'form_alumno', 'id' => 'form_alumno', 'autocomplete' => "off")) ?>

            <ol>
            <li><?= form_label('Cédula de Identidad:', 'cedula') ?><span><?php echo form_input_autoload(array("class"=>'req_fecha','size' => '40', 'maxlength' => '10'),'','',array('name'=>'nombrea')); ?></span></li>
            <li><?= form_label('Cédula de Identidad:', 'cedula') ?><span><?php echo form_input_autoload(array("class"=>'req_fecha','size' => '40', 'maxlength' => '10'),'','',array('modelo'=>'tal','name'=>'nombre1')); ?></span></li>
            <li><?= form_label('Cédula de Identidad:', 'cedula') ?><span><?php echo form_input_autoload(array("class"=>'req_txt mask_cedula','size' => '40', 'maxlength' => '10'),'','',array('modelo'=>'tal','name'=>'nombre2')); ?></span></li>
            <li><?= form_label('Cédula de Identidad:', 'cedula') ?> <?php echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'-','',array('modelo'=>'tal','name'=>'id')); ?>   </li>
          
            <?= form_label('Apellidos:', 'apellidos') ?><span class="grp1 gp"><?php echo form_radio_autoload(array("class"=>"req_radio"),'ape1',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'nombre')); ?></span>


            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","grupo"=>"grp0","cntchecks"=>"1"),'ape1',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'xys')); ?></span>
            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","grupo"=>"grp0","cntchecks"=>"1"),'ape2',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'xys1')); ?></span><br/>
            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","cntchecks"=>"3","grupo"=>"grp1"),'ax0',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'tat')); ?></span>
            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","cntchecks"=>"3","grupo"=>"grp1"),'ax1',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'tat1')); ?></span>
            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","cntchecks"=>"3","grupo"=>"grp1"),'ax2',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'tat2')); ?></span>
            <span class="grp1"> <?php echo form_checkbox_autoload(array("class"=>"req_check","cntchecks"=>"3","grupo"=>"grp1"),'ax3',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'tat3')); ?></span>


            
          
            <li><?= form_label('Apellidos:', 'apellidos') ?> <?php echo form_radio_autoload(array("class"=>"req_radio"),'ape0',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'nombre')); ?></li>

            <li><?= form_label('Apellidos:', 'apellidos') ?> <?php echo form_radio_autoload(array("class"=>"req_radio"),'uo0',FALSE,'',array('autoload'=>true,'name'=>'nombress')); ?></li>
            <li><?= form_label('Apellidos:', 'apellidos') ?> <?php echo form_radio_autoload(array("class"=>"req_radio"),'uo1',FALSE,'',array('autoload'=>true,'name'=>'nombress')); ?></li>
            <li><?= form_label('Apellidos:', 'apellidos') ?> <?php echo form_radio_autoload(array("class"=>"req_radio"),'uo2',FALSE,'',array('autoload'=>true,'name'=>'nombress')); ?></li>
            <li><?= form_label('Apellidos:', 'apellidos') ?> <?php echo form_radio_autoload(array("class"=>"req_radio"),'oti',FALSE,'',array('modelo'=>'tal','autoload'=>false,'name'=>'nombress1')); ?></li>
            <li><?= form_label('Escuela:', 'carrera_id') ?><?php echo form_dropdown_autoload('carrera_id', array('key'=>"valor",'hola1','hola2'), '2','class="req_cmb"'); ?></li>

             

            <br/>
            <br/>

            
            <?php //$dat_ciudad=form_dropdown_autoload(array("ciudades",array("id","valor")), array(),'class="req_cmb"',array('modelo'=>'tal','autoload'=>TRUE,'name'=>'ciudad_id',"guardar"=>FALSE)); ?>
            <?php //$dat_municipio=form_dropdown_autoload(array("ciudades",array("id","valor"),"municipio",array("padre_id"=>$dat_ciudad['value'])), array(),'class="req_cmb"',array('modelo'=>'tal','autoload'=>TRUE,'name'=>'municipio_id',"guardar"=>FALSE),$dat_ciudad); ?>
            <?php //$dat_parroquia=form_dropdown_autoload(array("ciudades",array("id","valor"),"parroquia",array("padre_id"=>$dat_municipio['value'])), array(),'class="req_cmb"',array('modelo'=>'tal','autoload'=>TRUE,'name'=>'parroquia_id'),$dat_municipio); ?>


            fecha<span><?php //echo form_input_autoload(array("class"=>'req_fecha','size' => '40', 'maxlength' => '10'),'','',array('modelo'=>'modulo','name'=>'fecha')); ?></span>
            nombre<span><?php //echo form_input_autoload(array("class"=>'req_txt mask_cedula','size' => '40', 'maxlength' => '10'),'','',array('modelo'=>'modulo','name'=>'nombre')); ?></span>
            <?= form_label('observaciones:', 'observaciones') ?> <?php //echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'-','',array('modelo'=>'modulo','name'=>'observaciones')); ?>
            
            <?php echo form_submit(array('name' => 'limpiar', 'class' => 'submit', 'id' => 'limpiar', 'value' => 'Limpiar', 'type' => 'submit', 'content' => 'Limpiar')); ?>
        
<? echo form_close() ?>

    <?php
            //table(array("Nombre"=>"nombre","Observaciones-"=>"observaciones"),array(),$datatabla,'id_data_table',array("eliminar"=>array("src"=>"","cmp"=>"id","href"=>"/ver/","titulo"=>""),"actualizar"=>array()));
    ?>

            <div align="center" style="margin-top: 10px;margin-bottom: 10px">
                <table id="table_opciones" border="1" align="center" cellpadding='2' cellspacing='2' style='border:2px solid rgba(0, 0, 0,0.3);padding-right:  10px'>
                        <tr>
                            <th align="left" style="width: 100px">Hola</th>
                            <td align="left" style="width: 30px">nuevo</td>
                        </tr>
                        <tr><td colspan='2' align='center'>okis</td></tr>
                    </table>
            </div>

            <div class="valid flash dy" style="">
                     <table id="table_show_error">
                        <tbody><tr>
                            <td valign="top" height="24px" align="right"><img height="24px" src="http://150.187.103.10/asl//img/iconos/valid.png" alt=""></td>
                            <td valign="middle" align="left">Registro fue actualizado exitosamente</td>
                        </tr><tr>
                     </tr></tbody></table>
             </div>


            
