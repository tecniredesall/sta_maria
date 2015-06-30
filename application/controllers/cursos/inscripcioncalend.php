<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcioncalend extends MY_Crud {
    

    public function  __construct()
        {
            $this->ruta='cursos';
            $this->plantilla="calendario";
            $this->vista="cursos/inscripcion";
            $this->rutamodelo="cursos/";
            $this->modelo="inscripcion_model";
            $this->objSubClass=$this;
            parent::__construct();
            $this->atras=base_url("index.php")."/registro/inscripcion";
        }

	public function index()
	{
            
            add_js_libs('modal_opciones','lewebmonster-modal_iframe/js');
            add_css_libs('modal_opciones','lewebmonster-modal_iframe/css');
            //$this->load->model("cursos/preinscripcion_model","mod");
            $data["eventsClient"]=json_encode($this->mod->getCalendario());
            plantilla($this->plantilla,$this->vista, $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
