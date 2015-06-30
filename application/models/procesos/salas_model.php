<?php

class Salas_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="";
    }
    
    
    public function tratamientosDia()
    {
        //$sql="select p_agd.id as id,fnCedulaPaciente(pl.paciente_id) as cedula,fnNombrePaciente(pl.paciente_id) as paciente_nombres,fnnombreservicios(p_agd.servicios_id) as nombre_servicios,'t'::boolean as img_ejecutar from plan  as pl inner join pre_agenda as p_agd on pl.id=p_agd.plan_id
//where p_agd.admitido=true";
        $sql="select p_agd.id as id,fnCedulaPaciente(pl.paciente_id) as cedula,fnNombrePaciente(pl.paciente_id) as paciente_nombres,hora_inicio,hora_fin,p_agd.salas_dist_id from plan  as pl inner join agenda as p_agd on pl.id=p_agd.plan_id";
        $rs=$this->db->query($sql);
        return $rs;
        
    }

    public function tbTratamientosDia()
    {
        $sql="select pl.id as id ,fnCedulaPaciente(pl.paciente_id) as cedula,fnNombrePaciente(pl.paciente_id) as paciente_nombres from plan  as pl inner join agenda as p_agd on pl.id=p_agd.plan_id
where p_agd.admitido=true
group by pl.id,cedula,paciente_nombres";
        $rs=$this->db->query($sql);
        $rs1=$rs->result();
        $dt=array();
        foreach ($rs1 as $row)
        {
            $sql="select p_agd.id as id,fnnombreservicios(p_agd.servicios_id) as nombre_servicios,ejecutado as img_ejecutar,p_agd.hora_inicio,p_agd.hora_fin,p_agd.salas_dist_id
from plan  as pl inner join agenda as p_agd on pl.id=p_agd.plan_id
where admitido=true and pl.id=$row->id";
            $rs=$this->db->query($sql);
            $rs2=$rs->result();
            $row->otherdata=$rs2;
            $dt=array_merge($dt,array($row));
        }
        
        
        
        return $dt;
    }

    public function ejecutarCita($data)
    {
      $query="update pre_agenda set ejecutado=true where id=$data[0]";
        $rs= $this->db->query($query);
        if($rs[0]==1 && $rs["num_rows_affected"]>=1)
           {
               return array(array("act"=>1));
           }
        return array(array("act"=>0));

    }

}
    
?>