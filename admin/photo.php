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
                    <div class="col-2">
                        <div align="center" id="building-dropdown">
                            <span>Building</span>
                            <select name="building" id="building_list">

                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div align="center" id="pic-dropdown">
                            <span>Property</span>
                            <select name="property" id="property_list" disabled>

                            </select>
                        </div>
                    </div>
                </div>


                <div align="right">
                    <input type="file" name="multiple_files" id="multiple_files" multiple />
                    <span class="text-muted">Only .jpg, png, .gif file allowed</span>
                    <span id="error_multiple_files"></span>
                </div>
                <br />
                <div class="table-responsive" id="image_table">
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