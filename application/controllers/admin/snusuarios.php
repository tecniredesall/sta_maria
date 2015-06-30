<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snusuarios extends Snsession {

    
        public function  __construct()
        {
            $this->agregarJs=true;
            $this->rutamodelo='admin/usuarios/';
            $this->modelo='usuarios_model';
            $this->ruta='/admin/snusuarios';
            $this->plantilla="snsession";
            $this->vista="snsession/admin/usuarios/usuarios";
            $this->objSubClass=$this;
            parent::__construct();
            
            $this->cargarTabla();
        }

	public function index()
	{
            if(!$this->session->userdata("personas_id"))
            {
                redirect("/admin/snpersonas");
            }
            plantilla($this->plantilla,$this->vista, null);
	}
        
        
        
     public function insertar()
    {
       
            if($data=in_post(array($this->modelo)))
            {
                $error_clave="";
                $clave=in_post(array($this->modelo,"clave"));
                $clave1=in_post(array("clave1"));
                $respuesta1=in_post(array($this->modelo,"respuesta1"));
                $respuesta2=in_post(array($this->modelo,"respuesta2"));
                if(verificarClave($clave, $clave1, $error_clave)==false)
                {
                    msj_error($error_clave);
                    $this->session->set_userdata(array("flash"=>$this->flash));
                    redirect($this->ruta);
                }
                $data=array_merge($data,array("clave"=>encriptarClave($clave)));
                $data=array_merge($data, array("respuesta1"=> sha1($respuesta1)));
                $data=array_merge($data, array("respuesta2"=> sha1($respuesta2)));
                $data=array_merge($data,array("rol_id"=>"2","personas_id"=>$this->session->userdata("personas_id")));
                
                if($this->mod->insertar($data) && empty($this->erroresbd))
                {   
                    $this->objSubClass->insertarExito($varii);
                }else
                {
                    $this->objSubClass->insertarError($varii);
                }
            }else
            {
                $this->objSubClass->insertarError();
            }
            $this->session->set_userdata(array("flash"=>$this->flash));
        redirect($this->ruta);
    }



       public function actualizarExito($id=-1)
        {
             msj_exitoso("Registro fue actualizado exitosamente");
        }

        public function actualizarError($id=-1)
        {
               msj_error($this->erroresbd[1]);
               msj_error("Error al actualizar El registro");
        }
        


        public function insertarExito($post=array())
        {
            
            //msj_exitoso("Registro fue agregado exitosamente");
            $this->ruta="user/login";
            $this->session->sess_destroy();
            $this->session->sess_create();
            $this->session->set_userdata(array('snsession_login_msj'=> true));
            $this->session->set_userdata(array('snsession_msj_exito'=> "El usuario fue agregado exitosamente, Ahora Puede acceder"));
            redirect($this->ruta);
        }
        
        public function insertarError($post=array())
        {
            $this->autoload["$this->modelo"]=array("$this->modelo"=>$post);
            if(!(stristr(instancia_controller()->erroresbd[1], 'usuarios_usuario_key') === FALSE))
            {
                msj_error("El usuario se encuentra usado anteriormente, por favor ingrese otro usuario");
            }else
            {
                msj_error("El Registro no se guardo correctamente");
            }
            
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
