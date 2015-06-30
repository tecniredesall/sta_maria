<?php

class Profesores_model extends MY_ModelCrud {

    
    
    public function __construct() {
        parent:: __construct();
        $this->table="profesores";
    }
    
    
    function getProfesores($id=-1)
    {
        $query="select profesores_id as id,prf_nomb_completo as valor from vst_profesores";
    }
    
    
    function getCmbProfesores($param)
    {
        
        $query="";
        $where="";
        if(is_array($param) && (isset($param['cmpBsq']) || isset($param['padre_id'])))
        {
            
            
            if(isset($param['cmpBsq']))
            {
                $padre_id=$param['cmpBsq'];
                $where=" or profesores_id=".$param['profesores_id'];
                $this->session->set_userdata(array("bsqInicialProfesoresTurno"=>$param['cmpBsq']));
                $this->session->set_userdata(array("bsqInicialProfesores"=>$param['profesores_id']));
            }
            if(isset($param['padre_id']))
            {
                
                $padre_id=$param['padre_id'];
                if($padre_id==$this->session->userdata("bsqInicialProfesoresTurno"))
                {
                    $where=" or profesores_id=".$this->session->userdata("profesores_id");
                }else
                {
                    $where="";
                }
                
            }
            
            $turno_id=$padre_id;
            $fecha_inicio=$param['fecha_inicio'];
            $fecha_fin=$param['fecha_fin'];
            if(isset($param['profesores_id']) && $turno_id!="seleccione" && $turno_id!="@@@***@@@")
            {
                $query="select profesores_id as id,prf_nomb_completo as valor from vst_profesores where profesores_id not in (select id from fn_getProfesoresOcup($turno_id, '$fecha_inicio' , '$fecha_fin')) ";
                if($param['profesores_id']!="-1")
                {
                    $query.=$where;
                }
                
                $sql = $this->db->query($query);
                return $sql->result();    
            }else
            {
                return array();
            }
        }else
        {
            return array();
        }
        
        
        
        
    }
    
    
    

    
    
    
    function insertar($personas_id=-1)
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
    

}
?>