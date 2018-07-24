<?php
    session_start();
    include("../init.php");
    require_once(ROOT_DIR."/inc/class.user.php");
    require_once(ROOT_DIR."/inc/class.prop.php");
    $login = new USER();

        if($login->is_loggedin()!="true")
    {
        //header("Location: /index.php");
        $rank = $login->check_rank();
        if($rank != 'admin' or 'super_admin'){
            header("Location: /index.php");
        }
        //echo $rank;
    }


    $prop = new PROP();
    

    $myID = '';

    include $path."/views/header.php"; 
?>

<!-- ADD MORE LINKS TO JS OR CSS HERE -->
<link rel="stylesheet" href="assets/css/admin.css">
<script src='assets/js/admin.js' type='text/javascript'></script>
<script src='assets/js/photo.js' type='text/javascript'></script>
</head>

<?php

    include $path."/views/index-nav.php"; 
    

    //echo ROOT_URL;
    //echo ROOT_DIR;
?>


<div class="container">
    <h3 align="center">Property Image Management</h3>
    <br />
    <div align="right" id="dropdown"></div>
    <div align="right">
        <input type="file" name="multiple_files" id="multiple_files" multiple />
        <span class="text-muted">Only .jpg, png, .gif file allowed</span>
        <span id="error_multiple_files"></span>
    </div>
    <br />
    <div class="table-responsive" id="image_table">

    </div>
</div>
</body>

<?php
include $path."/views/footer.php"; 
?>

<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="edit_image_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Image Details</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Image Name</label>
                        <input type="text" name="image_name" id="image_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Image Description</label>
                        <input type="text" name="image_description" id="image_description" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="image_id" id="image_id" value="" />
                    <input type="submit" name="submit" class="btn btn-info" value="Edit" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>