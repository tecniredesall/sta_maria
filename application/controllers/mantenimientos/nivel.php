<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivel extends MY_Crud {

    
        public function  __construct()
        {
            $this->rutamodelo='mantenimientos/';
            $this->modelo='nivel_model';
            $this->ruta='mantenimientos/nivel';
            $this->plantilla="principal";
            $this->vista="mantenimientos/nivel";
            $this->campos=array("Nombre Nivel"=>"nombre","Descripción"=>"observaciones");
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->getList()->result();
            plantilla($this->plantilla,$this->vista, $this->data);
	}     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
