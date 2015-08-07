function Postcontactform(){
	
	$("#signinForm").submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'http://www.eunuigbe.home/~unuigbee/edwardstreetparish/contact_form/index',
			type: 'POST',
			data: $(this).seralize(),
			success: function(msg){
				if(msg.validate){
				alert("success");
					$(#fullname_contact).val = '';
					$(#businessname).val = '';
					$(#InputEmail1).val = '';
					$(#Inputphone).val = '';
					$(#subject).val = '';
					$(#InputEnquiry).val = '';
				}else{
					alert("error");
				}
					
			}
       });
	}
}