<?php
session_start();
require_once('inc/class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
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
		
	if($user->doLogin($umail,$upass))
	{
		$user->redirect('home.php');
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
?>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Sign up.</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
                <input type="text" class="form-control" id="txt_ufname" name="txt_ufname" placeholder="Enter First Name" value="<?php if(isset($error)){echo $ufname;}?>" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_ulname" placeholder="Enter Last Name" value="<?php if(isset($error)){echo $ulname;}?>" />
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="txt_ustreet" placeholder="Street Address" value="<?php if(isset($error)){echo $ustreet;}?>" />
            </div>
            <div class="form-group">
                <input type="text" pattern=".{2,}" class="form-control" name="txt_ustate" placeholder="2 Letter State" value="<?php if(isset($error)){echo $ustate;}?>" />
            </div>
            <div class="form-group">
                <input type="text" pattern="[0-9]{5}" class="form-control" name="txt_uzip" placeholder="5 Digit Zip Code" value="<?php if(isset($error)){echo $uzip;}?>" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_uphone" placeholder="Phone" value="<?php if(isset($error)){echo $uphone;}?>" />
            </div>
            <div class="form-group">
             <input type="email" class="form-control" id="txt_umail" name="txt_umail" placeholder="E-Mail Address" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>Have an account? <a href="index.php">Sign In</a></label>
        </form>
       </div>
</div>

<?php include "views/footer.php" ?>