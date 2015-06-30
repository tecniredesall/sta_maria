

<?= form_open('user/login', array('name' => 'form_alumno', 'id' => 'form_alumno', 'autocomplete' => "off")) ?>
<div class="div_logueo modal" style="position: relative;margin-left:30%;margin-right: 30%;">
    <div class="modal-header">
        <h3>Iniciar Sessión</h3>
    </div>
     <div id="tmp_error">
        <?php
                if(isset($error)){
                    echo $error;
                }
                
        ?>
    </div>
    <div class="modal-body">
        
        <table align="center" border="0" style="height: 102px;padding-top: 19px;padding-bottom: 19px " cellpadding="3" cellspacing="2" >
                <tr>
                    <th align="right">Usuario:</th>
                    <td align="left"><?php echo form_input_autoload(array("class"=>'req_txt', 'maxlength' => '18'),'','',array('modelo'=>'usuario','name'=>'usuario')); ?></td>
                </tr>
                <tr>
                    <th align="right">Clave:</th>
                    <td align="left"><?php echo form_input_autoload(array("class"=>'req_txt', 'maxlength' => '12',"type"=>"password"),'','',array('modelo'=>'usuario','name'=>'clave')); ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><a href="./../admin/snpersonas">¡Crear un Usuario nuevo!</a></td>
                </tr>
             </table>
        
    </div>
    
    <div class="modal-footer">
        <table width="100%">
            <tr>
                <td align="left" ><a href="user">Olvido su Usuario o Contraseña?</a><td>
                <td align="right"><?php echo form_submit(array('name' => 'Entrar', 'class' => 'submit btn btn-primary btn-large', 'id' => 'ingresar', 'value' => 'Ingresar', 'type' => 'submit', 'content' => 'Limpiar')); ?><td>
            </tr>
        </table>
        
        
    </div>
</div>
<img height="30px"/>


<? echo form_close();?>

