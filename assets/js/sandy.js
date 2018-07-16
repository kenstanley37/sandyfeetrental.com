$(document).ready(function(){
    $.ajaxSetup({ cache: false });  // Prevent browser from caching the page. This is !important
    register();
});

function register(){
    $('#register').click(function(){
       window.location.href = "sign-up.php"; 
    });
}
