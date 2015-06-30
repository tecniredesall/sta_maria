<?php

class Municipios_model extends MY_ModelCrud {


    
    
    public function __construct() {
        parent:: __construct();
        $this->table="municipios";
    }


    function getMunicipios($padre_id)
    {
        if(is_array($padre_id) && (isset($padre_id['cmpBsq']) || isset($padre_id['padre_id'])))
        {
            if(isset($padre_id['cmpBsq']))
            {
                $padre_id=$padre_id['cmpBsq'];
            }else
            if(isset($padre_id['padre_id']))
            {
                $padre_id=$padre_id['padre_id'];
            }
        }
        if($padre_id!="seleccione" && $padre_id!="@@@***@@@")
        {
            $this->db->from($this->table." as tb");
            $this->db->select('tb.id,tb.nombre as valor');
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