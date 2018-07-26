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
?> 

</head> 

<?php
include "views/index-nav.php"; 
//echo ROOT_DIR;
?>
<body>

 
      <!--
    ####################################################
    C A R O U S E L
    ####################################################
    -->
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <a href="#">
                    <!-- 
                    If you need more browser support use https://scottjehl.github.io/picturefill/
                    If a picture looks blurry on a retina device you can add a high resolution like this
                    <source srcset="img/blog-post-1000x600-2.jpg, blog-post-1000x600-2@2x.jpg 2x" media="(min-width: 768px)">

                    What image sizes should you use? This can help - https://codepen.io/JacobLett/pen/NjramL
                     -->
                     <picture>
                      <source srcset="/assets/images/slide-1.jpg">
                      <img srcset="/assets/images/slide-1.jpg" alt="responsive image" class="d-block img-fluid">
                    </picture>

                    <div class="carousel-caption justify-content-center align-items-center text-white">
                        <div class="car-cap-bg">
                            <h2>DBA-120 Project</h2>
                            <p>This is not a real website or company</p>
                            <p>This is a student project</p>
                            <span class="btn btn-sm btn-outline-secondary">Learn More</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.carousel-item -->
            <div class="carousel-item">
                <a href="#">
                     <picture>
                        <source srcset="/assets/images/slide-2.jpg">
                        <img srcset="/assets/images/slide-2.jpg" alt="responsive image" class="d-block img-fluid">
                    </picture>

                    <div class="carousel-caption justify-content-center align-items-center text-white">
                        <div class="car-cap-bg">
                            <h2>DBA-120 Project</h2>
                            <p>This is not a real website or company</p>
                            <p>This is a student project</p>
                            <span class="btn btn-sm btn-outline-secondary">Learn More</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.carousel-item -->
            <div class="carousel-item">
                <a href="#">
                     <picture>
                        <source srcset="/assets/images/slide-3.jpg">
                        <img srcset="/assets/images/slide-3.jpg" alt="responsive image" class="d-block img-fluid">
                    </picture>

                    <div class="carousel-caption justify-content-center align-items-center text-white">
                        <div class="car-cap-bg">
                            <h2>DBA-120 Project</h2>
                            <p>This is not a real website or company</p>
                            <p>This is a student project</p>
                            <span class="btn btn-sm btn-outline-secondary">Learn More</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.carousel-item -->
        </div>
        <!-- /.carousel-inner -->
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- /.carousel -->


<div class="container-fluid text-center">
    <p>Full width carousel with a maximum height and art direction. Resize window to see image change based on the size of the window.</p>
</div>
<!-- /.container -->
    

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit interdum volutpat. Etiam imperdiet scelerisque purus sed euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed blandit vitae lorem et auctor. Praesent vulputate, velit sed tincidunt auctor, ipsum magna fermentum purus, non vehicula sem leo a risus. Praesent gravida ligula sed lorem consectetur bibendum. Suspendisse bibendum hendrerit lacus vitae aliquet. In accumsan tempus est, a tempus risus euismod eu. Cras at nulla porttitor, finibus quam vitae, lacinia magna. Sed hendrerit, lacus eget gravida fringilla, augue lacus efficitur diam, eu commodo orci lectus ut ligula. Aenean eu elit non ante iaculis pellentesque. Donec congue quis sem eu hendrerit. Nulla facilisi.</p>

    <p>Donec lobortis elit eros, vel pellentesque est dignissim sodales. Integer id pharetra nisl, in tristique purus. Suspendisse consectetur pellentesque est nec pellentesque. Sed ex dolor, sodales at neque a, posuere sodales enim. Etiam auctor pretium mauris, non faucibus nulla pellentesque eget. Phasellus nec blandit augue. Curabitur consequat, ligula vel dictum euismod, turpis turpis ornare mi, nec tempor nibh nunc et quam. Morbi in vestibulum libero. Fusce scelerisque at metus sed ultrices. Integer rhoncus nisi purus, et tempor lorem elementum dictum. Vivamus feugiat diam et felis blandit tincidunt. Vestibulum nec nisl dolor.</p>

    <p>Cras pretium diam a lorem pellentesque, vel tempus libero fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed orci odio, feugiat et commodo at, iaculis at leo. Duis posuere ipsum at aliquam efficitur. Sed non euismod eros, eu sagittis tortor. Curabitur egestas neque nisi, at pretium erat faucibus eu. Morbi non est ut lectus iaculis volutpat. Donec ac nibh a odio hendrerit sagittis ac eget eros.</p>

    <p>Maecenas sem felis, bibendum a metus vel, rutrum lobortis turpis. Curabitur sollicitudin nibh quam, quis ullamcorper est feugiat eu. Aliquam aliquam orci metus, at egestas lorem commodo et. Nullam at risus enim. Curabitur dictum luctus posuere. Nunc faucibus sagittis leo a dapibus. Pellentesque sed dapibus mi. Fusce maximus varius purus vel pretium. Vestibulum sollicitudin neque lectus, eu vestibulum felis pulvinar vitae. Fusce nibh mi, malesuada sed velit sed, sagittis posuere eros. Nullam sit amet augue ultricies, ultricies est vel, placerat nulla. Donec posuere ut tellus ac blandit. Pellentesque nec augue dignissim est interdum tempor at et purus. Donec ac volutpat mauris. Donec interdum semper tellus, a dictum enim hendrerit eget.</p>

    <p>Ut cursus imperdiet massa, in pulvinar lorem sagittis vitae. Sed et massa mattis, iaculis nibh vitae, pharetra ipsum. In volutpat dolor sem, in dapibus odio mattis eget. Vestibulum sit amet orci nulla. Mauris luctus augue iaculis ullamcorper iaculis. Maecenas ac nisl quis dolor tincidunt scelerisque. Mauris tristique egestas fringilla. Donec gravida, sapien nec fermentum cursus, risus felis ullamcorper est, porttitor commodo sapien metus eu eros. Praesent et sagittis orci, non ultricies felis. Vivamus non finibus purus, quis suscipit ante. Duis sed pretium magna. Donec eleifend suscipit mattis. Donec eu condimentum tellus. Sed ut vulputate nisl. In mattis, purus non varius varius, dolor dui interdum nisi, aliquam rhoncus quam nunc eget erat.</p>

    <p>Curabitur a pharetra mauris. Maecenas sit amet quam sollicitudin, pellentesque quam ac, lacinia odio. Vestibulum congue eu ex in condimentum. Aliquam neque ante, commodo ut mauris eu, suscipit hendrerit diam. Vestibulum auctor aliquet eros, blandit aliquam lectus tempor ac. Phasellus viverra sapien turpis, aliquet auctor nisi lacinia non. In hac habitasse platea dictumst.</p>

    <p>Aliquam viverra venenatis lorem sit amet semper. Ut tortor metus, ullamcorper sed metus id, interdum consectetur elit. Nunc sed luctus libero. Mauris vitae mi ut justo gravida convallis ut at sem. Vestibulum blandit sollicitudin dapibus. Quisque nec nunc eu nibh hendrerit auctor id eu elit. Vivamus et tortor quis nibh vestibulum scelerisque. Etiam sit amet ipsum nec dui iaculis consequat eu id est. Aenean viverra, turpis sed tincidunt tristique, arcu nibh facilisis risus, vel egestas nisi justo eget elit. Phasellus vestibulum mauris a urna facilisis vehicula vitae non neque. Mauris lobortis sed nisl sit amet bibendum. Maecenas eleifend tempus ipsum, non eleifend purus commodo non. Suspendisse aliquet sapien non tortor tempus pretium. Sed venenatis et libero vitae venenatis.</p>

    <p>Pellentesque sed risus quis mi fermentum venenatis tincidunt consequat augue. Vivamus pulvinar egestas lacus sed interdum. Nullam blandit nisl sit amet tellus iaculis dignissim. Fusce tincidunt neque nisi, vel ultricies lectus placerat non. Praesent lacinia risus nec mi aliquam, sit amet feugiat nibh interdum. Phasellus accumsan orci at est luctus mollis. Cras pellentesque a purus nec pretium. Ut condimentum nibh quis libero mollis pulvinar. Vestibulum non auctor diam. Etiam nec urna massa. Pellentesque a mollis ipsum. Curabitur consequat sapien ultricies consectetur gravida.</p>

    <p>Sed varius rutrum magna sit amet maximus. Aliquam vel justo auctor, blandit risus at, placerat ipsum. Suspendisse pulvinar ligula nisl, sed hendrerit sem ornare nec. Nunc ultrices aliquam lacus, sit amet tempus nisl pulvinar nec. Phasellus fermentum eu massa ut sagittis. Mauris sodales augue mattis bibendum venenatis. Maecenas non commodo magna, a luctus lectus.</p>

    <p>Suspendisse quis faucibus odio. Pellentesque accumsan posuere diam non dapibus. Nulla eget sagittis ex, at viverra ligula. Mauris feugiat gravida finibus. Aliquam ullamcorper neque ut molestie finibus. Fusce ultrices risus quis interdum pretium. Curabitur sed ultrices ligula, et finibus massa.</p>
    
    
    
    
    
    
    
    
    

</body>

<?php include "views/footer.php" ?>