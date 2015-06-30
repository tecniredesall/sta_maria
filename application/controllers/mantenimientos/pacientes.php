<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pacientes extends MY_Crud {


    
        public function  __construct()
        {
            $this->modePrg=true;
            $this->rutamodelo='mantenimientos/';
            $this->modelo='pacientes_model';
            $this->ruta='/mantenimientos/pacientes';
            $this->plantilla="principal";
            $this->vista="mantenimientos/pacientes";
            $this->objSubClass=$this;
            $this->campos=array("Cedula"=>"cedula","Nombre"=>"nombres","Apellido"=>"apellidos","Tlf. Celular"=>"tlf_celular","Tlf. Local"=>"tlf_local");
            $this->fnActualizar="getListVst";
            parent::__construct();
            $this->cargarTabla();
            $this->session->unset_userdata("ruta_error");
            $this->session->unset_userdata("ruta_exito");
            if($this->session->userdata("registro")!="vst_pacientes")
            {
                $this->session->unset_userdata("registro");
                $this->session->unset_userdata("cedula");
            }
            
            $this->session->unset_userdata("personas");
            $this->session->unset_userdata("registro");
            
            

        }
        
	public function index()
	{
            $this->autoload['independiente'][$this->modelo]["cedula"]=$this->session->userdata("Admcedula");
            if($ced=$this->session->userdata("cedula"))
            {
                $ref=$this->session->userdata("ref");
                $id=$this->mod->addPaciente($ced,$ref);
                msj_exitoso("Paciente registrado");  
            }
            $this->session->unset_userdata("Admcedula");
            $this->session->unset_userdata("ref");
            $this->session->unset_userdata("registro");
            $this->session->unset_userdata("cedula");


            
            $this->data['campos']=$this->campos;
            $this->data['datatabla']=$this->mod->getList()->result();
            $this->accion="/insertar";
            plantilla($this->plantilla,$this->vista, $this->data);
	}

        
        public function insertar($cedula="")
        {
            $this->session->unset_userdata("cedula");
            $this->session->unset_userdata("registro");
            if($varii=in_post(array($this->modelo,"cedula")))
            {
                $ref=in_post(array($this->modelo,"referencia"));
                $this->session->set_userdata(array("ref"=>$ref));
                $num=$this->mod->getCedula($varii);
                if($num->num_rows()>0)
                {
                    
                    $pac=$this->mod->isPaciente($varii);
                    if($pac->num_rows()>0)
                    {
                        $pac=$pac->result();
                        redirect($this->ruta."/actualizar/".$pac[0]->pacientes_id);
                    }else   
                    {
                        if($ref=in_post(array($this->modelo,"referencia")))
                        {
                            $id=$this->mod->addPaciente($varii,$ref);
                            msj_exitoso("Paciente registrado");
                            $this->session->set_userdata(array("flash"=>$this->flash));
                            redirect($this->ruta);
                        }else
                        {
                            msj_error("Debe Agregar una referencia");
                            $this->session->set_userdata(array("flash"=>$this->flash));
                            redirect($this->ruta);
                        }
                    }
                    
                }else
                {
                    $this->session->set_userdata(array("cedula"=>$varii));
                    $this->session->set_userdata(array("registro"=>"vst_pacientes"));
                    redirect("mantenimientos/personas/");
                }
            }else
            {
                $this->erroresbd[1]="1";
                $this->objSubClass->insertarError();
            }
            $this->session->set_userdata(array("flash"=>$this->flash));
            redirect($this->ruta);
        }

         public function limpiar()
        {
            $this->session->unset_userdata("cedula");
            $this->session->unset_userdata("registro");
            redirect($this->limpiar);
        }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
