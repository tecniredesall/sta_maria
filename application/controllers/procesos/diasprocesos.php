<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diasprocesos extends MY_Crud {
    
    /*limpiar las variables de session
     * =*/

        public $dias=1;
        public $procesos_id;
        public $salas_id;
        public $desc_procesos_id;
        
        public function  __construct()
        {
            $this->rutamodelo='procesos/';
            $this->modelo='diasprocesos_model';
            $this->ruta='procesos/diasprocesos';
            $this->plantilla="modal_crud";
            $this->vista="procesos/dias";
            $this->objSubClass=$this;
            $this->campos=array("Id"=>"id","Dias de la semana"=>"dias");
            
           
            parent::__construct();
            
            
            $this->cargarTabla();
        }

        
	public function index($id="-1")
	{
            $this->procesos_id=$this->session->userdata("procesos_id");
            $this->desc_procesos_id=$this->session->userdata("desc_procesos_id");
            $this->salas_id=$this->session->userdata("salas_id");
            $this->dias=$this->mod->dias_validacion($this->desc_procesos_id);
            
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->days($this->procesos_id,$this->salas_id);
            plantilla($this->plantilla,$this->vista, $this->data);
	}
        
        
        public function insertar()
        {
            
            if($this->agregar=="t" || $this->modePrg==true)
            {
                $ids=$this->session->userdata("desc_procesos_id");
                if($vari=in_post(array($this->modelo,"seleccion")))
                {
                    
                    $iExito=0;
                    $iError=0;
                    $this->mod->eliminar(array("desc_proceso_id"=>$ids));
                    foreach($vari as $value)
                    {
                        
                        $this->mod->add_days($value,$ids);
                        if(empty($this->erroresbd))
                        {
                            $iExito++;
                        }else
                        {
                            
                            $iError++;
                            $this->objSubClass->insertarError();
                        }
                    }
                    
                    msj_exitoso("Dias Asignados Correctamente");
                    
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
            redirect($this->ruta);
        }
        
        
    public function limpiar()
    {
        $ids=$this->session->userdata("desc_procesos_id");
        $this->mod->remove_dias($ids);
        msj_exitoso("Dias borrados correctamente");
        $this->session->set_userdata(array("flash"=>$this->flash));
        redirect($this->limpiar);
    }

        
        

        
     

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
