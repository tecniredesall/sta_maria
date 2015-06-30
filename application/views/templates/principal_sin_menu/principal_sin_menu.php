
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
            
        
            add_css_libs('theme','jquery-ui-themes-1.11.2/themes/smoothness',TRUE);
            add_css_libs('jquery-ui','jquery-ui-themes-1.11.2/themes/smoothness',TRUE);
            add_css_libs('chosen','jquery/plugins/chosen_v1.3.0',TRUE);
            add_css_libs('style','jquery/plugins/chosen_v1.3.0/docsupport',TRUE);
            add_css_libs('prism','jquery/plugins/chosen_v1.3.0/docsupport',TRUE);
  
            
            
            add_js_libs('jquery-1.11.1','jquery',TRUE);
            add_js_libs('jquery-ui.min','jquery-ui-1.11.2',TRUE);
            
            
            add_js_libs('jquery.inputmask','jquery/plugins/jquery.inputmask-3.x/js',TRUE);
            add_js_libs('jquery.inputmask.date.extensions','jquery/plugins/jquery.inputmask-3.x/js',TRUE);
            add_js_libs('jquery.inputmask.numeric.extensions','jquery/plugins/jquery.inputmask-3.x/js',TRUE);

            add_js_libs('chosen.jquery','jquery/plugins/chosen_v1.3.0',TRUE);
            add_js_libs('prism','jquery/plugins/chosen_v1.3.0/docsupport',TRUE);



            add_js_libs('funciones','valid_fredd');
            add_js_libs('form','valid_fredd');
            add_js_libs('jMenu.jquery','jquery/plugins/jmenu_master/js',TRUE);
            add_css_libs('jMenu.jquery','jquery/plugins/jmenu_master/css');
            add_js_libs('jquery.url','jquery/plugins/url-jquery',TRUE);
            add_css("style");
            add_css_template('principal','principal');
            add_js_template('principal','principal_sin_menu');
        ?>  
        
    </head>
    <style>

    </style>
    <script>
    $(document).ready(function(){
        $(window).data({"base_url":"<?php echo base_url("index.php");?>"});
        $(window).data({"base_url_img":"<?php echo base_url("/img");?>"});
        $(this).data({"base_url":"<?php echo base_url("index.php");?>"});

    });   
    </script>    
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
    <div id="tmp_modal"></div>
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


