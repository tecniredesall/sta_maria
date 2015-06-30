<?php

class Estudiantes_model extends CI_Model {


    var $table="estudiantes";
    var $vista="vst_estudiantes";
    
    public function __construct() {
        parent:: __construct();
    }
    

    function getList($id="-1")
    {
        $this->db->from($this->vista." as tb");
        $this->db->select("*");
        if($id!=-1)
        {
            $this->db->where(array('tb.id'=>$id));
        }
        return $this->db->get();
    }


    function insertarEstudiantes($personas_id=-1)
    {
        if($personas_id!=-1)
        {
         
            $this->db->from($this->table." as tb");
            $this->db->select("id");
            $this->db->where(array('tb.personas_id'=>$personas_id));
            $objResult=$this->db->get();
            if($objResult->num_rows())
            {
                return $objResult->row();
            }else
            {
                $this->db->insert("$this->table",array("personas_id"=>$personas_id));
                $this->db->from($this->table." as tb");
                $this->db->select("id");
                $this->db->where(array('tb.personas_id'=>$personas_id));
                $objResult=$this->db->get();
                return $objResult->row();
            }
        }

    }



    function getId($cedula="00.000.000")
    {
        $this->load->model("mantenimientos/personas_model","modpersonas");
        $idPer=$this->modpersonas->getId($cedula,2);

        if($idPer->num_rows()>0)
        {
               
               $this->db->select("id");
               $this->db->from($this->table." as tb");
               $this->db->where(array("tb.personas_id"=>$idPer->row()->id));
               $objResult=$this->db->get();
               if($objResult->num_rows()>0)
               {
                    return $objResult->row()->id;
               }else
               {
                   return -100;
               }
        }else
        {
            return -200;
        }
    }
    
    
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