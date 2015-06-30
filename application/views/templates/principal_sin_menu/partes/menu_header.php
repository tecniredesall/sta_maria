<?php
    $obj=instancia_controller();
   
?>

<div class="menu_hor">

       <ul id="jMenu">
           
            <?php
                $link="";
                $obj->db->select(array('menumodulos_id','nombre','titulo','panel','orden'));
                $obj->db->where(array('usu_id'=>$obj->session->userdata('usuario_id'),'rol_id'=>$obj->session->userdata('rol_id'),"id !="=>'-1'));
                $obj->db->group_by(array('menumodulos_id','nombre','titulo','panel','orden'));
                $obj->db->from("seguridad.vst_mn_modulos");
                $obj->db->order_by("orden","asc");
                $row_user_mn=$obj->db->get();
                $data_mn=$row_user_mn->result();
                foreach ($data_mn as $value_mn)
                {
                    $obj->db->select(array('menusubmodulos_id','nombre','titulo','panel','orden'));
                    $obj->db->where(array('usu_id'=>$obj->session->userdata('usuario_id'),'menumodulos_id'=>$value_mn->menumodulos_id,'rol_id'=>$obj->session->userdata('rol_id'),"id !="=>'-1'));
                    $obj->db->group_by(array('menusubmodulos_id','nombre','titulo','panel','orden'));
                    $obj->db->from("seguridad.vst_mn_submodulos");
                    $obj->db->order_by("orden","asc");

                    $row_user_sbmn=$obj->db->get();
                    $data_sbmn=$row_user_sbmn->result();
                    
                    echo "<li>";
                    if($value_mn->panel!="")
                    {
                        $link=base_url("index.php")."/".$value_mn->panel;
                    }else
                    {
                        $link="";
                    }
                    echo "<a class='fNiv' href='".$link."' title='".$value_mn->titulo."'>$value_mn->nombre</a>";
                        if($row_user_sbmn->num_rows() > 0)
                        {
                            echo "<ul>";
                            echo "<li class='arrow'></li>";
                            foreach ($data_sbmn as $value_sbmn)
                            {
                                if($value_sbmn->panel!="")
                                {
                                    $link=base_url("index.php")."/".$value_sbmn->panel;
                                }else
                                {
                                    $link="";
                                }
                                echo "<li><a href='".$link."' title='".$value_sbmn->titulo."'>$value_sbmn->nombre</a>";
                                
                                $obj->db->select(array('menuprogramas_id','nombre','titulo','panel','orden'));
                                $obj->db->where(array('usu_id'=>$obj->session->userdata('usuario_id'),'menusubmodulos_id'=>$value_sbmn->menusubmodulos_id,'rol_id'=>$obj->session->userdata('rol_id'),"id !="=>'-1'));
                                $obj->db->group_by(array('menuprogramas_id','nombre','titulo','panel','orden'));
                                $obj->db->from("seguridad.vst_mn_programa");
                                $obj->db->order_by("orden","asc");
                                $row_user_prg=$obj->db->get();
                                $data_prg=$row_user_prg->result();
                                if($row_user_prg->num_rows() > 0)
                                {
                                    echo "<ul>";
                                    foreach($data_prg as $value_prg)
                                    {
                                        if($value_prg->panel!="")
                                        {
                                            $link=base_url("index.php")."/".$value_prg->panel;
                                        }else
                                        {
                                            $link="";
                                        }
                                        echo "<li><a href='".base_url("index.php")."/".$value_prg->panel."' title='".$value_prg->titulo."'>$value_prg->nombre</a></li>";
                                    }
                                    echo "</ul>";
                                }
                                echo "</li>";
                                 
                            }
                            echo "</ul>";
                        }
                        
                    echo "</li>";
                }

            ?>
           <li><a class="fNiv" href="<?php echo base_url("index.php");?>/menu">Inicio</a></li>
           <li><a class="fNiv" href="<?php echo base_url("index.php");?>/user/salir">Salir</a></li>
            <!--<li>
                <a class="fNiv">Category 1</a>
                <ul>
                    <li class="arrow"></li>
                    <li>
                        <a>Category 1.2</a>
                        <ul>
                            <li><a>Category 1.3</a></li>
                            <li><a>Category 1.3</a></li>
                            <li><a>Category 1.3</a></li>
                            <li><a>Category 1.3</a></li>
                            <li>
                                <a>Category 1.3</a>
                                <ul>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li>
                                        <a>Category 1.4</a>
                                        <ul>
                                            <li><a>Category 1.5</a></li>
                                            <li><a>Category 1.5</a></li>
                                            <li>
                                                <a>Category 1.5</a>
                                                <ul>
                                                    <li><a>Category 1.6</a></li>
                                                    <li><a>Category 1.6</a></li>
                                                    <li><a>Category 1.6</a></li>
                                                    <li><a>Category 1.6</a></li>
                                                    <li><a>Category 1.6</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                </ul>
                            </li>
                            <li><a>Category 1.3</a></li>
                        </ul>
                    </li>
                    <li><a>Category 1.2</a></li>
                    <li>
                        <a>Category 1.2</a>
                        <ul>
                            <li><a>Category 1.3</a></li>
                            <li>
                                <a>Category 1.3</a>
                                <ul>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                    <li><a>Category 1.4</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a>Category 1.2</a></li>
                </ul>
            </li>

            <li>
                <a class="fNiv">Category 2</a>
                <ul>
                    <li class="arrow"></li>
                    <li>
                        <a>Category 2.2</a>
                        <ul>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Category 2.2</a>
                        <ul>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Category 2.2</a>
                        <ul>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                            <li><a>Category 2.3</a></li>
                        </ul>
                    </li>
                    <li><a>Category 2.2</a></li>
                </ul>
            </li>

            <li>
                <a class="fNiv">Category 3</a>
                <ul>
                    <li class="arrow"></li>
                    <li>
                        <a>Category 3.2</a>
                        <ul>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Category 3.2</a>
                        <ul>
                            <li><a>Category 3.3</a></li>
                            <li><a>Category 3.3</a></li>
                        </ul>
                    </li>
                    <li><a>Category 3.2</a></li>
                    <li><a>Category 3.2</a></li>
                </ul>
            </li>

            <li>
                <a class="fNiv">Category 4</a>
                <ul>
                    <li class="arrow"></li>
                    <li><a>Category 4.2</a></li>
                    <li><a>Category 4.2</a></li>
                    <li>
                        <a>Category 4.2</a>
                        <ul>
                            <li><a>Category 4.3</a></li>
                            <li><a>Category 4.3</a></li>
                            <li><a>Category 4.3</a></li>
                            <li><a>Category 4.3</a></li>
                        </ul>
                    </li>
                    <li><a>Category 4.2</a></li>
                </ul>
            </li>

            <li>
                <a class="fNiv">Category 5</a>
                <ul>
                    <li class="arrow"></li>
                    <li>
                        <a>Category 5.2</a>
                        <ul>
                            <li><a>Category 5.3</a></li>
                            <li><a>Category 5.3</a></li>
                            <li><a>Category 5.3</a></li>
                            <li><a>Category 5.3</a></li>
                        </ul>
                    </li>
                    <li><a>Category 5.2</a></li>
                    <li><a>Category 5.2</a></li>
                    <li><a>Category 5.2</a></li>
                </ul>
            </li>

            <li><a class="fNiv">Category 6</a></li>

            <li>
                <a class="fNiv">Category 7</a>
                <ul>
                    <li class="arrow"></li>
                    <li><a>Category 7.2</a></li>
                    <li><a>Category 7.2</a></li>
                    <li><a>Category 7.2</a></li>
                    <li><a>Category 7.2</a></li>
                </ul>
            </li>-->
    </ul>
        
</div>

<?php
    add_js_template('principal','menu_hor');
?>