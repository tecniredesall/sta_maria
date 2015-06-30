<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends MY_Crud {
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
            error_reporting(E_ALL);
            $this->rutamodelo='mantenimientos/';
            $this->modelo='personas_model';
            $this->ruta='mantenimientos/personas';
            $this->plantilla="principal";
            $this->vista="mantenimientos/personas";
            $this->campos=array("Cedula"=>"cedula","Nombre"=>"nombres","Apellido"=>"apellidos","Tlf. Celular"=>"tlf_celular","Tlf. Local"=>"tlf_local");
            $this->camposPdf=array("Cédula"=>array("campo"=>"cedula","tamanoW"=>"27"),"Nombres"=>array("campo"=>"nombres","tamanoW"=>"45"),"Apellido"=>array("campo"=>"apellidos","tamanoW"=>"45"),"Teléfono\nCelular"=>array("campo"=>"tlf_celular","tamanoW"=>"40"),"Teléfono\nLocal"=>array("campo"=>"tlf_local","tamanoW"=>"40"));
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{   
            
            if($ced=$this->session->userdata("cedula"))
            {
                if($reg=$this->session->userdata("registro"))
                {
                    $this->autoload['independiente']["$this->modelo"]["cedula"]=$ced;
                    $this->data["registro"]=1;
                    $this->plantilla="principal_sin_menu";
                    $this->vista="mantenimientos/personas_pacientes";
                }
            }


            /*
            print_r(json_encode($this->mod->prueba()->field_data()));
            echo "<br/><br/>";
            
            print_r(json_encode($this->mod->getList()->result_array()));
            echo "<br/><br/>";
            print_r(json_encode($this->mod->getList()->row()));
            echo "<br/><br/>";
            print_r($this->mod->getList());

            echo "<br/><br/>";
            print_r(json_encode($this->mod->getList()->field_data()));
            echo "<br/><br/>";
            print_r(json_encode($this->mod->getList()->result()));
            echo "<br/><br/>";
            exit();*/
             
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->getList()->result();
            plantilla($this->plantilla,$this->vista, $this->data);
	}



        public function insertar()
        {
            if($this->agregar=="t" || $this->modePrg==true)
            {
                if($varii=in_post(array($this->modelo)))
                {
                    if($this->mod->insertar($varii) && empty($this->erroresbd))
                    {
                        if($this->modePrg==false)
                        {
                             $this->seg->registro($this->nombrePrg,"Insertar",$this->usuario_id,$this->panelId,$this->nivel);
                        }
                        msj_exitoso("Datos agregados Exitosamente");

                    }else
                    {
                        $this->objSubClass->insertarError();
                    }
                }else
                {
                    $this->erroresbd[1]="1";
                    $this->objSubClass->insertarError();
                }
                $this->session->set_userdata(array("flash"=>$this->flash));

            }else
            {
                msj_error("Usted no tiene permiso para Agregar Registros");
                $this->session->set_userdata(array("flash"=>$this->flash));
            }


            if($ced=$this->session->userdata("cedula"))
            {
                if(($reg=$this->session->userdata("registro"))=="vst_pacientes")
                {
                    redirect("mantenimientos/pacientes");
                }
            }

            redirect($this->ruta);
        }




        

        public function limpiar()
        {
            
            redirect($this->ruta);
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
            $this->pdf->parametrosGenerales(array("titulo"=>"Personas Registradas","imgHeader"=>"generales/cintillo_header_fcite_aragua.jpg"));
            $this->pdf->inicializacion();
            $this->pdf->EncabezadoTabla_lib($this->camposPdf);
            $this->pdf->Tabla_lib($this->camposPdf,$this->mod->getList()->result());
            $this->pdf->ImprimirPdf_lib();
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
