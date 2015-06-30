<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submodulos extends CI_Controller {

        public $autoload;
        public $rutamodelo='admin/menu/';
        public $modelo='submodulos_model';
        public $ruta='/admin/submodulos';
        public $plantilla="principal";
        public $vista="admin/menu/submodulos";
        public $flash;        
        public $accion="/insertar";
        public $data;
        public $erroresbd;
        public $campos;
        public $agregarCss=FALSE;
        public $agregarJs=FALSE;
        public $objSubClass=null;


        public function  __construct()
        {
            parent::__construct();
            $this->load->helper("tables/table_1");
            add_js_libs("jquery.dataTables","dataTables_1.8.0/media/js");
            add_css_libs("demo_table_jui","dataTables_1.8.0/media/css");
            $this->load->model($this->rutamodelo.$this->modelo,"mod");

            
            if($this->session->userdata("autoload")!="")
            {
                $id_Update=$this->session->userdata("autoload");
                $this->autoload["$this->modelo"]=$this->mod->getSubModulos($id_Update);
                $this->session->unset_userdata("autoload");
                $this->accion="/actualizar/$id_Update";
            }

            if($this->session->userdata("flash")!="")
            {
                $this->flash=$this->session->userdata("flash");
                $this->session->unset_userdata("flash");
            }
        }


	public function index()
	{
            $this->data['datatabla']=$this->mod->getSubModulos()->result();
            plantilla($this->plantilla,$this->vista, $this->data);
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
           if($varii=in_post(array($this->modelo)))
           {

                $data=$varii;
                if(!isset($varii['isprog']))
                {
                    $data=array_merge($varii,array("isprog"=>"FALSE"));
                }
                
                if($this->mod->actualizar($data,$id) && empty($this->erroresbd))
                {
                    msj_exitoso("Registro fue actualizado exitosamente");
                }else
                {
                    msj_error("Error en la Bd");
                }
                $this->session->set_userdata(array("flash"=>$this->flash));
                redirect($this->ruta);
           }else
           {
                $this->session->set_userdata(array("autoload"=>$id));
                redirect($this->ruta);
           }  
        }

        
        

        public function insertar()
        {
            if($varii=in_post(array($this->modelo)))
            {
                if($this->mod->insertar($varii) && empty($this->erroresbd))
                {
                    msj_exitoso("Registro fue agregado exitosamente");
                }else
                {
                    msj_error("El Registro no se guardo correctamente");
                }
            }
            
            $this->session->set_userdata(array("flash"=>$this->flash));
            redirect($this->ruta);
        }

        public function eliminar($id)
        {
               if($this->mod->eliminar(array("id"=>$id)) && empty($this->erroresbd))
               {
                    msj_exitoso("Registro fue Eliminado exitosamente");
               }else
               {
                    msj_error("El Registro no se Elimino correctamente");
               }    
               $this->session->set_userdata(array("flash"=>$this->flash));
               redirect($this->ruta);
        }

         public function limpiar()
    {
        $this->session->unset_userdata("autoload");
        $this->session->unset_userdata("flash");
        redirect($this->ruta);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
