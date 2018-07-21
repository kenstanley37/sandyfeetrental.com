$(document).ready(function(){
    $.ajaxSetup({ cache: false });  // Prevent browser from caching the page. This is !important
    register();

    if($('#avg_report_area').length){
        //$('#myTable').append('<p>I rock</p>');
        avg_rate_graph();
    }
    
    if($('#norent_report_area').length){
        //$('#myTable').append('<p>I rock</p>');
        get_no_rent();
    }
    
    buttonClicks();
    reportFromBtnHandler();
});


function reportFromBtnHandler(){
    $('#idTheID').hide();
    var myID = $('#idTheID').text();
    //alert(myID);
    //var myBtn = $('#btns-report-group button');
    $("#"+myID).attr('class','active');
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

function avg_rate_graph(e){
    var canvas = $('#myChart');
    canvas.empty();
    $.ajax({
        url:'/inc/ajax.php',
        method: "POST",
        data: 'btn-avg',
        success:function(response){
            console.log(response);
            var label = [];
            var data = [];
            for(var i = 0; i < response.length;i++){
                label.push(response[i].Prop_Type);
                data.push(response[i].Avg_Prop_Rate);
            }
             
             var graph = new Chart(canvas,{
                type:'pie',
                data:{
                    labels:label,
                    datasets:[{
                        label:"State",
                        data:data,
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
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontColor: 'rgb(0, 0, 0)'
                        }
                    },
                    tooltips: {
                        callbacks: {
                          label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                            var total = meta.total;
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = parseFloat((currentValue/total*100).toFixed(1));
                            return currentValue + ' (' + percentage + '%)';
                          },
                          title: function(tooltipItem, data) {
                            return data.labels[tooltipItem[0].index];
                          }
                        }
                      },
                    title: {
                        display: true,
                        //text: 'Per State',
                        fontColor: 'rgb(0, 0, 0)'
                        
                    }
                }

            }); //end graph
        },
        
        error:function(response){
            console.log(response);
        }
        
       });
} //end avg_rate_graph

function get_no_rent(e){
    var canvas = $('#myChart');
    canvas.empty();
    $.ajax({
        url:'/inc/ajax.php',
        method: "POST",
        data: 'btn-norent',
        success:function(response){
            console.log(response);
            var label = [];
            var data = [];
            for(var i = 0; i < response.length;i++){
                label.push(response[i].State);
                data.push(response[i].count);
            }
             
   
            var graph = new Chart(canvas,{
                type:'pie',
                label:'State',
                data:{
                    labels:label,
                    datasets:[{
                        label:"State",
                        data:data,
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
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            fontColor: 'rgb(0, 0, 0)'
                        }
                    },
                    tooltips: {
                        callbacks: {
                          label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                            var total = meta.total;
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = parseFloat((currentValue/total*100).toFixed(1));
                            return currentValue + ' (' + percentage + '%)';
                          },
                          title: function(tooltipItem, data) {
                            return data.labels[tooltipItem[0].index];
                          }
                        }
                      },
                    title: {
                        display: true,
                        text: 'Per State',
                        fontColor: 'rgb(0, 0, 0)'
                        
                    }
                }

            }); //end graph
        },
        
        error:function(response){
            console.log(response);
        }
        
       });
} //end avg_rate_graph


function resetall(){
    var canvas = $('#myChart');
    canvas.empty();
    //alert('im working');
    $.ajax({
        type: 'post',
        url: '/inc/reset-db.php',
        data: 'resetall',
        beforeSend:function(){
         return confirm("Are you sure you want to reset the database?");
        },
        success: function (response) {
        // We get the element having id of display_info and put the response inside it
        $('#resetDB').html(response);
        console.log(response);   
        },
        error:function(response){
            console.log(response);
        }
    }); //end first AJAX
}