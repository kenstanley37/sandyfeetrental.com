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
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.structure.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/all.min.css"><!-- fontawesome -->
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/open-iconic.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/open-iconic-bootstrap.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/sandy.css">

    
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Playfair+Display" rel="stylesheet">

    
    
    <!-- JS -->  
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/jquery-ui.min-1.12.1.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/popper.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/Chart.bundle.min.js"></script>
    <!-- Palette is used to give a color scheme to ChartJS -->
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/palette.js"></script>
    <!-- Used for drag and drop file uploading -->
    <script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/sandy.js"></script>

    
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
