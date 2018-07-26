<?php 
    $rank = '';
    
    if($page_name === "index.php"){
        $ufname = $login->fname(); 
    }else if($page_name === "sign-up.php"){
        $ufname = $user->fname(); 
    }else{
        $ufname = $login->fname(); 
    }

    if(isset($_SESSION['user_rank'])){
        $rank = $_SESSION['user_rank'];
    } 

?>
<body>
<!--
<header class="container-fluid sticky-top sandy">
        <div class="row">
            <div class="col-0 col-sm-0 col-md-0 col-lg-2 col-xl-7"></div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-5 userinfobk">
                <h2>Sandy Feet Rental Company</h2>
            </div>
        </div>
</header>
-->

<!-- 
navbar bootstrap options-
fixed-top 

-->


<nav class="navbar fixed-top navbarScrollUp navbar-expand-lg navbar-dark index-nav" role="navigation" >
    <div class="container">
        <a class="navbar-brand" href="/index.php">SandyFeetRental</a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <div class="collapse navbar-collapse" id="exCollapsingNavbar">
            <ul class="nav navbar-nav">
                <!--
                <li class="nav-item"><button class="btn btn-sm btn-success" data-toggle="button" aria-pressed="false" autocomplete="off">About</button></li>
                <li class="nav-item"><button class="btn btn-sm btn-success" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="location.href = '#';">Browse</button></li>
                -->
                <?php if($rank === "admin" or $rank === "super_admin" ){
                    ?>
                    <li class="nav-item"><button id="reports" class="btn btn-sm btn-outline-warning" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="location.href = '<?php echo ROOT_URL ?>/admin/reports.php';">Reports</button></li>
                
                    <li class="nav-item"><button id="photo" class="btn btn-sm btn-outline-warning" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="location.href = '<?php echo ROOT_URL ?>/admin/photo.php';">Pictures</button></li>
                    
                    <!--
                    <li class="nav-item"><a href="<?php echo ROOT_URL ?>/admin/reports.php" class="nav-link">Reports</a></li>
                    <li class="nav-item"><a href="<?php echo ROOT_URL ?>/admin/photo.php" class="nav-link">Property Pictures</a></li>
                    -->
                <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <?php 
                if(isset($ufname)){
                    
                }else{
                    ?>
                        
                        <li class="nav-item order-2 order-md-1"><a href="profile.php" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>
                        <li class="order-1">
                            <button type="button" id="register" href="sign-up.php" class="btn btn-outline-warning">Register<span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right mt-2">
                               <li class="px-3 py-2">
                                </li>
                            </ul>
                        </li>
                    <?php
                }
            
            ?>

                
                <?php 
                    if(isset($ufname)){
                        ?>
                            <li class="nav-item dropdown order-1">
                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-info dropdown-toggle">Welcome <?php print($ufname); ?> <span class="caret"></span></button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo ROOT_URL ?>/profile.php">Profile</a>
                                    <a class="dropdown-item" href="<?php echo ROOT_URL ?>/logout.php?logout=true">Logout</a>
                                  </div>
                            </li>
                        <?php
                    }else {
                        ?>
                            <li class="dropdown order-1">
                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-warning dropdown-toggle">Login <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right mt-2">
                                   <li class="px-3 py-2">
                                       <form class="form-signin" method="post" id="login-form">
                                                <div id="error">
                                                <?php
                                                    if(isset($error))
                                                    {
                                                        ?>
                                                        <div class="alert alert-danger">
                                                           <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                                </div>

                                                <div class="form-group">
                                                <input type="text" class="form-control" name="txt_email" placeholder="E mail Address" required>
                                                <span id="check-e"></span>
                                                </div>

                                                <div class="form-group">
                                                <input type="password" class="form-control" name="txt_password" placeholder="Your Password">
                                                </div>

                                                <hr>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-7">
                                                            <input type="checkbox" tabindex="3" name="remember" id="remember">
                                                            <label for="remember"> Remember Me</label>
                                                        </div>
                                                        <div class="col-xs-5">
                                                         <button type="submit" name="btn-login" class="btn btn-default">
                                                            <img src="<?php echo ROOT_URL ?>/assets/open-iconic/svg/account-login.svg" alt="account login"> &nbsp; SIGN IN
                                                        </button>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="text-center">
                                                                <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <label>Don't have account yet? <a href="<?php echo ROOT_URL ?>/sign-up.php">Sign Up</a></label>
                                          </form>
                                    </li>
                                </ul>
                            </li> <!-- end Login Button -->
                
                        <?php
                    }
                
                
                
                
                ?>
                
            </ul>
        </div>
    </div>
</nav>

<div id="modalPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Forgot password</h3>
                <button type="button" class="close font-weight-light" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Reset your password..</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


