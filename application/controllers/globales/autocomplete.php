<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

        public $erroresbd=array();
        public $db_exception=FALSE;
        public function  __construct()
        {
            parent::__construct();
        }

	public function index()
	{
            $modelo=in_post("modelo");
            $function=in_post("fn");
            $query=in_post("query");
            $vari=in_post("json");
            $params=array();
            
            if(!empty($vari)){
                foreach ($vari as $key=>$value)
                {
                    $params=array_merge($params,array($key=>$value));
                }
            }
            $this->load->model("$modelo","mod");
            $data['json']=$this->mod->$function($query,$params);
            data_json($data);
	}
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
