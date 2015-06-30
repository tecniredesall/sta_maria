<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

        public $erroresbd=array();
        public $db_exception=FALSE;
        public function  __construct()
        {
            parent::__construct();
        }

	public function index()
	{
            $modelo=in_post("mod");
            $function=in_post("fn");
            $cnt=in_post("cnt");
            $tipo=in_post("tipo");


            
            $parametros=array();
            for($i=1;$i<=$cnt;$i++)
            {
                $parametros[$i-1]=in_post("param$i");
            }
            
            $data['json']=array();
            if($modelo!="" && $function!="" && !(empty ($parametros)) && $modelo!=null && $function!=null)
            {
                $this->load->model($modelo."_model","modulo");
                $data['json']=$this->modulo->$function($parametros);
            }
            data_json($data);
	}
        
        public function set_data_sessiones()
	{

            $vari=in_post("json");
            
           
            
                foreach ($vari as $key=>$value)
                {
                    $this->session->set_userdata(array("$key"=>"$value"));

                }

             
            
            $data['json']=array("exito"=>"1");
            data_json($data);
	}
        
        
        
        

     public function jsonSubCmb()
     {
        $modelo=in_post("modelo");
        $function=in_post("function");
        $padre_id=in_post("padre_id");
        $parametros=in_post("parametros");
        
        if(!is_null($parametros) && is_array($parametros))
        {
                $parametros=array_merge($parametros,array("padre_id"=>$padre_id));
        }else
        {
            $parametros=$padre_id;
        }
        
        $data['json']=array();
        if($modelo!="" && $function!="" && $padre_id!="0" && $modelo!=null && $function!=null && $padre_id!=null)
        {
            $this->load->model($modelo,"modulo");
            $data['json']=$this->modulo->$function($parametros);
        }
        data_json($data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
