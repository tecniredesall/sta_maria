
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
            
            add_css_libs('jquery-ui-1.9.2.custom','jquery-ui-1.9.2/themes/smoothness',TRUE);
            add_js_libs('jquery-1.8.3','jquery-ui-1.9.2/js',TRUE);
            add_js_libs('jquery-ui-1.9.2.custom.min','jquery-ui-1.9.2/js',TRUE);
            add_js_libs('jquery.maskedinput-1.3.min','jquery-ui-1.9.2/plugins',TRUE);

            //add_js_libs('ventanas-modales','lewebmonster-modal_iframe/js',TRUE);
            //add_css_libs('ventanas-modales','lewebmonster-modal_iframe/css',TRUE);
            
            add_js_libs('funciones','valid_fredd');
            add_js_libs('form','valid_fredd');
            
            add_js_libs('jMenu.jquery','jmenu_master/js');
            add_js_libs('jquery.url','url-jquery');
            add_css_libs('jMenu.jquery','jmenu_master/css');
            add_css("style");
            add_css_template('principal','principal');
            add_js_template('principal','principal');
        ?>
    </head>
    <style>

    </style>
<body id="html_body">
<div id="tmp_prin_body">
    <div id="tmp_prin_div_header">
        <?php
            $obj->load->view("templates/$plantilla/partes/header");
        ?>
    </div>
    
    
    <div id="tmp_error">
        <?php imprimir_msj() ?>
    </div>
    <div id="tmp_prin_div_content">
        <?php
            $obj->load->view("templates/$plantilla/partes/content",$data_global['content']);
        ?>
    </div>
    <div id="tmp_prin_div_footer">
        <?php
            $obj->load->view("templates/$plantilla/partes/footer");
        ?>
    </div>
</div>
<div id="js_css" style="vertical-align: middle">
<?php
    $obj->addjscss_lib->insertarjs_html();
    $obj->addjscss_lib->insertarcss_html();
?>
<script>
<?php
    $obj->addjscss_lib->insertar_script();
?>
</script>
</div>
</body>
</html>


