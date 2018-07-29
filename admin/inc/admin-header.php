
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123041679-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('set', {'user_id': 'USER_ID'}); // Set the user ID using signed-in user_id.
        gtag('config', 'UA-123041679-1');
    </script>

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
    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <!-- Customer CSS for admin area -->
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.structure.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/jquery-ui.theme.min.css">

    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/open-iconic.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/assets/css/open-iconic-bootstrap.css">
    

    
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

    <!-- Load c3.css -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- JS for dataTables -->
    <script src='assets/js/jquery.dataTables.min.js' type='text/javascript'></script>
    <script src='assets/js/dataTables.bootstrap4.min.js' type='text/javascript'></script>
    <script src='assets/js/admin.js' type='text/javascript'></script>
    <script src='assets/js/reports.js' type='text/javascript'></script>

    <!-- Load d3.js and c3.js -->
    <script src="assets/js/d3.min.js" charset="utf-8"></script>
    <script src="assets/js/c3.min.js"></script>
    <link href="assets/css/c3.min.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    
    
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
