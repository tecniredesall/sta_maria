<?php

class Minutos_model extends MY_ModelCrud {


    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="tiempo_minutos";
    }

   
}
?>