<?php

class Espacios_model extends MY_ModelCrud {


    
    
    public function __construct() {
        parent:: __construct();
        $this->table="espacios";
    }
    
    
    
    
    public function getCmbEspaciosLibres($param)
    {
         $query="";
         $where="";
        if(is_array($param) && (isset($param['cmpBsq']) || isset($param['padre_id'])))
        {
            if(isset($param['cmpBsq']))
            {
                $padre_id=$param['cmpBsq'];
                $where=" or id=".$param['espacios_id'];
                $this->session->set_userdata(array("bsqInicialEspaciosTurno"=>$param['cmpBsq']));
                $this->session->set_userdata(array("bsqInicialEspacios"=>$param['espacios_id']));
            }
            if(isset($param['padre_id']))
            {
                $padre_id=$param['padre_id'];
                if($padre_id==$this->session->userdata("bsqInicialEspaciosTurno"))
                {
                    $where=" or id=".$this->session->userdata("bsqInicialEspacios");
                }else
                {
                    $where="";
                }
            }
            
            $turno_id=$padre_id;
            $fecha_inicio=$param['fecha_inicio'];
            $fecha_fin=$param['fecha_fin'];
            if(isset($param['espacios_id']) && $turno_id!="seleccione" && $turno_id!="@@@***@@@")
            {
                $query="select id as id,nombre as valor from espacios where id not in (select id from fn_getespaciosocup($turno_id, '$fecha_inicio' , '$fecha_fin')) ";
                if($param['espacios_id']!="-1")
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
    
}
?>