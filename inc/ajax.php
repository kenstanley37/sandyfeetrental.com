<?php
include '../init.php';
require_once ROOT_DIR.'/inc/class.prop.php';
$prop = new PROP();

     $result = $prop->avg_rate_array();
     echo json_encode($result);

if(isset( $_POST['get_avg_rate'] )) {

}