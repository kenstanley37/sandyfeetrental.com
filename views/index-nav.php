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
<nav class="container-fluid sandyBar fixed-top navbarScrollUp" role="navigation">
    <div class="container sandyNav">
        <div class="row sandyNav">
            <div class="col">
                <div class="row hideMe">
                    <div class="col-1">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="col-1">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="col-1">
                        <i class="fab fa-youtube-square"></i>
                    </div>
                </div>
                <div class="row h-100 sandyNav links">
                    <div class="col">
                         <ul class="nav navbar-nav flex-row justify-content-start ml-auto">
                            <?php if($rank === "admin" or $rank === "super_admin" ){
                                ?>
                                <li class="nav-item"><button id="reports" class="btn btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="location.href = '<?php echo ROOT_URL ?>/admin/reports.php';">Reports</button></li>

                                <li class="nav-item"><button id="photo" class="btn btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="location.href = '<?php echo ROOT_URL ?>/admin/photo.php';">Pictures</button></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col text-center sandyLogo">
                <!-- <img src="../assets/images/SandyLogo.png" alt="Sandy Feet Logo"> -->
            </div>
            <div class="col">
                <div class="row hideMe">
                    <div class="col text-right">
                        <span class="oi oi-phone align-middle"> (828) 867-5309</span>
                    </div>
                </div>
                <div class="row h-100 links text-right">
                    <div class="col">
                        <ul class="nav navbar-nav flex-row justify-content-end ml-auto">
                            <?php 
                                if(isset($ufname)){

                                }else{
                                    ?>

                                        <li class="nav-item order-2 order-md-1"><a href="profile.php" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>
                                        <li class="order-1">
                                            <button type="button" id="register" href="sign-up.php" class="btn">Register<span class="caret"></span></button>
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
                                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn dropdown-toggle">Welcome <?php print($ufname); ?> <span class="caret"></span></button>
                                                  <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo ROOT_URL ?>/profile.php">Profile</a>
                                                    <a class="dropdown-item" href="<?php echo ROOT_URL ?>/logout.php?logout=true">Logout</a>
                                                  </div>
                                            </li>
                                        <?php
                                    }else {
                                        ?>
                                            <li class="dropdown order-1">
                                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn dropdown-toggle">Login <span class="caret"></span></button>
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

                                                                <div class="form-group login">
                                                                    <div class="row">
                                                                        <div class="col-xs-7">
                                                                            <input type="checkbox" tabindex="3" name="remember" id="remember">
                                                                            <label for="remember"> Remember Me</label>
                                                                        </div>
                                                                        <div class="col-xs-5">
                                                                         <button type="submit" name="btn-login" class="btn">
                                                                            <span class="oi oi-account-login"></span> &nbsp; SIGN IN
                                                                        </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                    </div>
                                                                </div>

                                                                <div class="form-group login">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="text-center">
                                                                                <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <label class="login">Don't have account yet? <a href="<?php echo ROOT_URL ?>/sign-up.php">Sign Up</a></label>
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
            </div>
        </div>
    </div>
</nav>




