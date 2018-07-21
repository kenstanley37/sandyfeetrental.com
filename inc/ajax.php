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
     echo json_encode($result);
    //echo $result;
}