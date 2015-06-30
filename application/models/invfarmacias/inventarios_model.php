<?php

class Inventarios_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->vst="farmacia_inv.view_prod_det";
        $this->table="pre_agenda";
    }


    public function getListVst()
    {
        $sql="select prod_detalles_id as id ,* from farmacia_inv.view_prod_det";
        $query= $this->db->query($sql);
        return $query;
    }


    public function getListProdSolicitudes()
    {
        $sql="select prod_id as id,* from farmacia_inv.view_prod_det";
        $query= $this->db->query($sql);
        return $query;
    }

    public function getList_sal_inv_princ()
    {
        $sql="select prod_id as id,* from farmacia_inv.view_sol_inv_princ";
        $query= $this->db->query($sql);
        return $query;
    }

    public function addEntInvPrin($conf_inv_principal_id)
    {
        $sql="select farmacia_inv.addentmovprin($conf_inv_principal_id) as id";
        $rs= $this->db->query($sql);
        if(is_array($this->db->excepBd))
        {
            echo $this->db->excepBd[2];
            return "-1";
        }else
        {
            return $rs->row()->id;
        }
    }
    
    public function addSalInvPrin($sol_salas_id)
    {
        $sql="select farmacia_inv.salmovprin($sol_salas_id) as id";
        $rs= $this->db->query($sql);
        if(is_array($this->db->excepBd))
        {
            echo $this->db->excepBd[2];
            return "-1";
        }else
        {
            return $rs->row()->id;
        }
    }



    public function addSolSalas($salas_id)
    {
        $sql="select farmacia_inv.addsolsalas($salas_id) as id";
        $rs= $this->db->query($sql);
        if(is_array($this->db->excepBd))
        {
            echo $this->db->excepBd[2];
            return "-1";
        }else
        {
            return $rs->row()->id;
        }
    }

    public function addPrdSol($solsalas_id,$productos_id,$unidad_cant)
    {
        $sql="insert into farmacia_inv.prod_sol_salas
            (sol_salas_id,productos_id,cant_unidades)
            values($solsalas_id,$productos_id,$unidad_cant)";
        $query= $this->db->query($sql);
        return $query;
    }



    public function addPrdInvPrin($cfg_id,$sal_id,$dt_id,$emp_cant)
    {
        $sql="insert into farmacia_inv.mov_inventario_principal
            (conf_inv_principal_id,ent_mov_principal_id,productos_detalles_id,cant_empaques_ent,isentrada)
            values($cfg_id,$sal_id,$dt_id,$emp_cant,true)";
        $query= $this->db->query($sql);
        return $query;
    }

    public function salPrdInvPrin($cfg_id,$sal_id,$dt_id,$uni_cant)
    {
        $sql="insert into farmacia_inv.mov_inventario_principal
            (conf_inv_principal_id,sal_mov_principal_id,productos_detalles_id,cant_unidades_sal,isentrada)
            values($cfg_id,$sal_id,$dt_id,$uni_cant,false)";
        $query= $this->db->query($sql);
        return $query;
    }

   public function fnInventarioProd($producto_id,$conf_inv_prin=-1)
   {
        $sql="select prod_detalles_id,prod_id,marca,medida,medida_parcial,empaque,cant_empaque,nombre,cant_empaque_final,cant_unidades_final,cant_unidades_total_final from farmacia_inv.view_inv_princ_empaque_actual
        where prod_id=$producto_id[0]";
        $rs= $this->db->query($sql);
        return $rs->result();
   }

   public function saveSalInvPrin($data) //guardar productos de salida del inventario
   {
       
       foreach($data[1] as $value0)
       {

           $vef=true;
           $prod_id=$value0["prd_id"];
           foreach($value0['inv'] as $value1)
           {
               $sql="insert into farmacia_inv.mov_inventario_principal (conf_inv_principal_id,sal_mov_principal_id,productos_detalles_id,cant_unidades_sal)values(1,".$data[0].",".$value1['dets'].",".$value1['cnt'].")";
               $rs=$this->db->query($sql);
               if(!$rs[0]==1 && !$rs["num_rows_affected"]==1)
               {
                       $vef=false;
               }
           }
       }
       return array(array("act"=>$vef));;
   }


}
?>