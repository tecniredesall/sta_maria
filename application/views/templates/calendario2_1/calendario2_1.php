
<?php
        $obj=instancia_controller();
        $plantilla=$data_global['plantilla'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="html_header">
         <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
         <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
         <title>
             <?php
                echo TITULO;
             ?>
         </title>
        <?php

            

            add_css_libs('fullcalendar','jquery/plugins/fullcalendar-2.1.1',TRUE,"");
            add_css_libs('fullcalendar.print','jquery/plugins/fullcalendar-2.1.1',TRUE,"print");
            
            add_js_libs('jquery.min','jquery/plugins/fullcalendar-2.1.1/lib',TRUE);
            add_js_libs('jquery-ui.custom.min','jquery/plugins/fullcalendar-2.1.1/lib',TRUE);
            
            add_js_libs('moment.min','jquery/plugins/fullcalendar-2.1.1/lib',TRUE);
            add_js_libs('fullcalendar.min','jquery/plugins/fullcalendar-2.1.1',TRUE);
            add_js_libs('es','fullcalendar-2.1.1/lang',TRUE);

            add_js_libs('funciones','valid_fredd');
            add_css_template('calendario2_1','calendario2_1');
            
        ?>
    </head>
    <style>

    </style>
    <script>
        $(document).ready(function(){
            $(window).data({"base_url_index":"<?php echo base_url("index.php");?>"});
            $(window).data({"base_url_img":"<?php echo base_url("/img");?>"});
            $(window).data({"base_url":"<?php echo base_url("");?>"});
        });
    </script>
<body id="html_body">
<div id="tmp_prin_body">
    <div id="tmp_error">
        <?php imprimir_msj() ?>
    </div>
    <div id="tmp_prin_div_content">
        <?php
            $obj->load->view("templates/$plantilla/partes/content",$data_global['content']);
        ?>
    </div>
</div>
<div id="tmp_hidden" style="display: none">
    <input type="hidden" id="_hd_ruta_base_" value="<?php echo base_url()?>" />
</div>
<div id="js_css" style="vertical-align: middle">
<?php
    $obj->addjscss_lib->insertarjs_html();
    $obj->addjscss_lib->insertarcss_html();
?>

<style type="text/css">

        <?php
            $obj->addjscss_lib->insertar_css();
        ?>
</style>
<script>
   

<?php
    
    $obj->addjscss_lib->insertar_script();
?>
</script>
</div>

</body>
</html>


