<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends MY_Crud 
{

        public function  __construct()
        {
            $this->modePrg=true;
            $this->rutamodelo='mantenimientos/';
            $this->modelo='personas_model';
            $this->ruta='registro/personas';
            $this->plantilla="principal";
            $this->vista="registro/personas";
            $this->objSubClass=$this;
            parent::__construct();
        }

	public function index()
	{
            if($cedula=$this->session->userdata("cedula"))
            {
                $this->autoload["independiente"]["$this->modelo"]['cedula']=$cedula;
            }
            plantilla($this->plantilla,$this->vista, null);
	}

        public function actualizar($id)
        {
           if($varii=in_post(array($this->modelo)))
           {
                $data=$varii;
                if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                {
                    if($ruta=$this->session->userdata("ruta_exito"))
                    {
                        $this->ruta=$ruta;
                    }
                    if($model=$this->session->userdata("registro"))
                    {
                       
                        if($model=="estudiantes")
                        {
                            
                            $this->load->model("registro/".$model."_model","mod_registro");
                            $row=$this->mod_registro->insertarEstudiantes($id);
                            $this->session->set_userdata(array("estudiantes_id"=>$row->id));
                            
                        }else
                        if($model=="usuarios")
                        {
                            $this->session->set_userdata(array("personas_id"=>$id));
                        }
                    }
                           $this->session->unset_userdata("ruta_error");
                           $this->session->unset_userdata("ruta_exito");
                           $this->session->unset_userdata("cedula");
                                        
                    msj_exitoso("Registro fue actualizado exitosamente");
                }else
                {
                    msj_error($this->erroresbd[1]);
                    msj_error("Error al actualizar El registro");
                    $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getParticipantes")));
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
           }else
           {
                $this->session->set_userdata(array("autoload"=>array("id"=>$id,"function"=>"getParticipantes")));
                redirect($this->ruta);
           }  
        }


        public function limpiar()
        {
            if($ruta=$this->session->userdata("ruta_error"))
            {
                $this->ruta=$ruta;
            }
             $this->session->unset_userdata("ruta_error");
             $this->session->unset_userdata("ruta_exito");
             $this->session->unset_userdata("cedula");
            redirect($this->ruta);
        }



        public function insertarExito()
        {
            if($ruta=$this->session->userdata("ruta_exito"))
            {
                $this->ruta=$ruta;
            }

            if($model=$this->session->userdata("registro"))
            {
                $row=$this->mod->getId(in_post(array($this->modelo,"cedula")));

                if($model=="estudiantes")
                {
                    $this->load->model("registro/".$model."_model","mod_registro");
                    $row=$this->mod_registro->insertarEstudiantes($row->id);
                    $this->session->set_userdata(array("estudiantes_id"=>$row->id));
                }else
                if($model=="usuarios")
                {
                    $this->session->set_userdata(array("personas_id"=>$id));
                }
            }
            $this->session->unset_userdata("ruta_error");
            $this->session->unset_userdata("ruta_exito");
            $this->session->unset_userdata("cedula");
            msj_exitoso("Registro de Datos Basicos fue agregado exitosamente");
        }

        
        public function insertarError()
        {
            msj_error($this->erroresbd[1]);
            msj_error("El Registro no se guardo correctamente");
        }


     

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
