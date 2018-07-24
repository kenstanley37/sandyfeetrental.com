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

 
<div class="container main-car">
    <div class="row">
        <div class="col-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="admin/uploads/110T/1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="admin/uploads/110T/2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="admin/uploads/110T/3.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="bootstrap-iso reservation">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- Form code begins -->
                        <form method="post">
                            <div class="form-group"> <!-- Date input -->
                                <label class="control-label" for="arriveDate">Arrival Date</label>
                                <input class="form-control" id="arriveDate" name="arriveDate" placeholder="MM/DD/YYY" type="text"/>
                                <label class="control-label" for="departDate">Departure Date</label>
                                <input class="form-control" id="departDate" name="departDate" placeholder="MM/DD/YYY" type="text"/>
                            </div>
                            <div class="form-group"> <!-- Submit button -->
                                <button class="btn btn-primary " name="submit" type="submit">Search Available Rooms</button>
                            </div>
                        </form>
                        <!-- Form code ends --> 

                    </div>
                </div>    
            </div>
        </div>
    </div>

</div>


















</body>

<?php include "views/footer.php" ?>