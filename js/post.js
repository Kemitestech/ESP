function Postcontactform(){
	
	$("#signinForm").submit(function(e){
		$.ajax({
			url: 'http://www.eunuigbe.home/~unuigbee/edwardstreetparish/contact_form/index/',
			type: 'POST',
			data: $(this).serialize(),
			success: function(msg){
				if(msg.validate){
				alert("success");
				}else{
					alert("error");
				}
					
			}
       });
	})
}