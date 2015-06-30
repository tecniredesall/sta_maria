<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitud extends MY_Crud {
       public function  __construct()
        {
            $this->rutamodelo='recepcion/';
            $this->modelo='solicitud_model';
            $this->ruta='recepcion/solicitud';
            $this->plantilla="principal";
            $this->vista="recepcion/solicitud";
            $this->campos=array("Nombre"=>"nombre","Precio"=>"precio");
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{   
            add_js_libs("jquery.autocomplete", "jquery/plugins/devbridge-autocomplete1_2_12");
            add_js_libs("listas", "helpers");
            add_css_libs('style','jquery/plugins/devbridge-autocomplete1_2_12');
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=array();
            plantilla($this->plantilla,$this->vista, $this->data);
            //add_js_libs("jquery.autocomplete", "devbridge-autocomplete1_2_12");
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
