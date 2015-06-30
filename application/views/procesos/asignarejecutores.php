
<?= form_open(instancia_controller()->ruta.instancia_controller()->accion, array('id' => 'form_participantes', 'autocomplete' => "off")) ?>

            <div class="formulario">
            <div class="div_encabezado_formulario" >
                <span class="span_text_formulario">Asignar Ejecutores</span>
                <hr class="hr_titulo_formulario"/>
            </div>
            
                
            </div>
<br/>


<?php
            echo "Ejecutores Asignados";
            $obj=instancia_controller();
            table($obj->data['campos'],array(),$obj->data['datatablaseleccion'],'id_data_seleccion',array("eliminar"=>array("cmp"=>"ejecutores_id")),array(),$obj->imprimir);
            echo "<br/>";
            
            echo "Seleccione los ejecutores";
            $obj_form=array("Check"=>array("tipo"=>"check","bsq"=>"bsq","valor"=>"personal_id","arr_num"=>"personal_id","obj"=>array("cfgObj"=>array("class"=>"req_check","grupo"=>"grp0","cntchecks"=>"1"),"modelo"=>$obj->modelo,"nombre"=>"seleccion")));
            table($obj->data['campos'],array(),$obj->data['datatablaejecutores'],'id_data_ejecutores',array(),$obj_form,$obj->imprimir);
            
?>
<br/>
<div class="formulario">
            
            <table align="center" cellpadding="3" cellspacing="3" border="0">

                <tr>
                    <td colspan="2" align="center"><br/><?php echo form_submit(array('class' => 'submit', 'id' => 'btn_enviar', 'value' => 'Guardar', 'type' => 'submit')); ?><?php echo form_reset(array( 'class' => 'reset', 'id' => 'btn_limpiar', 'value' => 'Borrar')); ?></td>
                </tr>
            </table>
                
</div>

<? echo form_close() ?>


<script type="text/javascript">

    var seleccionado=<?php echo instancia_controller()->ejecutores?>;
    $(document).ready(function() 
    {
        parent.ifrejecutores(seleccionado);
 
        
    });
    
    
    
</script>



