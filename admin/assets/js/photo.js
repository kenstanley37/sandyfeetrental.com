$(document).ready(function(){
    pop_dropdown();
    img_upload();
});

function pop_dropdown(){
    $.ajax({
        url:"/inc/ajax.php",
        method:"POST",
        data: 'get_build_list',    
        success:function(data){
        $('#building_list').append('<option value=""></option>');    
        $('#building_list').append(data);
        $('select[name="building"]').change(function(){
            // if #building_list value is empty
            if ($(this).children(":selected").val() === "" ){
                $('#property_list :nth-child(1)').prop('selected', true);
                $('#reportTable').empty();
                $('#property_list').attr("disabled", true);
            } else {
                $('#property_list').attr("disabled", false);
                build_id = $(this).children(":selected").val();
                 $.ajax({
                    url:"/inc/ajax.php",
                    method:"POST",
                    data: 'get_prop_list='+build_id,    
                    success:function(data){
                    $('#property_list').empty();
                    $('#property_list').append('<option value=""></option>');
                    $('#property_list').append(data);
                    $('#property_list').change(function(){
                        //alert('test');
                        var prop_id = $(this).val();
                        if(prop_id === ''){
                            $('#reportTable').empty();
                        } else {
                            img_fetch(prop_id);
                        }
                    });
                    },
                    error:function(data){
                    $('#dropdown').html(data);
                    }
                });
            }
        });
        },
        error:function(data){
        $('#dropdown').html(data);
        console.log(data);
        }
    });
}//end pop_dropdown


function img_fetch(data){
    $.ajax({
        url:"/inc/ajax.php",
        method:"POST",
        data: {'img_fetch' : data},    
        success:function(data)
        {
            $('#reportTable').empty();
            $('#reportTable').append(data);
        },
        error:function(data){
            $('#reportTable').append(data);
        }
    }); 
}

function img_upload(){
    // Get the current value of the property select box.
    $('#property_list').change(function(){
        prop_num = $(this).val();
    });
    
    // http://malsup.com/jquery/form/#ajaxForm
    $('#uploadForm').ajaxForm({
        target:'#imagesPreview',
        beforeSubmit:function(){
            $('#uploadStatus').html('<img src="assets/images/uploading.gif"/>');
        },
        success:function(){
            img_fetch(prop_num);
            $('#uploadStatus').html('');
        },
        error:function(){
            $('#uploadStatus').html('Images upload failed, please try again.');
        }
    });
    
} //end img_upload


 $(document).on('click', '.edit', function(){
  var image_id = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"post",
   data:{image_id:image_id},
   dataType:"json",
   success:function(data)
   {
    $('#imageModal').modal('show');
    $('#image_id').val(image_id);
    $('#image_name').val(data.image_name);
    $('#image_description').val(data.image_description);
   }
  });
 }); 
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var image_name = $(this).data("image_name");
  if(confirm("Are you sure you want to remove it?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{image_id:image_id, image_name:image_name},
    success:function(data)
    {
     load_image_data();
     alert("Image removed");
    }
   });
  }
 }); 
 $('#edit_image_form').on('submit', function(event){
  event.preventDefault();
  if($('#image_name').val() == '')
  {
   alert("Enter Image Name");
  }
  else
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:$('#edit_image_form').serialize(),
    success:function(data)
    {
     $('#imageModal').modal('hide');
     load_image_data();
     alert('Image Details updated');
    }
   });
  }
 }); 