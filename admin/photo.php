<?php
    session_start();
    include("../init.php");
    require_once(ROOT_DIR."/inc/class.user.php");
    require_once(ROOT_DIR."/inc/class.prop.php");
    $login = new USER();

        if($login->is_loggedin()!="true")
    {
        $rank = $login->check_rank();
        if($rank != 'admin' or 'super_admin'){
            header("Location: /index.php");
        }
    }
    $prop = new PROP();
    

    $myID = '';

    include "inc/admin-header.php"; 
?>

<!-- Extra CSS and JS here -->
<script src='assets/js/jquery.form.min.js' type='text/javascript'></script> 
<script src='assets/js/photo.js' type='text/javascript'></script>  
</head>

<?php
    //include $path."/views/index-nav.php"; 
    include "inc/admin-nav.php"; 

    //echo ROOT_URL;
    //echo ROOT_DIR;
    ?>
<div id="wrapper">

     <?php include "inc/admin-sidebar.php"; ?>

      <div id="content-wrapper">

        <div class="container-fluid">
            <?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Property Images</li>
            </ol>

            <!-- Page Content -->
            <div class="container" id="admin">
                <h3 align="center">Property Image Management</h3>
                <br />
                <div class="row">
                     
                    <div class="col-12">
                        <form class="form-inline" method="post" id="uploadForm" enctype="multipart/form-data" action="inc/upload.php">
                            <div class="form-group mb-2">
                                <label for="building">Building</label>
                                <select name="building" id="building_list"></select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="property" class="sr-only">Room</label>
                                <select name="property[]" id="property_list"></select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label>Choose Images</label>
                                <input type="file" name="images[]" id="images" multiple >
                            </div>
                            <input id="submit" type="submit" name="submit" value="UPLOAD"/>
                        </form>
                        <!-- display upload status -->
                        <div id="uploadStatus"></div>
                    </div>
                
                <br />
                <div class="table-responsive" id="image_table">
                    <!-- gallery view of uploaded images --> 
                    <div class="gallery" id="imagesPreview"></div>
                    <table id="reportTable" class="table table-bordered table-striped">
                    </table>
                </div>
            </div>
            
            
            
            
        </div><!-- /.container-fluid -->
  
     <?php
    include "inc/admin-footer.php"; 
    ?>
    <div id="idTheID"><?php echo $myID; ?></div>
    <?php
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