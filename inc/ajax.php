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
}