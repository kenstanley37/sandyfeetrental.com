$(document).ready(function(){
    zipcodeJson();
    phone();
});

// From the google maps geocode 
// http://maps.googleapis.com/maps/api/geocode/json?address=28787

function zipcodeJson(){
    $('#sandyZip').keyup(function(){
        var thistxt = $(this).val();
            if(thistxt.length == 5){
                var data = 'address='+thistxt+'?key=AIzaSyDsHj5eIyq4f07h-UfLHElgcotCMIebPJo'
                //alert(data);
                $.ajax({
                    type: 'GET',
                    url: 'https://maps.googleapis.com/maps/api/geocode/json',
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function(index, key) {
                            $.each(key, function(index, key){
                                city = key.address_components[1].long_name;
                                state = key.address_components[2].short_name;
                                var country = key.address_components[3].short_name;
                                var lat = key.geometry.location.lat;
                                var lng = key.geometry.location.lng;
                                //console.log(city, state, country, lat, lng);
                                $('#sandyState').val(state);
                                $('#sandyCity').val(city);
                                $('#sandyAddress').focus();
                            }); //end second each
                        }); //end first each
                    }, // end success
                    error:function(data){
                    console.log(data);
                    } //end error
                }); // end ajax
            } //end if
        }); //end keyup
} // end zipcodeJson


/*
    Format the phone input field

*/
function phone(){
    //alert('working');
    $('#sandyPhone')

	.keydown(function (e) {
		var key = e.which || e.charCode || e.keyCode || 0;
		$phone = $(this);

    // Don't let them remove the starting '('
    if ($phone.val().length === 1 && (key === 8 || key === 46)) {
			$phone.val('('); 
      return false;
		} 
    // Reset if they highlight and type over first char.
    else if ($phone.val().charAt(0) !== '(') {
			$phone.val('('+String.fromCharCode(e.keyCode)+''); 
		}

		// Auto-format- do not expose the mask as the user begins to type
		if (key !== 8 && key !== 9) {
			if ($phone.val().length === 4) {
				$phone.val($phone.val() + ')');
			}
			if ($phone.val().length === 4) {
				$phone.val($phone.val());
			}			
			if ($phone.val().length === 8) {
				$phone.val($phone.val() + '-');
			}
		}

		// Allow numeric (and tab, backspace, delete) keys only
		return (key == 8 || 
				key == 9 ||
				key == 46 ||
				(key >= 48 && key <= 57) ||
				(key >= 96 && key <= 105));	
	})
	
	.bind('focus click', function () {
		$phone = $(this);
		
		if ($phone.val().length === 0) {
			$phone.val('(');
		}
		else {
			var val = $phone.val();
			$phone.val('').val(val); // Ensure cursor remains at the end
		}
	})
	
	.blur(function () {
		$phone = $(this);
		
		if ($phone.val() === '(') {
			$phone.val('');
		}
	});
}