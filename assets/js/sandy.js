$(document).ready(function(){
    $.ajaxSetup({ cache: false });  // Prevent browser from caching the page. This is !important
    register();
    
    avg_rate_graph();
});

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}

function register(){
    $('#register').click(function(){
       window.location.href = "sign-up.php"; 
    });
}

function avg_rate_graph(){
    $.ajax({
        url:'/sandyfeetrental.com/inc/ajax.php',
        method: "GET",
        success:function(response){
            console.log(response);
            var label = [];
            var donne = [];
            for(var i = 0; i<response.length;i++){
                label.push(response[i].Prop_Type);
                donne.push(response[i].Avg_Prop_Rate);
            }
            
            var avg = $('#avg_rate_pie');
            var graph = new Chart(avg,{
                type:'pie',
                label:'test',
                data:{
                    labels:label,
                    datasets:[{
                        label:"Ken is awesome",
                        data:donne,
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',
                            'rgba(255, 206, 86)',
                            'rgba(75, 192, 192)',
                            'rgba(153, 102, 255)',
                            'rgba(255, 159, 64)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    countPercentage: 0,
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontColor: 'rgb(0, 0, 0)'
                        }
                    }
                }
                
            });
        },
        
        error:function(response){
            console.log(response);
        }
        
       });

} //end avg_rate_graph