$(document).ready(function() {
   $('#signinForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fullname: {
                validators: {
                    notEmpty: {
                        message: 'The fullname is required'
                    },
					stringLength: {
                        max: 50,
                        message: 'The fullname must be less than 50 characters'
                    }
                }
            },
			businessname: {
                validators: {
                    stringLength: {
                        max: 50,
                        message: 'The business name must be less than 70 characters'
                    }
                }
            },
			email: {
                validators: {
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    },
                    notEmpty: {
                        message: 'The Email Address is required'
                    }
                }
            },
			phone: {
                validators: {
                    digits: {
                        message: 'The phone number can contain digits only'
                    },
					stringLength: {
						min: 11,
						message: 'Please enter at least 11 digits'
					}
                }
            },
            subject: {
                validators: {
                    notEmpty: {
                        message: 'The subject is required'
                    },
                    stringLength: {
                        max: 50,
                        message: 'The subject must be less than 50 characters'
                    }
                }
            },
			message: {
                validators: {
                    stringLength: {
                        max: 300,
                        message: 'The enquiry must be less than 200 characters'
                    },
                    notEmpty: {
                        message: 'The enquiry is required'
                    }
                }
            }
        }
    })
    .on('success.field.fv', function(e, data) {
            if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
                data.fv.disableSubmitButtons(true);
            }
    })
    .on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        
        $.ajax({
            type: 'POST',
            url: 'http://www.eunuigbe.home/~unuigbee/edwardstreetparish/contactform',
            dataType: 'json',
            data: $form.serialize(),
            success: function(response){
                    $form.formValidation('resetForm', true);
                    if(response.result === 'error'){
                        $('#alertmessage')
                        .removeClass('alert-success')
                        .addClass('alert-warning')
                        .html('Sorry, cannot send the message. Make sure you supplied the right Email address')
                        .show();
                        $('#alertmodal').modal('show');
                    }
                    if(response.result === 'ok'){
                        $('#alertmessage')
                        .removeClass('alert-warning')
                        .addClass('alert-success')
                        .html('Thank you, your message has been sent.')
                        .show();
                        $('#alertmodal').modal('show');
                    }
                        
            },
            error: function(xhr){
                if(xhr.status == 400) { //Validation error or other reason for Bad Request 400
                    var json = $.parseJSON(xhr.responseText );
                    alert(json.message);
                    console.log(json.message);
                }
            }
        });   
    });
});