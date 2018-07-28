<?php
session_start();
include('init.php');
require_once('inc/class.user.php');
$user = new USER();



if($user->is_loggedin()!="")
{
	//$login->redirect('home.php');
    $rank = $user->check_rank();
    
}

if(isset($_POST['btn-signup']))
{
    $ufname = ucfirst(strtolower(strip_tags($_POST['txt_ufname'])));
    $ulname = strip_tags($_POST['txt_ulname']);
    $ustreet = strip_tags($_POST['txt_ustreet']);
    $ustate = strip_tags($_POST['txt_ustate']);
    $uzip = strip_tags($_POST['txt_uzip']);
    $uphone = strip_tags($_POST['txt_uphone']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);	
    $ujoindate = date("Y-m-d H:i:s");
    //$utype = "renter";

	if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_email FROM user WHERE user_email=:umail");
			$stmt->execute(array(':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
            if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($ufname, $ulname, $ustreet, $ustate, $uzip, $uphone, $umail, $upass, $ujoindate)){	
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
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

?>
<!--
    Add more css or js here
-->
</head>
<?php

include "views/index-nav.php"; 
?>
<section class="page">

    <!-- ===  Page header === -->

    <div class="page-header" style="background-image:url(assets/images/header-1.jpg)">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="title">Register an account</h2>
                    <p>Guest information</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container register">
        <div class="row justify-content-md-center">
            <!-- === left content === -->

            <div class="col-md-8">

                <!-- === login-wrapper === -->

                <div class="login-wrapper">

                    <div class="white-block">


                        <!--signup-->

                        <div class="login-block login-block-signup">

                            <div class="h4">Register now</div>

                            <hr />

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="First name: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Last name: *">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Zip code: *">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="City: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Email: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Phone: *">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr />
                                    <span class="checkbox">
                                        <input type="checkbox" id="checkBoxId1">
                                        <label for="checkBoxId1">I have read and accepted the <a href="#">terms</a></label>
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <span class="checkbox">
                                        <input type="checkbox" id="checkBoxId2">
                                        <label for="checkBoxId2">Subscribe to exciting newsletters and great tips</label>
                                    </span>
                                    <hr />
                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="btn btn-main btn-primary btn-block">Create account</a>
                                </div>

                            </div>
                        </div> <!--/signup-->
                    </div>
                </div> <!--/login-wrapper-->
            </div> <!--/col-md-6-->
        </div> <!--/row -->
    </div> <!-- End register container -->

</section>

<?php include "views/footer.php" ?>