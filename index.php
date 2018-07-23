<?php
session_start();
include("init.php");
require_once("inc/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	//$login->redirect('home.php');
    $rank = $login->check_rank();
    
}

if(isset($_POST['btn-login']))
{
	$umail = strip_tags($_POST['txt_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($umail,$upass))
	{
        $login->check_rank();

		//$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<?php 
include "views/header.php"; 
?> </head> <?php
include "views/index-nav.php"; 
//echo ROOT_DIR;
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col" id="index-img"></div>
        </div> <!-- End Row -->
        <div class="row">
            <div class="col">
                <p>Paragraph about Sandy Feet Rental</p>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col">
                        Blog Here
                    </div>
                </div>
            </div>
            <div class="col-2">
                Img Here
            </div>
        </div>
    </div> <!-- End Main Container -->
</body>

<?php include "views/footer.php" ?>