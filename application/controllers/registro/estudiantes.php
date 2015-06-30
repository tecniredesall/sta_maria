<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes extends MY_Crud {
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
            $this->rutamodelo='mantenimientos/';
            $this->modelo='personas_model';
            $this->ruta='/registro/estudiantes';
            $this->plantilla="principal";
            $this->vista="registro/estudiantes";
            $this->objSubClass=$this;
            parent::__construct();
            
        }

	public function index()
	{
            $this->session->unset_userdata("ruta_error");
            $this->session->unset_userdata("ruta_exito");
            $this->session->unset_userdata("cedula");
            $this->data['campos']=array();
            plantilla($this->plantilla,$this->vista, $this->data);
	}

        
        public function insertar()
        {
            $this->session->set_userdata(array("ruta_exito"=>"cursos/preinscripcion"));
            $this->session->set_userdata(array("ruta_error"=>$this->ruta));
             $this->session->set_userdata(array("registro"=>"estudiantes"));
            if($varii=in_post(array($this->modelo,"cedula")))
            {
                $num=$this->mod->getId("$varii");
                if($num->id)
                {
                    redirect("registro/personas/actualizar/".$num->id);
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
            //msj_exitoso("Registro fue agregado exitosamente");
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
