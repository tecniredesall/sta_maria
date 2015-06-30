<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agendar extends MY_Crud {

        public function  __construct()
        {
            $this->modePrg=true;
            $this->ruta='cursos';
            $this->plantilla="calendario2_1";
            $this->vista="recepcion/agendar";
            $this->objSubClass=$this;
            parent::__construct();
        }

	public function index()
	{
            $data["eventsClient"]=json_encode(array());
            add_js_libs("listas", "helpers");
            plantilla($this->plantilla,$this->vista, $data);
            
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
