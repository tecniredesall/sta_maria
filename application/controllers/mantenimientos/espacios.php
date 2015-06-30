<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Espacios extends MY_Crud {
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
            $this->modelo='espacios_model';
            $this->ruta='mantenimientos/espacios';
            $this->plantilla="principal";
            $this->vista="mantenimientos/espacios";
            $this->campos=array("Nombre Espacios"=>"nombre","Capacidad"=>"cant");
            $this->camposPdf=array("Nombre Espacios"=>array("campo"=>"nombre","tamanoW"=>"147"),"Capacidad Estudiantes"=>array("campo"=>"cant","tamanoW"=>"50"));
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
                
                if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                {
                    msj_exitoso("Registro fue actualizado exitosamente");
                }else
                {
                      msj_error($this->erroresbd[1]);
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


        public function imprimir()
        {
            $this->load->library("tcpdf_lib",array("format"=>"LETTER"),"pdf");
            $this->pdf->parametrosGenerales(array("titulo"=>"Espacios (Aulas de Estudios) ","imgHeader"=>"generales/cintillo_header_fcite_aragua.jpg"));
            $this->pdf->inicializacion();
            $this->pdf->EncabezadoTabla_lib($this->camposPdf);
            $this->pdf->Tabla_lib($this->camposPdf,$this->mod->getList()->result());
            $this->pdf->ImprimirPdf_lib();
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
