$(document).ready(function() {
  $('#subscribeForm').formValidation({
       framework: 'bootstrap',
       icon: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
       },
       fields: {
         email: {
               validators: {
                   emailAddress: {
                       message: 'Please enter a valid email address'
                   },
                   notEmpty: {
                       message: 'Your Email Address is required'
                   }
               }
          }
      }
   })
   .on('success.form.fv', function(e) {
       e.preventDefault();
       var $form = $(e.target);

       $.ajax({
           type: 'POST',
           url: 'http://dev.cccedwardstreetparish.org/Mailchimp',
           dataType: 'json',
           data: $form.serialize(),
           success: function(response){
               $('#subscribe_csrf').val(response.csrfHash).attr('name', response.csrfTokenName);

               if(response.status) {
                   $form.formValidation('resetForm', true);
                   $('#subscribeAlertMessage')
                   .removeClass('alert-warning')
                   .addClass('alert-success')
                   .html('<h3>Thank you for subscribing!</h3><p><small>We cannot wait to get in touch with you</small></p>')
                   .show();
                   $('#subscribeAlertmodal').modal('show');
               } else {
                   $('#subscribeAlertMessage')
                   .removeClass('alert-success')
                   .addClass('alert-warning')
                   .html('<h3>Sorry, there was a problem with your request.</h3><p><small>You might already have subscribed to our Newsletter!</small></p>')
                   .show();
                   $('#subscribeAlertmodal').modal('show');
               }
           },
           error: function(xhr){
               if(xhr.status == 400) { //Validation error or other reason for Bad Request 400
                   var json = $.parseJSON(xhr.responseText);
                   $('#subscribe_csrf').val(json.csrfHash).attr('name', json.csrfTokenName);
                   $('#subscribeAlertMessage')
                   .removeClass('alert-success')
                   .addClass('alert-warning')
                   .html('<h3>Sorry, there was a problem with your request.</h3><p><small>'+json.message+'</small></p>')
                   .show();
                   $('#subscribeAlertmodal').modal('show');
                   console.log(json.message);
               }
           }
       });
   });

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
                        message: 'Your full name is required'
                    },
					stringLength: {
                        max: 50,
                        message: 'Your full name must be less than 50 characters'
                    }
                }
            },
			businessname: {
                validators: {
                    stringLength: {
                        max: 50,
                        message: 'Your business name must be less than 50 characters'
                    }
                }
            },
			email: {
                validators: {
                    emailAddress: {
                        message: 'Please enter a valid email address'
                    },
                    notEmpty: {
                        message: 'Your Email Address is required'
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
                        message: 'A subject is required'
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
                        message: 'Your enquiry must be less than 300 characters'
                    },
                    notEmpty: {
                        message: 'Please tell us about your enquiry'
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
            url: 'http://dev.cccedwardstreetparish.org/Contactform',
            dataType: 'json',
            data: $form.serialize(),
            success: function(response){
                $('#csrf').val(response.csrfHash).attr('name', response.csrfTokenName);
                if(response.result === 'error'){
                  $('#alertmessage')
                  .removeClass('alert-success')
                  .addClass('alert-warning')
                  .html('<h3>Sorry, there was an error with your request.</h3> <p><small>Make sure you supplied the right Email address.</small></p>')
                  .show();
                  $('#alertmodal').modal('show');
                } else if(response.result === 'ok') {
                    $form.formValidation('resetForm', true);
                    $('#alertmessage')
                    .removeClass('alert-warning')
                    .addClass('alert-success')
                    .html('<h3>Thank you, your message has been sent.</h3> <p><small>We\'ll respond to you shortly.</small></p>')
                    .show();
                    $('#alertmodal').modal('show');
                }
            },
            error: function(xhr){
                console.log(xhr);
                if(xhr.status == 400) { //Validation error or other reason for Bad Request 400
                    var json = xhr.responseJSON;
                    $('#csrf').val(json.csrfHash).attr('name', json.csrfTokenName);
                    $('#alertmessage')
                    .removeClass('alert-success')
                    .addClass('alert-warning')
                    .html('<h3>Sorry, there was a problem with your request.</h3><p><small>'+json.message+'</small></p>')
                    .show();
                    $('#alertmodal').modal('show');
                    console.log(json.message);
                }
            }
        });
    });
});
