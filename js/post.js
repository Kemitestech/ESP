function Postcontactform(){
	
	$("#signinForm").submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'http://www.eunuigbe.home/~unuigbee/edwardstreetparish/contactform',
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
	});
}