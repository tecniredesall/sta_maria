<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Crud {

  
        public function  __construct()
        {
            $this->agregarJs=TRUE;
            
            $this->modePrg=true;
            $this->rutamodelo='admin/usuarios/';
            $this->modelo='usuarios_model';
            $this->ruta='/admin/usuarios';
            $this->plantilla="principal";
            $this->vista="admin/usuarios/usuarios";
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
            if($this->session->userdata("personas_id"))
            {
            }else
            {
                redirect("admin/verificar");
            }
        }

	public function index()
	{
                plantilla($this->plantilla,$this->vista, null);  
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
             $this->session->unset_userdata("personas_id");
             redirect("admin/verificar");
        }


     public function insertar()
     {
            if($personas_id=$this->session->userdata("personas_id"))
            {
                if($varii=in_post(array($this->modelo)))
                {
                $clave=in_post(array($this->modelo,"clave"));
                $clave1=in_post(array("clave1"));
                $respuesta1=in_post(array($this->modelo,"respuesta1"));
                $respuesta2=in_post(array($this->modelo,"respuesta2"));
                
                $error="";
                if(verificarClave($clave,$clave1,$error)==false)
                {
                    
                    msj_error($error);
                    $this->session->set_userdata(array("flash"=>$this->flash));
                    redirect($this->ruta);
                }
                
                    $varii=array_merge($varii, array("clave"=> md5($clave1).substr(sha1($clave1),5,10)));
                    $varii=array_merge($varii, array("respuesta1"=> sha1($respuesta1)));
                    $varii=array_merge($varii, array("respuesta2"=> sha1($respuesta2)));
                    
                    $varii=array_merge($varii, array("personas_id"=>$personas_id));
                    if($this->mod->insertar($varii) && empty($this->erroresbd))
                    {
                        $this->session->unset_userdata("personas_id");
                        msj_exitoso("El usuario se Agrego exitosamente");
                        $this->ruta="admin/verificar";
                    }else
                    {
                         msj_error($this->erroresbd[1]);
                        msj_error("El Registro no se guardo correctamente");
                    }
                        
                }else
                {
                    $this->erroresbd[1]="1";
                    
                    msj_error($this->erroresbd[1]);
                    msj_error("El Registro no se guardo correctamente");
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
            }else
            {
                $this->session->unset_userdata("personas_id");
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect("admin/verificar");
            }
    }

   

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
