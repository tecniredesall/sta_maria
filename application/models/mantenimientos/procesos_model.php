<?php

class Procesos_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="procesos";
    }


    
   

    
    public function add_ids($session_id)
    {
        $query="select  * from sys_proceso('$session_id')";
        $sql = $this->db->query($query);
        return  $sql->row();
    }
    
    public function getDesc_proceso($id)
    {
        $query="select * from desc_proceso where procesos_id=$id";
        $sql = $this->db->query($query);
        return  $sql;
    }
    
    public function ids($id_procesos)
    {
        $query="select id as desc_procesos_id,procesos_id from desc_proceso where procesos_id=$id_procesos";
        $sql = $this->db->query($query);
        return  $sql->row();
    }
    
    
    
    
    
    
    
    

   
}
?>