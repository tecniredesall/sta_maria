<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscripcion extends MY_Crud {
    

     public function  __construct()
        {
            $this->rutamodelo='registro/';
            $this->modelo='estudiantes_model';
            $this->ruta='/registro/inscripcion';
            $this->plantilla="principal";
            $this->vista="registro/inscripcion";
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
            
            
            if($varii=in_post(array($this->modelo,"cedula")))
            {
                
                
                $num=$this->mod->getId("$varii");
                if($num>0)
                {
                    $this->load->model("registro/preinscripcion_model","modpreinscripcion");
                    $cnt=$this->modpreinscripcion->getCntPreinscripciones($num);
                    if($cnt>0)
                    {
                        $this->session->set_userdata(array("estudiantes_id"=>$num));
                        redirect("cursos/inscripcioncalend");
                    }else
                    {
                        msj_error("El estudiante no se ha preinscrito a ningun curso");
                    }

                }else
                if($num==-100)
                {
                    msj_error("Cedula No registrada como estudiante");
                }else
                if($num==-200)
                {
                    msj_error("Cedula No registrada");
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
