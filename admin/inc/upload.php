<?php
include('../../init.php');
require_once('dbconfig.php');
$database = new Database();
$db = $database->dbConnection();
$conn = $db;

if(isset($_POST['submit'])){
    $prop_build = $_POST['building'];
    $prop_name = $_POST['property'];
    $prop_num = $prop_name[0];
    //get the name of the property instead of using the property ID. This is for better folder naming.
    try
        {
            $query = "
                SELECT prop_num from property where prop_id = $prop_num
                ";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $prop_id = $result[0]['prop_num'];
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    //print_r($prop_id);
    // File upload configuration
    $targetDir = "../uploads/".$prop_build."/".$prop_id."/";
    if(!is_dir($targetDir))
    {
        mkdir($targetDir, 0700, true);
    }
    
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        //echo $image_name;
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];
        
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        
        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){    
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                $images_arr[] = $targetFilePath;
                $img_link = '/admin/uploads/'.$prop_build.'/'.$prop_id.'/'.$fileName;
                //echo $prop_id;
                try
                    {
                        $query = "
                        INSERT INTO prop_pics (prop_id, prop_pic_name, prop_pic_desc, prop_pic_link) 
                        VALUES ('".$prop_num."', '".$fileName."', '', '".$img_link."')
                        ";
                        $stmt=$conn->prepare($query);
                        $stmt->execute();
                    }
                    catch(PDOException $e)
                    {
                        echo $e->getMessage();
                    }
            }
            //$img_link = '/admin/uploads/'.$prop_id[0].'/'.$fileName;
            //echo '<img src="'.$img_link.'">';
        }
    }
} else {
    echo "Nothing Here Dude";
}
?>