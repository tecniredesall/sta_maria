<?php
    $obj=instancia_controller();
    $obj->load->view($content['vista'],$content);

    if($obj->agregarCss==true)
    {
        add_css_vst($content['vista']);
    }
    if($obj->agregarJs==true)
    {
        add_js_vst($content['vista']);
    }
    
    
?>
