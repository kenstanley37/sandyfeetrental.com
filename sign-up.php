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
<script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/zipcode.js"></script>

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

                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Last name</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                    Please choose a username.
                                    </div>
                                </div>
                            </div>
                            
                        </div> <!-- end form row -->
                        
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">City</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                                <div class="invalid-feedback">
                                Please provide a valid city.
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">State</label>
                                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                                <div class="invalid-feedback">
                                Please provide a valid state.
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="sandyZip">Zip</label>
                                <input type="text" class="form-control" id="sandyZip" placeholder="Zip" required>
                                <div class="invalid-feedback">
                                Please provide a valid zip.
                                </div>
                            </div>
                            
                        </div> <!-- end form row -->
                        
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                You must agree before submitting.
                                </div>
                            </div>
                            
                        </div> <!-- end form group -->
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>

                    <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                    </script>
                </div> <!--/login-wrapper-->
            </div> <!--/col-md-6-->
        </div> <!--/row -->
    </div> <!-- End register container -->

</section>

<?php include "views/footer.php" ?>