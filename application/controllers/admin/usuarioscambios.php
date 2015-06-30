<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarioscambios extends MY_Crud {

  
        public function  __construct()
        {   
            
            
            $this->agregarJs=true;
            $this->rutamodelo='admin/usuarios/';
            $this->modelo='usuarios_model';
            $this->ruta='admin/usuarioscambios';
            $this->plantilla="principal";
            $this->vista="admin/usuarios/cambios";
            $this->objSubClass=$this;
            $this->campos=array("Usuario"=>"usuario","Estatus"=>"estatus");
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{
                $this->data['campos']=$this->campos;
                $this->data['datatabla']=$this->mod->getList()->result();
                plantilla($this->plantilla,$this->vista, $this->data);  
	}
        

   

     public function insertar()
     {
                if($varii=in_post(array($this->modelo)))
                {
                    msj_error("No se puede registrar Usuarios");
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
    }
    
    
    
     public function actualizar($id)
        {
          if($this->modificar=="t" || $this->modePrg==true)
            {
                    if($varii=in_post(array($this->modelo)))
                    {
                        $data=$varii;
                        echo $claveOld=in_post(array("clave_old"));
                        $claveOld=encriptarClave($claveOld);
                        
                         if($this->mod->verificarOldClave($id,$claveOld)==false)
                         {
                             msj_error("La clave actual es Incorrecta");
                             $this->session->set_userdata(array("flash"=>$this->flash));
                             redirect($this->ruta);
                         }
                         
                        $clave=in_post(array($this->modelo,"clave"));
                        $clave1=in_post(array("clave1"));
                        $respuesta1=in_post(array($this->modelo,"respuesta1"));
                        $respuesta2=in_post(array($this->modelo,"respuesta2"));
                        if(verificarClave($clave, $clave1, $error_clave)==false)
                        {
                            msj_error($error);
                            $this->session->set_userdata(array("flash"=>$this->flash));
                            redirect($this->ruta);
                        }
                        $data=array_merge($data,array("clave"=>encriptarClave($clave)));
                        $data=array_merge($data, array("respuesta1"=> sha1($respuesta1)));
                        $data=array_merge($data, array("respuesta2"=> sha1($respuesta2)));
                        
                        if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                        {

                             $this->seg->registro($this->nombrePrg,"Actualizar",$this->usuario_id,$this->panelId,$this->nivel);
                             $this->objSubClass->actualizarExito($id);
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
        
        public function bloquear($id)
        {
            $msj="";
            $this->mod->bloquear($id,$msj);
            msj_exitoso($msj);
            $this->session->set_userdata(array("flash"=>$this->flash));
            redirect($this->ruta);
            
        }
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
