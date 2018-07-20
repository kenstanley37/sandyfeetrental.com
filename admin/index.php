<?php
    session_start();
    include("../init.php");
    require_once(ROOT_DIR."/inc/class.user.php");
    $login = new USER();

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