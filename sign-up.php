<?php session_start();
include('init.php');
require_once('inc/class.user.php');
$login = new USER();

if(isset($_SESSION['user_fName'])){
    $login->redirect('index.php');
}

if($login->is_loggedin()!="")
{
	//$login->redirect('home.php');
    $rank = $login->check_rank();
    echo $rank;
    
}

if(isset($_POST['sandySubmit']))
{
    $ufname = ucfirst(strtolower(strip_tags($_POST['sandyFname']))); $_SESSION['ufname'] = $ufname;
    $ulname = strip_tags($_POST['sandyLname']); $_SESSION['ulname'] = $ulname;
    $ustreet = strip_tags($_POST['sandyAddress']); $_SESSION['ustreet'] = $ustreet;
    $ustate = strip_tags($_POST['sandyState']); $_SESSION['ustate'] = $ustate;
    $ucity = strip_tags($_POST['sandyCity']); $_SESSION['ucity'] = $ucity;
    $uzip = strip_tags($_POST['sandyZip']); $_SESSION['uzip'] = $uzip;
    $uphone = strip_tags($_POST['sandyPhone']); $_SESSION['uphone'] = $uphone;
	$umail = strip_tags($_POST['sandyEmail']); $_SESSION['umail'] = $umail;
	$upass = strip_tags($_POST['sandyPass2']); $_SESSION['upass'] = $upass;
    $ujoindate = date("Y-m-d H:i:s");
    //$utype = "renter";

	if($umail=="")	{
		$error['email'] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error['email'] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error['password'] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error['password'] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $login->runQuery("SELECT user_email FROM user WHERE user_email=:umail");
			$stmt->execute(array(':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
            if($row['user_email']==$umail) {
				$error['email'] = "Email address is taken";
			}
			else
			{
				
                if($login->register($ufname, $ulname, $ustreet, $ustate, $ucity, $uzip, $uphone, $umail, $upass, $ujoindate)){	
                    $_SESSION['fname'] = serialize($umail);
                    $_SESSION['pass'] = serialize($upass);
                    $login->redirect('sign-up.php?joined');
				}
                 else {
                    echo 'I dont rock';
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
<script type="text/javascript" src="<?php echo ROOT_URL ?>/assets/js/register.js"></script>

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

    
<?php if(isset($_GET['joined'])){
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 title text-center" id>
                Thanks for registering. Please sign in to reserve a property.
            </div>
        </div>
    </div>
    <?php
?></section><?php
}else {
    ?>
    <div class="container register">
        <div class="row justify-content-md-center">
            <!-- === left content === -->

            <div class="col-md-8">

                <!-- === login-wrapper === -->

                <div class="login-wrapper">

                    <form class="needs-validation register" method="post" novalidate>
                        <div class="form-row">

                            <div class="col-md-4 mb-3">
                                <label for="sandyFname">First name</label>
                                <input type="text" name="sandyFname" class="form-control" id="sandyFname" placeholder="First name" value="<?php if(isset($_SESSION['ufname'])){echo $_SESSION['ufname'];}?>" required>
                                <div class="invalid-feedback">
                                    Please enter your first name
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="sandyLname">Last name</label>
                                <input type="text" name="sandyLname" class="form-control" id="sandyLname" placeholder="Last name" value="<?php if(isset($_SESSION['ulname'])){echo $_SESSION['ulname'];}?>" required>
                                <div class="invalid-feedback">
                                    Please enter your last name
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="sandyEmail">E-Mail</label>
                                <div class="input-group">
                                    <input type="email" name="sandyEmail" class="form-control" id="sandyEmail" placeholder="E-Mail" aria-describedby="inputGroupPrepend" value="<?php if(isset($_SESSION['umail'])){echo $_SESSION['umail'];}?>" required>
                                    <div class="invalid-feedback">
                                    Please enter your email address
                                    </div>
                                </div>
                                <span class="text-danger">
                                    <?php 
                                    if(isset($error['email'])){
                                        echo $error['email'];
                                    } ?>
                                </span>
                            </div>
                        </div> <!-- end form row -->
                        
                        <div class="form-row">
                            
                            <div class="col-md-3 mb-3">
                                <label for="sandyZip">Zip</label>
                                <input type="text" name="sandyZip" class="form-control" id="sandyZip" placeholder="Zip" value="<?php if(isset($_SESSION['uzip'])){echo $_SESSION['uzip'];}?>" required>
                                <div class="invalid-feedback">
                                Please provide a valid zip.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="sandyCity">City</label>
                                <input type="text" name="sandyCity" class="form-control" id="sandyCity" placeholder="City" value="<?php if(isset($_SESSION['ucity'])){echo $_SESSION['ucity'];}?>" required>
                                <div class="invalid-feedback">
                                Please provide a valid city.
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="sandyState">State</label>
                                <input type="text" name="sandyState" class="form-control" id="sandyState" placeholder="State" value="<?php if(isset($_SESSION['ustate'])){echo $_SESSION['ustate'];}?>" required>
                                <div class="invalid-feedback">
                                Please provide a valid state
                                </div>
                            </div>
                        </div> <!-- end form row -->
                        
                        <div class="form-row">
                            
                            <div class="col-md-8 mb-3">
                                <label for="sandyAddress">Street Address</label>
                                <input type="text" name="sandyAddress" class="form-control" id="sandyAddress" placeholder="Address" value="<?php if(isset($_SESSION['ustreet'])){echo $_SESSION['ustreet'];}?>" required>
                                <div class="invalid-feedback">
                                Please provide a valid street address
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="sandyPhone">Phone</label>
                                <input type="tel" name="sandyPhone" class="form-control" id="sandyPhone" maxlength="14" placeholder="(XXX) XXX-XXXX" value="<?php if(isset($_SESSION['uphone'])){echo $_SESSION['uphone'];}?>" required>
                                <div class="invalid-feedback">
                                Please provide a valid phone number
                                </div>
                            </div>
                        </div> <!-- end form row -->
                        
                        <div class="form-row">
                            
                            <div class="col-md-6 mb-3">
                                <label for="sandyPass1">Password</label>
                                <input type="password" name="sandyPass1" class="form-control" id="sandyPass1" placeholder="Password" required>
                                <div class="invalid-feedback">
                                Please enter a password
                                </div>
                            </div>
                            <span class="text-danger">
                                <?php 
                                if(isset($error['password'])){
                                    echo $error['password'];
                                } ?>
                            </span>
                            
                            <div class="col-md-6 mb-3">
                                <label for="sandyPass2">Repeat Password</label>
                                <input type="password" name="sandyPass2" class="form-control" id="sandyPass2" placeholder="Password" required>
                                <div class="invalid-feedback">
                                Please enter the password again
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
                        <button class="btn btn-primary" name="sandySubmit" type="submit">Register</button>
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
<?php
}
?>  
<?php include "views/footer.php" ?>