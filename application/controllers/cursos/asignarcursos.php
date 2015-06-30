<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignarcursos extends MY_Crud {

    
        var $espacios_id="-1";
        var $profesores_id="-1";
        var $calendario_id="-1";
        var $fecha_inicio="0000-00-00";
        var $fecha_fin="0000-00-00";
        public function  __construct()
        {
            $this->rutamodelo='cursos/';
            $this->modelo='cursos_model';
            $this->ruta='cursos/asignarcursos';
            $this->plantilla="modal_crud";
            $this->vista="cursos/asignarcursos";
            $this->objSubClass=$this;
            parent::__construct();
            
            
        }
        
        
	public function index($id="-1")
	{
            
            $databd=array();
            
            if($id!="-1" ){
                $this->session->set_userdata(array("calendario_id"=>"$id"));
                $databd=array();
                if($this->mod->getCmp(array("id","profesores_id","espacios_id"),array("calendario_id"=>"$id"),"cursos",$databd)==true)
                {
                    $this->session->set_userdata(array("espacios_id"=>$databd->espacios_id));
                    $this->session->set_userdata(array("profesores_id"=>$databd->profesores_id));
                    redirect($this->ruta."/actualizar/".$databd->id);
                }else{
                    $this->session->set_userdata(array("espacios_id"=>"-1"));
                    $this->session->set_userdata(array("profesores_id"=>"-1"));
                }    
            }
            if($this->session->userdata("espacios_id")=="-1")
            {
                $this->btnLimpiar="../../".controller_actual()."/limp";
                $this->session->set_userdata(array("limpiar"=>$this->ruta."/index/-1"));
            }else
            {
                $this->btnLimpiar=controller_actual()."/limp";
                $this->session->set_userdata(array("limpiar"=>$this->ruta."/index/".$this->session->userdata("calendario_id")));
            }
            
            $this->espacios_id=$this->session->userdata("espacios_id");
            $this->profesores_id=$this->session->userdata("profesores_id");
            $this->calendario_id=$this->session->userdata("calendario_id");
            if($this->mod->getCmp(array("fecha_inicio","fecha_fin"),array("id"=>$this->calendario_id),"calendario",$databd)==true)
            {
            
                $this->fecha_inicio=$databd->fecha_inicio;
                $this->fecha_fin=$databd->fecha_fin;
                    
            }
            
            $data["proceso_ins"]="F";
            if($data["proceso_ins"]=$this->session->userdata("I"))
            {   
                $this->session->set_userdata(array("flash"=>$this->flash));
            }
            plantilla($this->plantilla,$this->vista, $data);
            $this->session->unset_userdata("I");
	}



        public function insertar()
        {
            
            if($varii=in_post(array($this->modelo)))
            {
            
                $varii=array_merge($varii, array("calendario_id"=>$this->session->userdata("calendario_id")));
            
                if($this->mod->insertar($varii) && empty($this->erroresbd))
                {
                        msj_exitoso("Registro Curso fue agregado exitosamente");
                }else
                {
                        msj_error($this->erroresbd[1]);
                        msj_error("El Registro no se guardo correctamente");
                }
            }else
            {
                    msj_error($this->erroresbd[1]);
                    msj_error("El Registro no se guardo correctamente");
            }
            $this->session->set_userdata(array("flash"=>$this->flash));
            $this->session->unset_userdata("calendario_id");
            $this->session->set_userdata(array("I"=>"E"));
            redirect($this->ruta);
        }
        
        
        
        
        public function actualizar($id)
        {
          if($this->modificar=="t" || $this->modePrg==true)
            {
                    if($varii=in_post(array($this->modelo)))
                    {
                         $data=$varii;

                         if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                         {

                             $this->seg->registro($this->nombrePrg,"Actualizar",$this->usuario_id,$this->panelId,$this->nivel);
                             $this->objSubClass->actualizarExito($id);
                             $this->session->set_userdata(array("I"=>"E"));
                         }else
                         {
                             $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getList")));
                             $this->objSubClass->actualizarError($id);
                         }
                         $this->session->set_userdata(array("flash"=>$this->flash));
                         redirect($this->ruta);
                    }else
                    {
                         $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getList")));
                         redirect($this->ruta);
                     }
           }else
           {
               msj_error("Usted no tiene permiso para Modificar Registros");
               $this->session->set_userdata(array("flash"=>$this->flash));
           }
           
            redirect($this->ruta);   
        }
        
        
        
    public function limp()
    {
        redirect($this->session->userdata("limpiar"));   
    }
        


  

        
     

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
