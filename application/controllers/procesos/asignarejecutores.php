<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignarejecutores extends MY_Crud {

    
        public $ejecutores=1;
        var $procesos_id=-1;
        public function  __construct()
        {
            $this->rutamodelo='procesos/';
            $this->modelo='ejecutores_model';
            $this->ruta='procesos/asignarejecutores';
            $this->plantilla="modal_crud";
            $this->vista="procesos/asignarejecutores";
            $this->objSubClass=$this;
            $this->campos=array("Cedula"=>"cedula","Nombre"=>"nombres","Apellido"=>"apellidos");
            parent::__construct();
            $this->cargarTabla();
        }

        
	public function index($id="-1")
	{
            $this->procesos_id=$this->session->userdata("procesos_id");
            $this->data['campos']=$this->campos;
            $this->ejecutores=$this->mod->ejecutores_validacion($this->procesos_id);
            
            $this->data['datatablaseleccion']=$this->mod->personas_seleccionadas($this->procesos_id);
            $this->data['datatablaejecutores']=$this->mod->personas_ejecutores($this->procesos_id);
            plantilla($this->plantilla,$this->vista, $this->data);
	}
        
        public function insertar()
        {

            if($this->agregar=="t" || $this->modePrg==true)
            {
                if($vari=in_post(array($this->modelo,"seleccion")))
                {
                    $this->procesos_id=$this->session->userdata("procesos_id");
                    $iExito=0;
                    $iError=0;
                    foreach($vari as $value)
                    {
                        $sv=array("personal_id"=>"$value","procesos_id"=>"$this->procesos_id");
                        if($this->mod->insertar($sv) && empty($this->erroresbd))
                        {
                            if($this->modePrg==false)
                            {
                                $this->seg->registro($this->nombrePrg,"Insertar",$this->usuario_id,$this->panelId,$this->nivel);
                            }
                            $iExito++;
                            //$this->objSubClass->insertarExito();
                        }else
                        {
                            $iError++;
                            $this->objSubClass->insertarError();
                        }
                    }
                    
                    msj_exitoso("Se Agregaron $iExito Ejecutores");
                    
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
        $this->procesos_id=$this->session->userdata("procesos_id");
        $this->mod->eliminar(array("procesos_id"=>$this->procesos_id));
        msj_exitoso("Ejecutores Borrados correctamente");
        $this->session->set_userdata(array("flash"=>$this->flash));
        redirect($this->limpiar);
    }
        

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
