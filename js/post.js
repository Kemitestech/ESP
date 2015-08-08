$(".submit").click(function(){
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
		data: form_data,
		success: function(msg){
				alert(msg);
		},
		error: function(response){
			alert(response.responseJSON.msg);
		}
	});
	return false;
});
