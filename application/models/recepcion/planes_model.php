<?php

class Planes_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->table="plan";
    }


    public function savePlan($post)
    {
     
        $vef=true;
        foreach (($post[3]["json"]) as $value)
        {
           
           $query="insert into solicitudes (plan_id,servicios_id,cant,precio,precio_total)values($post[1],".$value["servicios_id"].",".$value["cant"].",fnPreciosServicios(".$value["servicios_id"]."),(fnPreciosServicios(".$value["servicios_id"].")*".$value["cant"]."))";
           $rs=$this->db->query($query);
           if(!$rs[0]==1 && !$rs["num_rows_affected"]==1)
           {
               $vef=false;
           }
           
           
        }

        if($vef==true)
        {
            $query="update plan set paciente_id=$post[0],nombre_plan='".$post[2]."',
            monto_solicitudes=(select sum(precio_total) from solicitudes where plan_id=$post[1])
            ,sys=false
            where id=$post[1]";
            $rs=$this->db->query($query);
           if($rs[0]==1 && $rs["num_rows_affected"]>=1)
           {
               return array(array("save"=>1));
           }
        }
        

        return array(array("save"=>0));
    }

    public function addPlanTmp()
    {
        $query="select fnAddPlanTmp() as plan_id";
        $data= $this->db->query($query);
        return $data->row()->plan_id;
    }
    
    
    public function AddItemsPlans($data)
    {
        $query="select 'false'::boolean as pagado,id,nombre,precio,color from servicios where not id=$data[0] limit 0";
        $data= $this->db->query($query)->result();
        return $data;
    }

    public function AddItemsCita($data)
    {
        $query="select 'false'::boolean as pagado,'false'::boolean as espera,'true'::boolean as activar,id,nombre,precio,color from servicios where not id=$data[0]";
        $data= $this->db->query($query)->result();
        return $data;
    }
    
    public function autocompletePacientes($bsq,$params)
    {
        $bsq=trim($bsq);
        $query="select pacientes_id as data,cedula as value, nombres  from vst_pacientes where cedula like '$bsq%'";
        $data= $this->db->query($query)->result();
        return array("jquery"=>"Unit","suggestions"=>$data);
    }


    public function getPlanesPacientes($bsq,$params)
    {
        $bsq=trim($bsq);
        $query="select pacientes_id as data,cedula as value, nombres  from vst_pacientes where cedula like '$bsq%'";
        $data= $this->db->query($query);
        return array("jquery"=>"Unit","suggestions"=>$data->result());
    }


    public function AddItems($id)
    {
        $query="select id,nombre,precio,color from servicios where id=$id[0]";
        $data= $this->db->query($query)->result();
        return $data;
    }


}
?>