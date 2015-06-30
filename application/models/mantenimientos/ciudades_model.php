<?php

class Ciudades_model extends MY_ModelCrud {


    
    
    public function __construct() {
        parent:: __construct();
        $this->table="ciudades";
        $this->campoBsq="estados_id";
    }


    function getCiudades($padre_id)
    {
        if(is_array($padre_id) && isset($padre_id['padre_id']))
        {
            $padre_id=$padre_id['padre_id'];
        }
        if($padre_id!="seleccione" && $padre_id!="@@@***@@@")
        {
            $this->db->from($this->table." as tb");
            $this->db->select('id,nombre as valor');
            $this->db->where('tb.estados_id',$padre_id);
            $sql = $this->db->get();
            return $sql->result();
        }else
        {
            return array();
        }
    }
    

}
?>