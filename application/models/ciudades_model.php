<?php

class Ciudades_model extends CI_Model {


    var $table="ciudad";
    public function __construct() {
        parent:: __construct();
    }


    function getCmb()
    {
        $query="select id,nombre as valor from modulo";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    
    function otra()
    {
        $query="select id,nombre as valor from modulo";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    

    function municipio($padre_id)
    {
        if(is_array($padre_id) && isset($padre_id['padre_id']))
        {
            $padre_id=$padre_id['padre_id'];
            
        }
        if($padre_id!="seleccione")
        {
            $query="select id,nombre as valor from modulo limit 4";
            $sql = $this->db->query($query);
            return $sql->result();
        }else
        {
            return array();
        }
    }
    

    function parroquia($padre_id)
    {
        if(is_array($padre_id) && isset($padre_id['padre_id']))
        {
            $padre_id=$padre_id['padre_id'];

        }
        if($padre_id!="seleccione")
        {
            $query="select id,nombre as valor from modulo";
            $sql = $this->db->query($query);
            return $sql->result();
        }else
        {
            return array();
        }
    }

}
?>