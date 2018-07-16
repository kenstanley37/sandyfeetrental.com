<?php

	require_once("session.php");
	
	require_once("inc/class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    $fname = $userRow['user_fName'];

?>
<?php 
    include "views/header.php"; 
    include "views/index-nav.php"; 
    $user_type = $userRow['user_type'];

 //   if($user_type === "renter"){
 //       include "views/renter-nav.php";
 //   } else if ($user_type === "owner"){
 //       include "views/owner-nav.php";
 //   } else if ($user_type === "admin"){
 //       include "views/admin/admin-nav.php";
 //   } 
    //echo $user_type;
?>

    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">Welcome : <?php print($fname); ?></label>
        <hr />
        
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
       	<hr />
        
        <p class="h4">User Home Page</p> 
       
        
<?php include "views/footer.php" ?>