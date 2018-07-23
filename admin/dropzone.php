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
    <link href='assets/css/bootstrap.min.css' type='text/css' rel='stylesheet'>
    <link href='assets/css/dropzone.css' type='text/css' rel='stylesheet'>
    <link href='assets/css/style.css' type='text/css' rel='stylesheet'>

    <script src='assets/js/bootstrap.min.js' type='text/javascript'></script>
    <script src='assets/js/npm.js' type='text/javascript'></script>
    <!--
    <script src='assets/js/dropzone.js' type='text/javascript'></script>
    <script src='assets/js/dropzne.js' type='text/javascript'></script>
    -->
    <?php
?>
</head>

<?php

    include $path."/views/index-nav.php"; 
    

    //echo ROOT_URL;
    //echo ROOT_DIR;
?>

<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
<h1>DropzoneJS File Upload Demo</h1>
<SECTION>
  <DIV id="dropzone">
    <FORM class="dropzone needsclick" id="demo-upload" action="/upload">
      <DIV class="dz-message needsclick">   
        Drop files here or click to upload.<BR>
        <SPAN class="note needsclick">(This is just a demo dropzone. Selected
        files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
      </DIV>
    </FORM>
  </DIV>
</SECTION>

</body>

<?php
include $path."/views/footer.php"; 
    ?>