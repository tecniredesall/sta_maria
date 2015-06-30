<?php

class Solicitud_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="servicios";
    }
    
    
    
    public function autocompleteServicio($bsq,$params)
    {
        $where="";
        if(isset($params["servicios_id"]))
        {
            $where="and id not in (".$params["servicios_id"].")";
        }
        $query="select id as data,nombre as value from servicios where nombre like '$bsq%' $where";
        $data= $this->db->query($query)->result();
        return array("jquery"=>"Unit","suggestions"=>$data);
    }
    
    public function AddItems($id)
    {
        $query="select id,nombre,precio,color from servicios where id=$id[0]";
        $data= $this->db->query($query)->result();
        return $data;
    }


}
?>