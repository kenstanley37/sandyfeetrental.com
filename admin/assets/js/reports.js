$(document).ready(function(){
    reportFromBtnHandler();
    reportSetup();
    load_image_data();
    $('#reportTable').DataTable();
});

function reportSetup() {
    if($('#avg_report_area').length){
        //$('#myTable').append('<p>I rock</p>');
        avg_rate_graph();
    }
    
    if($('#norent_report_area').length){
        //$('#myTable').append('<p>I rock</p>');
        get_no_rent();
    }
    
    if($('#freq_report_area').length){
        //$('#myTable').append('<p>I rock</p>');
        //get_freq_renters();
        get_freq_rentersC3();
    }
}

function load_image_data() {
    $('select[name="property"]').change(function(){
        alert('test');
        var prop_id = $(this).val();
          $.ajax({
           url:"/inc/ajax.php",
           method:"POST",
           data: 'img_fetch,'+prop_id,    
           success:function(data)
           {
            $('#image_table').html(data);
           },
           error:function(data){
               $('#image_table').html(data);
               console.log(data);
           }
          });
    });

 } //end load_image_data

function reportFromBtnHandler(){
    $('#idTheID').hide();
    var myID = $('#idTheID').text();
    //alert(myID);
    //var myBtn = $('#btns-report-group button');
    $("#"+myID).attr('class','active');
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
                        backgroundColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
                        borderColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
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
                        backgroundColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
                        borderColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
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

function get_freq_renters(e){
    var canvas = $('#myChart');
    canvas.empty();
    $.ajax({
        url:'/inc/ajax.php',
        method: "POST",
        data: 'btn-freq',
        success:function(response){
            console.log(response);
            var label = [];
            var data = [];
            for(var i = 0; i < response.length;i++){
                label.push(response[i].Name);
                data.push(response[i].Times_Rented);
            }
             
   
            var graph = new Chart(canvas,{
                type:'pie',
                label:'Freq',
                data:{
                    labels:label,
                    datasets:[{
                        label:"Freq",
                        data:data,
                        backgroundColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
                        borderColor: palette('rainbow', data.length).map(function(hex) {
                            return '#' + hex;
                          }),
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

function get_freq_rentersC3(e){
    var canvas = $('#myChart');
    canvas.empty();
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pie_chart);
    
    function pie_chart(){
        $.ajax({
        url:'/inc/ajax.php',
        method: "POST",
        data: 'btn-freq',
        success:function(response){
            var data = new google.visualization.DataTable(response);
            $('#freq_report_area button').click(function(){
                var myButton = $(this).text();
                // Instantiate and draw our chart, passing in some options.
            if(myButton === 'Pie'){
                $('#myChart').empty();
                var chart = new google.visualization.PieChart(document.getElementById('myChart'));
            } else if(myButton === 'Column'){
                $('#myChart').empty();
                var chart = new google.visualization.ColumnChart(document.getElementById('myChart'));
            } else if(myButton === 'Bar'){
                $('#myChart').empty();
                var chart = new google.visualization.BarChart(document.getElementById('myChart'));
            }
            
            chart.draw(data);
            });
            

            

        },
        
        error:function(response){
            console.log(response);
        }
        
       });
    }
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