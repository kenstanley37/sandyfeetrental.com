<?php
    session_start();
    include("../init.php");
    require_once(ROOT_DIR."/inc/class.user.php");
    require_once(ROOT_DIR."/inc/class.prop.php");
    $login = new USER();
    $prop = new PROP();
    
    $myID = '';

    if($login->is_loggedin()!="")
    {
        //$login->redirect('home.php');
        $rank = $login->check_rank();

    }

    include $path."/views/header.php"; 
    include $path."/views/index-nav.php"; 
    //echo ROOT_URL;
    //echo ROOT_DIR;
    ?>

            <div class="container" id="admin">
                <div class="row admin-nav">
                    <div class="col-12"><?php include $path."/views/admin/admin-nav.php"; ?></div>
                </div>
                <div class="row">
                    <div class="col" id="resetDB"></div>
                </div>
                
    

    <?php
        if(isset($_POST["btn-avg"])){
            $myID = "btn-avg";
            ?>
                <div class="row" id="avg_report_area">
                    <div class="col-12">
                        <div class="row" id="report_area">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h1>Average Rate</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" id="myTable">
                                        <?php print $prop->avg_rate(); ?>
                                    </div>
                                    <div class="col-6" id="avg_rate">
                                        <!--
                                        Use for Google Charts
                                        <div id="myChart"></div>
                                        -->
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End container -->
        <?php
        }
            if(isset($_POST["btn-norent"])){
                $myID = "btn-norent";
        ?>
                <div class="row" id="norent_report_area">
                    <div class="col-12">
                        <div class="row" id="report_area">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h1>Customers who have not rented</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="myTable">
                                        <?php print $prop->no_rent(); ?>
                                    </div>
                                </div>
                                <div class="row" id="norent_pie">
                                    <div class="col-6">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End container -->
        <?php
        }
            if(isset($_POST["btn-freq"])){
                $myID = "btn-freq";
        ?>

            <div class="row" id="freq_report_area">
                    <div class="col-12">
                        <div class="row" id="report_area">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h1>Customers who have not rented</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" id="myTable">
                                        <?php print $prop->freq_renters(); ?>
                                    </div>
                                    <div class="col-6" id="freq_pie">
                                        <!--
                                        Use for Google Charts
                                        <div id="myChart"></div>
                                        -->
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End container -->
        <?php
        }
        ?>
    
    

    <?php


    include $path."/views/footer.php"; 
    ?>
    <div id="idTheID"><?php echo $myID; ?></div>
    <?php
?>