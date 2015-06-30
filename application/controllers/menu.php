<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Crud {

    
         function  __construct()
        {
             $this->ruta="/menu";
             parent::__construct();
        }
    
	public function index()
	{
            $data['datatabla']=array();
            plantilla('principal','menu/menu', $data);   
	}




    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
