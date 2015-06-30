<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solsalas extends MY_Crud {

    public function  __construct()
        {
            $this->agregarJs=true;
            $this->rutamodelo='invfarmacias/';
            $this->modelo='inventarios_model';
            $this->ruta='invfarmacias/solsalas';
            $this->plantilla="principal";
            $this->vista="invfarmacias/solsalas";
            $this->objSubClass=$this;
            parent::__construct();
            $this->cargarTabla();
        }

	public function index()
	{

                    
                    $this->data['datatabla']=json_encode($this->mod->getListProdSolicitudes()->result());
                    plantilla($this->plantilla,$this->vista, $this->data);
	}

        
        public function insertar()
        {
        if($this->agregar=="t" || $this->modePrg==true)
        {

            if($model=in_post(array($this->modelo)))
            {
                $sol_id=$this->mod->addSolSalas(1);
                if(($ids=in_post(array($this->modelo,"seleccion"))) && ($cant=in_post(array($this->modelo,"cnt"))))
                {
                    foreach ($ids as $ids_val)
                    {
                        $this->mod->addPrdSol($sol_id,$ids_val,$cant[$ids_val]);
                    }
                }
                
                    msj_exitoso("Los Productos fueron añadidos Correctamente");
                    $this->session->set_userdata(array("flash"=>$this->flash));
                
            }
        }
        redirect("$this->ruta");
    }

        


        




        

        
        public function actualizarExito($id = -1) 
        {
            msj_exitoso("Registro fue actualizado exitosamente");
        }
        
        public function actualizarError($id = -1) 
        {
            msj_error($this->erroresbd[1]);
            msj_error("Error al actualizar El registro");
        }

        public function limpiar()
        {
            redirect($this->ruta);
        }

        public function insertarExito()
        {
            
            msj_exitoso("Registro fue agregado exitosamente");
        }
        
        public function insertarError()
        {
            msj_error($this->erroresbd[1]);
            msj_error("El Registro no se guardo correctamente");
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
