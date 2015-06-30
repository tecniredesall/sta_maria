<?php

class Acceso {

      function __construct(){

      }
      function identificado()
      {
          $this->CI = & get_instance();
          if($this->CI->session->userdata('snsession')==true)
          {
              
          }else{
                if($this->CI->session->userdata('logged_in')==true && $this->CI->router->method == 'login')
                {
                    redirect ('menu');
                }
                if($this->CI->session->userdata('logged_in')!=true && $this->CI->router->method != 'login' && $this->CI->router->class != 'user')
                {
                    redirect ('user/login');
                }
          }
      }
}
?>