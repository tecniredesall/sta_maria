
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
            add_css_template('inicio','inicio');
            add_css("style","/");
            add_css_libs('theme','jquery-ui-themes-1.11.2/themes/smoothness',TRUE);
            add_css_libs('jquery-ui','jquery-ui-themes-1.11.2/themes/smoothness',TRUE);
            add_js_libs('jquery-1.11.1','jquery',TRUE);
            add_js_libs('jquery-ui.min','jquery-ui-1.11.2',TRUE);
            add_js_libs('jquery.maskedinput-1.3.1','jquery/plugins/maskInput',TRUE);
            
            add_js_libs('funciones','valid_fredd');
            add_js_libs('form','valid_fredd'); 
            
        ?>
    </head>
<body id="html_body">
<div >
    <div id="tmp_prin_div_content">
        <?php
            $obj->load->view("templates/$plantilla/partes/content",$data_global['content']);
        ?>
    </div>
</div>
<div id="js_css">
<?php
    $obj->addjscss_lib->insertarjs_html();
    $obj->addjscss_lib->insertarcss_html();
?>
</div>
</body>
</html>


