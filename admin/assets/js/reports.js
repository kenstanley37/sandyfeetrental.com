$(document).ready(function(){
    load_image_data();
    $('#reportTable').DataTable();
});


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