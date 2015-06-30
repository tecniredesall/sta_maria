<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagos extends MY_Crud {
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
            $this->agregarJs=true;
            $this->rutamodelo='caja/';
            $this->modelo='pagos_model';
            $this->ruta='caja/pagos';
            $this->plantilla="principal_sin_menu";
            $this->vista="caja/pagos";
            $this->campos=array("Servicios"=>"servicios_nombre","Fecha"=>"fecha_agendada","Precio"=>"precio");
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{
            add_js_libs('modal_div_interno','jquery/plugins/lewebmonster-modal_iframe/js');
            add_css_libs('ventanas-modales','jquery/plugins/lewebmonster-modal_iframe/css');

            $js=$this->session->userdata("js");
            if($js==1 || $js==2)
            {
                    $paciente_id=$this->session->userdata("paciente_id");
                    $plan_id=$this->session->userdata("plan_id");

                    $this->session->unset_userdata("paciente_id");
                    //$this->session->unset_userdata("plan_id");
                    $this->session->unset_userdata("js");

                    $rs=$this->mod->pre_agenda($plan_id);
                    $this->data['campos']=$this->campos;
                    $this->data['datatabla']=$rs->result();
                    $this->autoload["$this->modelo"]=$rs;
                    plantilla($this->plantilla,$this->vista, $this->data);
            
            }else
            {
                $this->data['campos']=array();
                $this->data['datatabla']=array();
                plantilla($this->plantilla,$this->vista, $this->data);
            }
            


	}

        
        public function insertar()
        {
        if($this->agregar=="t" || $this->modePrg==true)
        {
            
            if($preAgenda=in_post(array("pagos_model","seleccion")))
            {
                $plan_id=$this->session->userdata("plan_id");
                $this->session->unset_userdata("plan_id");
                $rs=$this->mod->crearPagoPlan($plan_id);
                if($rs->num_rows()==1)
                {

                    echo "10";
                    $pagos_plan_id=$rs->row()->id;
                    $exito=true;
                    foreach ($preAgenda as $preagenda_id)
                    {
                        $rs=$this->mod->pagarServicios($preagenda_id,$pagos_plan_id);
                        if($rs->num_rows()!=1)
                            {
                                $exito=false;
                            }
                    }

                    msj_exitoso("Los Servicios Fueron Pagados Correctamente");
                    $this->session->set_userdata(array("flash"=>$this->flash));
                }
            }
        }
        redirect("$this->ruta");
    }

        public function pagoPlan($paciente_id,$plan_id,$agenda_id=-1)
        {
                $js=1;
                if($agenda_id>=0)
                {
                    $js=2;
                    
                }
                $this->session->set_userdata(array("js"=>$js));
                $this->session->set_userdata(array("paciente_id"=>$paciente_id));
                $this->session->set_userdata(array("plan_id"=>$plan_id));
                $this->session->set_userdata(array("agenda_id"=>$agenda_id));
                redirect($this->ruta);
        }


        




        

        
        public function actualizarExito($id = -1) 
        {
            msj_exitoso("Registro fue actualizado exitosamente");
        }
        
        public function actualizarError($id = -1) 
        {
            msj_error($this->erroresbd[1]);
            msj_error("Error al actualizar El registro");
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



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
