<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidades extends MY_Crud {
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
            $this->rutamodelo='infocursos/';
            $this->modelo='unidades_model';
            $this->ruta='/infocursos/unidades';
            $this->plantilla="principal";
            $this->vista="infocursos/unidades";
            $this->campos=array("Nombre"=>"nombre","Descripción"=>"observaciones","Horas"=>"horas");
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


        
        public function actualizarExito($id=-1)
        {
             msj_exitoso("Registro fue actualizado exitosamente");
        }

        public function actualizarError($id=-1)
        {
               msj_error($this->erroresbd[1]);
               msj_error("Error al actualizar El registro");
        }


        public function insertarExito()
        {
            msj_exitoso("Registro fue agregado exitosamente");
        }
        
        public function insertarError()
        {
            msj_error($this->erroresbd[1]);
            msj_error("El Registro no se guardo correctamente");
        }

        
        public function eliminarExito($id)
        {
            msj_exitoso("Registro fue eliminado exitosamente");
            
        }

        public function eliminarError($id)
        {
            msj_error($this->erroresbd[0]);
            msj_error("El Registro no se Elimino correctamente");
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
