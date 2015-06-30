<?php

class Ejecutores_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="ejecutores";
    }
    
    
    
    function  personas_ejecutores($procesos_id)
    {
            $query="select *,'-1'::integer as bsq from vst_personal as vst where vst.personal_id not in (select personal_id from ejecutores where procesos_id=$procesos_id)";
            $sql = $this->db->query($query);
            return $sql->result(); 
    }
    
    function  personas_seleccionadas($procesos_id)
    {
            $query="select * from vst_ejecutores where procesos_id=$procesos_id";
            $sql = $this->db->query($query);
            return $sql->result();
    }
  
    function eliminar($where=array())
    {
        if(!empty($where))
        {
            return $this->db->delete("$this->table", $where);
        }
        return null;
    }
    
    public function ejecutores_validacion($procesos_id)
    {
        $query="select * from ejecutores where procesos_id=$procesos_id";
        $sql=$this->db->query($query);
        if($sql->num_rows()>0)
        {
            return 1;
        }else
        {
            return 0;
        }
        
    }
    
    
}
?>