<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programas extends MY_Crud {
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
            $this->rutamodelo='admin/menu/';
            $this->modelo='programas_model';
            $this->ruta='/admin/programas';
            $this->plantilla="principal";
            $this->vista="admin/menu/programas";
            $this->campos=array("Nombre"=>"nombre","Titulo"=>"titulo","Panel"=>"panel");
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

        
        public function actualizar($id)
        {
           if($varii=in_post(array($this->modelo)))
           {
                $data=$varii;
                if(!isset($varii['isprog']))
                {
                    $data=array_merge($varii,array("isprog"=>"FALSE"));
                }
                
                if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                {
                    msj_exitoso("Registro fue actualizado exitosamente");
                }else
                {
                    msj_error("Error al actualizar El registro");
                    $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getList")));
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
           }else
           {
                $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getList")));
                redirect($this->ruta);
           }  
        }

        
        public function insertarExito()
        {
            msj_exitoso("Registro fue agregado exitosamente");
        }
        
        public function insertarError()
        {
            msj_error("El Registro no se guardo correctamente");
        }

        
        public function eliminarExito($id)
        {
            msj_exitoso("Registro fue eliminado exitosamente");
            
        }

        public function eliminarError($id)
        {
            msj_error("El Registro no se Elimino correctamente");
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
