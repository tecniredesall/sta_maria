<?php

class Personas_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="personas";
    }


    public function prueba()
    {
        $query="select * from plan";
        $sql = $this->db->query($query);
        return  $sql;
    }
   
   



   
}
?>