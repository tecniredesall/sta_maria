<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verificar extends MY_Crud {
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
            $this->rutamodelo='registro/';
            $this->modelo='preinscripcion_model';
            $this->ruta='/admin/verificar';
            $this->plantilla="principal";
            $this->vista="admin/usuarios/verificar";
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
            $this->session->unset_userdata("ruta_error");
            $this->session->unset_userdata("ruta_exito");
            $this->session->unset_userdata("cedula");
             $this->session->unset_userdata("registro");

        }

	public function index()
	{
            plantilla($this->plantilla,$this->vista, null);
	}

        
        public function insertar()
        {
            $this->session->set_userdata(array("ruta_exito"=>"admin/usuarios"));
            $this->session->set_userdata(array("ruta_error"=>$this->ruta));
            $this->session->set_userdata(array("registro"=>"usuarios"));
            if($varii=in_post(array($this->modelo,"cedula")))
            {
                
                $num=$this->mod->getCedula($varii);
                if($num->num_rows())
                {
                    $rsResult=$num->result();
                    redirect("registro/personas/actualizar/".$rsResult[0]->id);
                }else
                {
                    $this->session->set_userdata(array("cedula"=>$varii));
                    redirect("registro/personas/");
                }
            }else
            {
                $this->erroresbd[1]="1";
                $this->objSubClass->insertarError();
            }
            $this->session->set_userdata(array("flash"=>$this->flash));
            redirect($this->ruta);
        }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
