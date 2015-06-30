<?php


class User extends CI_Controller{

      function __construct(){
         parent::__construct();
         $this->load->library("session",array("sess_cookie_name"=>"sslg","sess_expiration"=>0),"sesslg");
         $this->sesslg->sess_destroy();
      }



      public function index()
      {
            redirect("user/login");
      }
   

      function login()
       {


          $data = array();
           if($varii=in_post(array("usuario")))
           {
               //echo $varii["clave"];
               //echo $varii["usuario"];
               //return;
              $clave= encriptarClave($varii["clave"]);
              $respuesta = $this->basicauth->login($varii["usuario"],$clave);
              if (!isset($respuesta['error']))
              {
                  redirect("menu");
              }
              else 
               {
                 $data['error'] =  msj_error($respuesta['error'],true);
                 
              }
           }else
           {
               
               if($this->session->userdata("snsession_login_msj")==TRUE)
               {
                    if($msj=$this->session->userdata("snsession_msj_exito"))
                    {
                            $data['error'] = msj_exitoso($msj,true);
                    }else
                    if($msj=$this->session->userdata("snsession_msj_error"))
                    {
                           $data['error'] =  msj_error($msj,true);
                    }  
               }
               $this->session->sess_destroy();
                 
                 
               
           }
           
          $data['controller']=& get_instance();
          plantilla('inicio','acceso/accesar', $data);
      }

      function salir($desconectado=1)
      {
          $this->basicauth->logout($desconectado);
          redirect("user/login");
      }
      
      


}

?>