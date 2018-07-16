<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <!--  
        TITLE: Sandy Feet Rental with php getting the page that is loaded. Making the first letter uppercase. Stipping the .php at the end. This is so we don't have to add a title to every page.
    -->
    <title>Sandy Feet Rental 
        <?php 
            $page_name = basename($_SERVER['PHP_SELF']); 
            if($page_name === "index.php"){
                "";
            } else {
                // strstr changes everything to lower then ucfirst changes first letter to upper.
                ?> - <?php echo strstr(ucfirst($page_name),".php",true);
            }
            
        ?> 
    </title>
    
    <!-- CSS -->    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/open-iconic.css">
    <link rel="stylesheet" href="assets/css/open-iconic-bootstrap.css">
    <link rel="stylesheet" href="assets/css/sandy.css">

    <!-- JS -->  
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.-1.12.1js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/sandy.js"></script>

    
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
</head>
    
