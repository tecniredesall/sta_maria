<?php

class Pacientes_model extends MY_ModelCrud {

    
    public function __construct()
    {
        $this->table="pacientes";
        $this->vst="vst_pacientes";
        parent:: __construct();
        
    }

        

    function getListVst($id="-1",$where=array())
    {
        $this->db->from($this->vst."");
        $this->db->select("*");
        if(!empty($where))
        {
            $this->db->where($where);
        }else
        if($id!=-1)
        {
            $this->db->where(array('pacientes_id'=>$id));
        }
        return $this->db->get();
    }


    function addPaciente($cedula,$ref)
    {

        $query="select add_pacientes('".$cedula."',".$ref.") as paciente_id";
        $sql = $this->db->query($query);
        return $sql->row()->paciente_id;
    }




    function isPaciente($cedula=-1)
    {

        
        $this->db->from("$this->vst as tb");
        $this->db->select("*");
        if($cedula!=-1)
        {
            $this->db->where(array('tb.cedula'=>$cedula));
        }
        $objResul=$this->db->get();
        return $objResul;
    }


    function getCedula($cedula=-1)
    {
        $this->db->from("personas as tb");
        $this->db->select("id");
        if($cedula!=-1)
        {
            $this->db->where(array('tb.cedula'=>trim($cedula)));
        }
        $objResul=$this->db->get();
        return $objResul;
    }
   



   
}
?>