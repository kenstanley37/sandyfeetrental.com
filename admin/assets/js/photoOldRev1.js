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
                    $('select[name="property"]').change(function(){
                        //alert('test');
                        var prop_id = $(this).val();
                        if(prop_id === ''){
                            $('#reportTable').empty();
                        } else {
                             $.ajax({
                                   url:"/inc/ajax.php",
                                   method:"POST",
                                   data: {'img_fetch' : prop_id},    
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

function img_upload(){
    $('#multiple_files').change(function(){
        var files = $('#multiple_files').prop('files');
        //var files = $(this).prop('files');
        for (var i = 0; i < files.length; i++) {
            $('#image_table').append(files[i].name);
        }
        var prop_id = $( "#property_list option:selected" ).text();
        var error_images = '';
        var form_data = new FormData();
        var files = $('#multiple_files')[0].files;
        //files[].append("prop_id:"+'"'+prop_id+'"');
        if(files.length > 10){
            error_images += 'You can not select more than 10 files';
        }
        else {
            for(var i=0; i<files.length; i++){
                    var prop_id = $( "#property_list option:selected" ).text();
                    var name = document.getElementById("multiple_files").files[i].name;
                    var ext = name.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                    error_images += '<p>Invalid '+i+' File</p>';
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
                    var f = document.getElementById("multiple_files").files[i];
                    var fsize = f.size||f.fileSize;
                if(fsize > 2000000){
                    error_images += '<p>' + i + ' File Size is very big</p>';
                }
                else {
                    form_data.append("file[]", document.getElementById('multiple_files').files[i], 'dude');
                    //form_data.append('file[]', prop);
                    //form_data.append("file[]", "prop_id:"+'"'+prop_id+'"');
                    //form_data.append("file[]", prop_id);
                    // Display the values
                    for (var value of form_data.values()) {
                       console.log(value); 
                    }
                }
            }
        }
        //console.log($.param(form_data));
        if(error_images == '')
        {
            $.ajax({
                url:"/inc/ajax.php",
                method:"POST",
                //data: {img_upload:prop_id, img_data:form_data},
                data: form_data,
                contentType: false,
                //cache: false,
                processData: false,
                beforeSend:function(){
                $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
                },   
                success:function(data)
                {
                    console.log(data);
                    $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
                    //load_image_data();
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
        else
        {
            $('#multiple_files').val('');
            $('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
        return false;
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