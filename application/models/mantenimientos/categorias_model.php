<?php

class Categorias_model extends MY_ModelCrud {


    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="farmacia_inv.categorias";
    }


   
}
?>