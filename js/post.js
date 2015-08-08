$(document).ready(function() {
$("#signinForm").submit(function(e){
	e.preventDefault();
	var form_data = {
		fullname : $('#fullname_contact').val(),
		businessname : $('#businessname_contact').val(),
		email : $('#email_contact').val(),
		phone : $('#phone_contact').val(),
		subject : $('#subject_contact').val(),
		message : $('#message_contact').val(),
		ajax: '1'	
	}

	$.ajax({
		type: 'POST',
		url: 'http://www.eunuigbe.home/~unuigbee/edwardstreetparish/contactform',
		dataType: 'json',
		data: form_data,
		success: function(){
				alert('success');
		},
		error: function(response){
			if( response.status == 400 ) { //Validation error or other reason for Bad Request 400
            var json = $.parseJSON( response.responseText );
            console.log(json);
    		}
    	}
	});
});
});