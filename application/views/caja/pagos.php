
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Selección de Servicios a Pagar</span>
                <hr class="hr_titulo_formulario"/>
            </div>
                   <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">
                <tr>
                    <td width="5%"></td>
                    <td width="15%" align="left">Cédula</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_cedula  form','size' => '40', 'maxlength' => '20',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cedula')); ?></td>
                </tr>
                <tr >
                    <td width="5%"></td>
                    <td  align="left">Nombres paciente</td>
                    <td><?php echo form_input_autoload(array("class"=>'txt alfa form','size' => '40', 'maxlength' => '20',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombres')); ?></td>
                </tr>
                <tr >
                    <td width="5%"></td>
                    <td  align="left">Apellidos paciente</td>
                    <td><?php echo form_input_autoload(array("class"=>'txt alfa form','size' => '40', 'maxlength' => '20',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'apellidos')); ?></td>
                    
                </tr>

                   </table>
                <div class="div_encabezado_formulario" >
                    <hr class="hr_titulo_formulario"/>
                </div>
                <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">

                <tr align="left">
                    <td width="5%"></td>
                    <td width="15%">Nombre Plan</td>
                    <td><?php echo form_input_autoload(array("class"=>'text  alfa','size' => '40', 'maxlength' => '12',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre_plan')); ?></td>
                    <td width="15%">Costo Total Plan</td>
                    <td><?php echo form_input_autoload(array("class"=>'moneda  form','size' => '40', 'maxlength' => '12',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'total_plan')); ?></td>
                </tr>
                <tr>
                    <td height="10px"></td>
                 </tr>
                <tr align="left">
                    <td width="5%"></td>
                    <td width="15%"></td>
                    <td></td>
                    <td width="15%">Total Seleccionado</td>
                    <td><?php echo form_input_autoload(array("class"=>'moneda  form','size' => '40', 'maxlength' => '12',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'total')); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="center"><br/><?php echo form_submit(array('class' => 'button_modal_div', 'id' => 'btn_enviar', 'value' => 'Pagar', 'type' => 'button')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Cancelar')); ?></td>
                </tr>
            </table>
                   
            </div>



           



<div class="modal_div modalmask" style="display: none">
   <div class="formulario modal_div_interno">
       
                <div class="div_encabezado_formulario" >
                    <span class="span_text_formulario">Realizar Pago</span>
                    <hr class="hr_titulo_formulario"/>
                </div>
                <table align="center" cellpadding="3" cellspacing="3" border="0" width="100%">
                 <tr align="left">
                    <td align="left"> C&eacute;dula O Rif:</td>
                    <td align="left"><?php echo form_input_autoload(array("class"=>'req_txt mask_cedula alfa form','size' => '40', 'maxlength' => '16'),'','',array('modelo'=>'datos_pago','name'=>'cedula')); ?></td>
                    <td>&nbsp;</td>
                    <td align="center"></td>
                </tr>
                <tr align="left">
                    <td align="left"> Razon Social:</td>
                    <td align="left"><?php echo form_input_autoload(array("class"=>'req_txt form','size' => '40', 'maxlength' => '16'),'','',array('modelo'=>'datos_pago','name'=>'razon')); ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr align="left">
                    <td align="left">Telefono:</td>
                    <td align="left"><?php echo form_input_autoload(array("class"=>'req_telefono form','size' => '40', 'maxlength' => '16'),'','',array('modelo'=>'datos_pago','name'=>'telefono')); ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr align="left">
                    <td align="left">Dirección:</td>
                    <td align="left"><?php echo form_textarea_autoload(array("class"=>'req_area form','size' => '20', 'maxlength' => '250'),'','',array('modelo'=>'datos_pago','name'=>'direccion')); ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr >
                    <td colspan="2" style="padding-top:30px" align="Left">Forma de pago</td>
                    <td width="15%">Total Pago</td>
                    <td align="right"><?php echo form_input_autoload(array("class"=>'moneda  form','size' => '40', 'maxlength' => '12',"disabled"=>"disabled"),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'total_pagar')); ?></td>
                    
                </tr>
                <tr>
                    <td colspan="4"><hr class="hr_titulo_formulario" /></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" align="center">
                            <tr align="center" valign="middle">
                            <td width="33%"><span>Efectivo:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'1',FALSE,'',array('modelo'=>'datos_pago','name'=>'tipo_pago')); ?></td>
                            <td width="33%"><span>Debito:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'2',FALSE,'',array('modelo'=>'datos_pago','name'=>'tipo_pago')); ?></td>
                            <td width="33%"><span>Credito:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'3',FALSE,'',array('modelo'=>'datos_pago','name'=>'tipo_pago')); ?></td>
                            
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" height="20px">&nbsp;</td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <table id="cash" width="100%" cellpadding="3" cellspacing="3" border="0">
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left" width="20%">Efectivo</td>
                                <td align="left"><?php echo form_input_autoload(array("class"=>'req_moneda  ','size' => '40', 'maxlength' => '13'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'cash')); ?></td>
                                <td width="20%"></td>
                            </tr>
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left">Cambio</td>
                                <td align="left"><?php echo form_input_autoload(array("class"=>'req_moneda  form','size' => '40', 'maxlength' => '13'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'turned')); ?></td>
                                <td width="20%"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table id="card" width="100%" cellpadding="3" cellspacing="3" border="0">
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left" width="20%">Cédula Tarjeta Habiente</td>
                                <td align="left"><?php echo form_input_autoload(array("class"=>'req_cedula','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>'datos_pago_tarjeta','name'=>'ci_tarjeta')); ?></td>
                                <td width="20%"></td>
                            </tr>
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left">Banco</td>
                                <td align="left" width="30%"><?php $estado=form_dropdown_autoload(array("mantenimientos/estados",array("id","nombre")), array(),'class="req_cmb chosen-select"',array('modelo'=>'datos_pago_tarjeta','autoload'=>TRUE,'name'=>'bancos_id',"guardar"=>TRUE)); ?></td>
                                <td width="20%"></td>
                            </tr>
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left">Referencia</td>
                                <td align="left"><?php echo form_input_autoload(array("class"=>'req_integer  form','size' => '40', 'maxlength' => '4'),'','',array('modelo'=>'datos_pago_tarjeta','name'=>'ref')); ?></td>
                                <td width="20%"></td>
                            </tr>
                            <tr align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left">Ultimos 4 digitos Tarjeta</td>
                                <td align="left"><?php echo form_input_autoload(array("class"=>'req_integer  form','size' => '40', 'maxlength' => '4'),'','',array('modelo'=>'datos_pago_tarjeta','name'=>'last4_digit')); ?></td>
                                <td width="20%"></td>
                            </tr>

                             <tr id="credit" align="center" valign="middle">
                                <td width="20%"></td>
                                <td align="left">Tipo Tarjeta</td>
                                <td align="left">
                                    <span>Visa:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'1',FALSE,'',array('modelo'=>'datos_pago_tarjeta_tdc','name'=>'tipo')); ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span>MasterCard:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'2',FALSE,'',array('modelo'=>'datos_pago_tarjeta_tdc','name'=>'tipo')); ?>
                                </td>
                                <td width="20%"></td>


                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Pagar', 'type' => 'submit')); ?></td>
                </tr>
            </table>
   </div>
</div>


<div>Seleccione las listas de la citas</div>
<div>
     <table width="100%">
                <tr>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="right"><img class="cal" width="20px" style="margin-left: 2px" title="Ver Calendario" alt="Ver Calendario" src="http://localhost/sta_maria/img/icons/calendar.png"></td>
                </tr>
            </table>
    <?php
            $obj_form=array("Check"=>array("tipo"=>"check","selectall"=>false,"ischeck"=>"check","bsq"=>"bsq","valor"=>"id","arr_num"=>"id","obj"=>array("cfgObj"=>array("class"=>"req_check fnClick","grupo"=>"grp0","cntchecks"=>"1"),"modelo"=>  instancia_controller()->modelo,"nombre"=>"seleccion")));
            table_basico_obj($obj_form);
    ?>
</div>

<? echo form_close() ?>
<script>
 
    
</script>



