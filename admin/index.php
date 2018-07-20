<?php
    session_start();
    include("../init.php");
    require_once(ROOT_DIR."/inc/class.user.php");
    require_once(ROOT_DIR."/inc/class.prop.php");
    $login = new USER();
    $prop = new PROP();

    //$avg_rate[] = $prop->avg_rate_array();

    if($login->is_loggedin()!="")
    {
        //$login->redirect('home.php');
        $rank = $login->check_rank();

    }


    include $path."/views/header.php"; 
    include $path."/views/index-nav.php"; 
    //echo ROOT_URL;
    //echo ROOT_DIR;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-2"><?php include $path."/views/admin/admin-nav.php"; ?></div>
            <div class="col-10">
                <div class="row">
                    <div class="col-6"><?php print $prop->avg_rate(); ?>
                    </div>
                    <div class="col-6" id="avg_rate">
                        <canvas id="avg_rate_pie"></canvas>
                    </div>
                </div>
            </div>
        </div>

    



    </div>
    

    <?php


    include $path."/views/footer.php"; 
?>