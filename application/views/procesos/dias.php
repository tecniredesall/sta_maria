
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_dias_semana', 'autocomplete' => "off")) ?>

            <!--<div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Asignar Dias a Espacios</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            
                
            </div> -->
<br/>


<?php

            $obj_form=array("Check"=>array("tipo"=>"check","bsq"=>"bsq","valor"=>"id","arr_num"=>"id","obj"=>array("cfgObj"=>array("class"=>"req_check","grupo"=>"grp0","cntchecks"=>"1"),"modelo"=>  instancia_controller()->modelo,"nombre"=>"seleccion")));
            table_basico_obj($obj_form);
?>
<br/>
<div class="formulario">
            
            <table align="center" cellpadding="1" cellspacing="1" border="0">
                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
                
</div>

<? echo form_close() ?>

<script type="text/javascript">

    var seleccionado=<?php echo instancia_controller()->dias?>;
    $(document).ready(function() 
    {

        //parent.ifrdias(seleccionado);
    });
    
</script>






