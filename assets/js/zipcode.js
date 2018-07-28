$(document).ready(function(){
    zipcodeJson();
});

// From the google maps geocode 
// http://maps.googleapis.com/maps/api/geocode/json?address=28787

function zipcodeJson(){
    $('#sandyZip').keyup(function(){
        var thistxt = $(this).val();
        if(thistxt.length == 5){
            var data = 'address='+thistxt
            $.ajax({
              type: 'GET',
              url: 'http://maps.googleapis.com/maps/api/geocode/json',
              data: data,
              async: false,
              dataType: 'json',
              success: function (result) {
                $.each(result, function(index, key) {
                    $.each(key, function(index, key){
                        var city = key.address_components[1].long_name;
                        var state = key.address_components[2].short_name;
                        var country = key.address_components[3].short_name;
                        var lat = key.geometry.location.lat;
                        var lng = key.geometry.location.lng;
                        console.log(city, state, country, lat, lng);
                    });
                    
                    
                });
              }
            });
        }
        //alert(thistxt);
    });
}