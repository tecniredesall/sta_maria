<?php

class Submodulos_model extends CI_Model {


    var $table="seguridad.menusubmodulos";
    
    public function __construct() {
        parent:: __construct();
    }


    

    function getCmb()
    {
        $query="select id,nombre as valor from $table where id!=-1";
        $sql = $this->db->query($query);
        return $sql->result();
    }



    function submodulos($padre_id)
    {   
        if(is_array($padre_id) && isset($padre_id['padre_id']))
        {
            $padre_id=$padre_id['padre_id'];

        }
        if($padre_id!="seleccione" && $padre_id!="@@@***@@@")
        {
            $where=" where menumodulos_id=$padre_id";
            $query="select id,nombre as valor from $this->table $where";
            $sql = $this->db->query($query);
            return $sql->result();
        }else
        {
            return array();
        }
    }



    //////////////////////////////////////////////////////////////////////////////////////


    
    function getSubModulos($id="-1")
    {
        $where="";
        $this->db->from($this->table);
        $this->db->select("*");
        $this->db->where('id !=',"-1");
        if($id!=-1)
        {
            $this->db->where(array('id'=>$id));

        }
        return $this->db->get();
    }



    ////////////////////////////////////////////////////////////////////////////////////////

    
    function insertar($datos)
    {
        return $this->db->insert("$this->table",$datos);
    }

    
    function actualizar($datos,$id=-1)
    {
       return $this->db->update($this->table, $datos,array("id"=>$id));
        
    }
    
    function eliminar($where=array())
    {
        if(!empty($where))
        {
            return $this->db->delete("$this->table", $where);
        }
        return null;
    }





   
}
?>