<?php

class Productos_model extends MY_ModelCrud {

    
    public function __construct() {
        parent:: __construct();
        $this->vst="farmacia_inv.view_prod_det";
        $this->table="farmacia_inv.productos_detalles";
    }

    public function getListVst()
    {
        $sql="select prod_detalles_id as id,* from farmacia_inv.view_prod_det";
        $rs=$this->db->query($sql);
        return $rs;
    }


    public function addProducto($data)
    {
        $sql='select farmacia_inv.addproductos('.'\''.$data["nombre"].'\''.', '.$data["categorias_id"].', -1, '.$data["medida_parcial"].', '.$data["medidas_id"].', '.'\''.$data["descripcion"].'\''.' , '.'\''.$data["istotal"].'\''.','.'\''.$data['cod_unico'].'\''.' ,'.$data["marcas_id"].', '.$data["empaques_id"].' , '.$data["cant_empaque"].','.'\''.$data["cod_barras"].'\''.')';
        $rs=$this->db->query($sql);
        if(is_array($this->db->excepBd))
        {

            echo $this->db->excepBd[2];
            return "f";
        }else
        {
            return $rs->row()->addproductos;
        }
        
    }




    


   
}
?>