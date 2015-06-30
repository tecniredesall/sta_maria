
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

               <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Mantenimientos Procesos</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            <table align="center" cellpadding="3" cellspacing="3" border="0">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt alfa form','size' => '40', 'maxlength' => '12'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'nombre')); ?></td>
                </tr>
                <tr>
                    <td>Areas</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/areas",array("id","nombre")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'areas_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Salas</td>
                    <td><?php form_dropdown_autoload(array("mantenimientos/salas",array("id","nombre")), array(),'class="req_cmb"',array('modelo'=>instancia_controller()->modelo,'autoload'=>TRUE,'name'=>'salas_id',"guardar"=>TRUE)); ?></td>
                </tr>
                <tr>
                    <td>Ejecutores</td>
                    <td><a href="<?php echo base_url("index.php")."/procesos/asignarejecutores/index" ?>"  class="clsVentanaIFrame" rel="---"><img  src="/sta_maria/img/icons/button_more.png" alt="..." title="Agregar Ejecutores"/></a></td>
                </tr>
                
                
                 <tr>
                    <td style="padding-top:30px">Modalidad Espacio</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><hr class="hr_titulo_formulario" /></td>
                </tr>
                <tr>
                     <td>Fijo</td>
                 <td><?php echo form_radio_autoload(array("class"=>"req_radio"),'1',FALSE,'',array('modelo'=>'desc_procesos_model','name'=>'modalidad')); ?></td>
                </tr>
                <tr>
                    <td>Dias Semana</td>
                    <td ><?php echo form_radio_autoload(array("class"=>"req_radio"),'2',FALSE,'',array('modelo'=>'desc_procesos_model','name'=>'modalidad')); ?><a id="a_dias" href="<?php echo base_url("index.php")."/procesos/diasprocesos" ?>"  class="clsVentanaIFrame" rel="---"><img  src="/sta_maria/img/icons/button_more.png" alt="..." title="Asignar Dias"></a></td>
                    
                </tr>
                <tr >
                    <td style="padding-top:30px">Tipo de actividad</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><hr class="hr_titulo_formulario" /></td>
                </tr>
                <tr>
                    <td><span>Cantidad:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'1',FALSE,'',array('modelo'=>'desc_procesos_model','name'=>'tipo')); ?></td>
                    <td><?php echo form_input_autoload(array("class"=>'req_txt numeros form','size' => '40', 'maxlength' => '3'),'','',array('modelo'=>'desc_procesos_model','name'=>'cant')); ?>
                </tr>
                <tr>
                    <td colspan="2" ><span>Tiempo:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'2',FALSE,'',array('modelo'=>'desc_procesos_model','name'=>'tipo')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" ><span>Otro:&nbsp;</span><?php echo form_radio_autoload(array("class"=>"req_radio"),'3',FALSE,'',array('modelo'=>'desc_procesos_model','name'=>'tipo')); ?></td>
                </tr>
                
                 <tr>
                    <td>Descripción:</td>
                    <td><?php echo form_textarea_autoload(array("class"=>'req_area','size' => '20', 'maxlength' => '8'),'','',array('modelo'=>instancia_controller()->modelo,'name'=>'descripcion')); ?></td>
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

<script type='text/javascript'>
   
   
    v_ifr_dias=0;
    v_ifr_ejecutores=0;
    valid=true;
    
    
    function ifrdias(seleccionado)
    {
        v_ifr_dias=seleccionado;
        if(seleccionado==1)
        {
            valid=true;
        }else
        {
            valid=false;
        }
        
        
    }
    
    function ifrejecutores(seleccionado)
    {
        v_ifr_ejecutores=seleccionado;
        if(seleccionado==1)
        {
            valid=true;
        }else
        {
            valid=false;
        }
        
    }
   
   
   $(document).ready(function() {
       
       
       if($("input:radio[id=desc_procesos_model_tipo]:checked").val()!=1)
       {
            $('#desc_procesos_model_cant').val("-1");
            $('#desc_procesos_model_cant').hide();
       }
       
       if($("input:radio[id=desc_procesos_model_modalidad]:checked").val()!=2)
       {
            $('#a_dias').hide();
       }
       
       $("input:radio[id=desc_procesos_model_tipo]").click(function()
       {
           
           vl_tipo=$("input:radio[id=desc_procesos_model_tipo]:checked").val();
           if(vl_tipo==1)
           {
               $('#desc_procesos_model_cant').show();
               $('#desc_procesos_model_cant').val("");
           }else
           {
               $('#desc_procesos_model_cant').hide();
               $('#desc_procesos_model_cant').val("-1");
               
           }

       });
       
       $("input:radio[id=desc_procesos_model_modalidad]").click(function()
       {
           val_salas=$('#procesos_model_salas_id').val();
           vl_mod=$("input:radio[id=desc_procesos_model_modalidad]:checked").val();
           if(vl_mod==1 || val_salas=="seleccione")
           {
               $('#a_dias').hide();
           }else
           {
               $('#a_dias').show();
           }

       });
       
       $("form").submit(function(event)
       {
           evento=event;

           if(v_ifr_ejecutores==0)
           {
               alert("Debe seleccionar al menos 1 Ejecutor del proceso");
               valid=false;
           }
           
           if(v_ifr_dias==0 && $("input:radio[id=desc_procesos_model_modalidad]:checked").val()==2)
           {
               alert("Debe seleccionar los dias Correspondientes");
               valid=false;
           }
           
           vl_mod=$("input:radio[id=desc_procesos_model_tipo]:checked").val();
           if(vl_mod==1 && $('#desc_procesos_model_cant').val()<=0)
           {
               alert("Debe ingresar una cantidad mayor a cero")
               valid=false;
           }
           
           valid=true;
           if (valid==false)
           {
               valid=true;
               return false;
           }
           
       });
       
       $('#procesos_model_salas_id').on("change", function()
       {
           val=$('#procesos_model_salas_id').val();
           vl_mod=$("input:radio[id=desc_procesos_model_modalidad]:checked").val();
           if(val=='seleccione' || vl_mod==null || vl_mod==1 )
           {
               //alert("Debe selecionar una sala")
               val=-1;
               $('#a_dias').hide();
           }else
           {
               $('#a_dias').show();
           }
           ruta="<?php echo base_url("index.php")."/globales/json/set_data_sessiones" ?>";
           $.ajax({
                                    type: "post",
                                    data:{"json[salas_id]":$('#procesos_model_salas_id').val()},
                                    url: ruta,
                                    cache: true,
                                    dataType: "json",
                                    success: function(datos)
                                           {
                                                    $.each(datos, function(i,item){
                                                    
                                                });
                                           }
                               });
       });
   });
   
   
</script>