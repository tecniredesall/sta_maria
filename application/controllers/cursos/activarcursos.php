<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activarcursos extends MY_Crud {
/*
 * Campos de la superclase
    public $autoload;
    public $rutamodelo;
    public $modelo;
    public $ruta;
    public $plantilla;
    public $vista;
    public $flash;
    public $accion="/insertar";
    public $data;
    public $erroresbd;
    public $campos;
    public $agregarCss=FALSE;
    public $agregarJs=FALSE;
    public $objSubClass=null;
 */

 /*
  *campos para el datatable
  *  $this->data['campos']=array();
     $this->data['datatabla']=array();
  */
        public function  __construct()
        {
            $this->modePrg=true;
            $this->ruta='activarcursos';
            $this->plantilla="calendario";
            $this->vista="cursos/activarcursos";
            $this->objSubClass=$this;
            parent::__construct();
        }

	public function index()
	{
            add_js_libs('ventanas-modales','lewebmonster-modal_iframe/js');
            add_css_libs('ventanas-modales','lewebmonster-modal_iframe/css');
            $this->load->model("cursos/calendario_model","mod");
            $data["eventsClient"]=json_encode($this->mod->getCalendario());
            plantilla($this->plantilla,$this->vista, $data);
	}

        

        
     

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
