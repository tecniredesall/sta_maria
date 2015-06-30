<?php

class Diasprocesos_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="dias_procesos";
    }
    
    
    
    public function add_days($dias_id,$desc_procesos_id)
    {
            $query="select add_dias_procesos($dias_id,$desc_procesos_id) accion";
            $sql=$this->db->query($query);
            return $sql->row()->accion;
            
    }
    
    public function days($procesos_id,$salas_id)
    {
        
        echo $query="select * from ver_dias_out($procesos_id,$salas_id)";
        $sql=$this->db->query($query);
        return $sql->result();
        
    }
    
    public function dias_validacion($desc_proceso_id)
    {
        $query="select * from dias_procesos where desc_proceso_id=$desc_proceso_id";
        $sql=$this->db->query($query);
        if($sql->num_rows()>0)
        {
            return 1;
        }else
        {
            return 0;
        }
        
    }
    
    
    public function remove_dias($ids=-1)
    {
        
        return $this->db->delete("$this->table", array("desc_proceso_id"=>"$ids"));
    }
    
    

}
    
?>