<?php

class Basicauth
{
  
  
  public $table="seguridad.usuarios"; 
  function __construct()
  {
      $this->CI = & get_instance();
  }

  function login($usuario, $password){
      
      $data = array();
      $row_user=$this->CI->db->get_where('seguridad.usuarios',array('usuario'=>$usuario));
      $user=$row_user->row_array();
      if(!empty($user))
      {

          if($user["intentos"]=="3" || $user['estatus']=='true')
          {
                $this->CI->db->update("$this->table",array("estatus"=>"false"),array("usuario"=>$usuario));
                $data['error'] = 'Usuario Bloqueado por maximo de intentos';
                
          }else
          {   
              if(trim($user["clave"])==trim($password))
              {
                    
                        $rs=$this->CI->db->query("select now() as tiempo");
                        $tiempo=$rs->row()->tiempo;
                        $this->CI->db->insert("seguridad.conexion",array("usuarios_id"=>$user["id"],"fecha_conexion"=>"'".$tiempo."'",'ip'=>$this->CI->input->ip_address(),"browser"=>$this->CI->input->user_agent()));
                        $rs1=$this->CI->db->get_where("seguridad.conexion",array("usuarios_id"=>$user["id"],"fecha_conexion"=>"'".$tiempo."'"));
                        $this->CI->session->sess_destroy();
                        
                        
                        
                        $this->CI->session->sess_create();
                        $this->CI->session->set_userdata(array('logged_in'=> true, 'usuario'=> $usuario, 'usuario_id'=> $row_user->row()->id,'rol_id'=>$user['rol_id'],"conexion_id"=>$rs1->row()->id));
                        $this->CI->session->set_userdata(array('ss_id'=>$this->CI->session->userdata('session_id')));
                        
                        $this->CI->sesslg->sess_destroy();
                        $this->CI->sesslg->sess_create();
                        $this->CI->sesslg->set_userdata(array('usuario_id'=>$this->CI->session->userdata("usuario_id"),"conexion_id"=>$this->CI->session->userdata("conexion_id"),"existe"=>TRUE));
                        
                        $this->CI->db->update("$this->table",array("intentos"=>0),array("usuario"=>$usuario));
                        $this->CI->load->model("admin/auditoria_model","seg");
                        $this->CI->seg->registro("Login","Inicio Session",$row_user->row()->id,-1,-1);
                        $this->CI->seg->updateTime();
                        
                        
                        
                        
                        
              
                        
              }
              else 
              {
                        $data['error'] = 'Usuario o Contraseña incorrecta';
                        $this->CI->db->update("$this->table",array("intentos"=>$user["intentos"]+1),array("usuario"=>$usuario));
              }   
          }
          
      }else
      {
          $data['error'] = 'Usuario o Contraseña incorrecta';
      }
      
       return $data;
   }
   
   function logout($fin_sistema=1)
   {
        if($fin_sistema==1)
        {
            $this->CI->load->model("admin/auditoria_model","seg");
            $this->CI->seg->registro("Login","Fin Session",$this->CI->sesslg->userdata("usuario_id"),-1,-1);
            $this->CI->seg->finTime();
            $this->CI->db->update("seguridad.conexion",array("fecha_desconexion"=>"now()","conectado"=>"false"),array("id"=>$this->CI->sesslg->userdata("conexion_id")));
        }
        
        $this->CI->sesslg->sess_destroy();
        $this->CI->session->sess_destroy();
         
   }
   
   
   
}




?>