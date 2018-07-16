<?php
session_start();
include("init.php");
require_once("inc/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
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
include "views/index-nav.php"; 
echo ROOT_DIR;
?>

<div class="container">
    <div class="row">
        <div class="col">The Slide Show Will Go Here</div>
        <div class="col">Other Stuff Here</div> <!-- End col-4 -->
    </div> <!-- End Row -->
</div> <!-- End Main Container -->


<?php include "views/footer.php" ?>