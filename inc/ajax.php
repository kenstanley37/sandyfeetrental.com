<?php
include '../init.php';
require_once ROOT_DIR.'/inc/class.prop.php';
$prop = new PROP();

if(isset( $_POST['btn-avg'] )) {
     $result = $prop->avg_rate_array();
     echo json_encode($result);
} else if(isset( $_POST['btn-norent'] )) {
     $result = $prop->get_no_rent();
     echo json_encode($result);
    //echo $result;
} else if(isset( $_POST['btn-timesrented'] )) {
     $result = $prop->get_no_rent();
     echo json_encode($result);
    //echo $result;
} else if(isset( $_POST['btn-freq'] )) {
     $result = $prop->get_freq_renters();
     //echo json_encode($result);
     //print_r($result);
    echo $result;
}  else if(isset( $_POST['get_prop_list'] )) {
     $result = $prop->get_prop_list($_POST['get_prop_list']);
     print_r($result);
} else if(isset( $_POST['get_build_list'] )) {
     $result = $prop->get_build_list();
     print_r($result);
} else if(isset( $_POST['img_fetch'] )) {
     $img_fetch = $_POST['img_fetch'];
     $result = $prop->img_fetch($img_fetch);
     print_r($result);
} else if(isset( $_POST['img_upload'] )) {
     $result = $prop->img_upload($img_prop, $img_data);
    echo "dude I rock";
     print_r($result);
} else {
    echo "<h1>NOTHING HERE DUDE</h1>";
}