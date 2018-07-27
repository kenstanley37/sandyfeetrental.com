$(document).ready(function(){
    $.ajaxSetup({ cache: false });  // Prevent browser from caching the page. This is !important

    
    
    //nav bar class change based on scroll. 
    $(window).scroll(function(e) {
        var scrollPos = $(window).scrollTop();
        //console.log(scrollPos);
        if(scrollPos <= 0){
            $(".sandyBar").removeClass('navbarScrollDown');
            $(".sandyBar").addClass('navbarScrollUp');
            $("#sandyLogo").addClass('sandyLogoUp');
            $("#sandyLogo").removeClass('sandyLogoDown');
            //alert('')
        } else {
            $(".sandyBar").removeClass('navbarScrollUp');
            $(".sandyBar").addClass('navbarScrollDown'); 
            $("#sandyLogo").removeClass('sandyLogoUp');
            $("#sandyLogo").addClass('sandyLogoDown');
        }
    });
    
    datePicker();
    register();
    mainNavButtonCheck();
    buttonClicks();
    //reportFromBtnHandler();
});

function mainNavButtonCheck(){
    var temp1 = location.pathname;
    var temp2 = temp1.lastIndexOf('/') +1;
    var temp3 = temp1.substr(temp2);
    var filename = temp3.substring(0, temp3.indexOf('.'));
    
    //alert(filename);
    $('#'+filename).addClass('active');

}

function datePicker(){
    //alert('test');
    $('#arriveDate').datepicker();
    $('#departDate').datepicker();
}



function buttonClicks(){
    $('#reset-db').click(function(e){
        e.preventDefault();
        resetall();
    });
}

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}

function register(){
    $('#register').click(function(){
       window.location.href = "sign-up.php"; 
    });
}

