<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_respaldo extends CI_Controller {

        public $autoload;
        public $modelo='tal';
        public $flash;
        public $cat="";
	public function index()
	{

            $this->load->helper("tables/table_1");
            add_js_libs("jquery.dataTables","dataTables_1.8.0/media/js");
            add_css_libs("demo_table_jui","dataTables_1.8.0/media/css");
            $this->load->model('menu_model');

           if($varii=in_post(array("usuario")))
           {
                echo $varii["usuario"];
           }
            
           
           if($varii=in_post(array("modulo")))
           {
                $this->menu_model->insertar($varii);
           }

           
            //$this->autoload["$this->modelo"]=$this->menu_model->verModulos();
            $this->autoload['sin_modelo']['nombre']='str'; //cargar variables sin modelo
            $this->autoload['sin_modelo']['nombress']='uo0'; //cargar variables sin modelo
                //nombress
                //
                //
            //$data['modulos']=$this->menu_model->verModulos();
            
            //$data['datatabla']=$this->menu_model->verModulos()->result();
            $data=array();
            plantilla('principal','menu/principal', $data);
                
	}

        public function json($modelo="",$function="",$padre_id="0")
        {
            $data['json']=array();
            
            if($modelo!="" && $function!="" && $padre_id!="0")
            {
                $this->load->model($modelo);
                $data['json']=$this->$modelo->$function($padre_id);
                
            }
            data_json($data);
            
            
            
        }

        
        
        public function actualizar($id)
        {
            
        }

        public function insertar($id)
        {

        }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
