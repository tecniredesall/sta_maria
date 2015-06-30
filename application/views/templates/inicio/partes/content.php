
<?php
    $obj=instancia_controller();
    $obj->load->view($content['vista'],$content);
    add_js_vst($content['vista']);
    add_css_vst($content['vista']);
?>
