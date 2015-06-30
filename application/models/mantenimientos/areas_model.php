<?php

class Areas_model extends MY_ModelCrud {

    
    public function __construct() 
    {
        parent:: __construct();
        $this->table="areas";
    }
    
}
?>