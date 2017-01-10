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
        e.preventDefault();//method for preventing the browser from refreshong the page
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
                  .html('Sorry, cannot send the message. Make sure you supplied the right Email address')
                  .show();
                  $('#alertmodal').modal('show');
                } else if(response.result === 'ok') {
                    $form.formValidation('resetForm', true);
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
    $('#prayer-request-form').formValidation({
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
       request: {
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
      //success.form.fv is a handler name for the event.  The event of submitting the form
     .on('success.form.fv', function(e) {
         e.preventDefault();
         var $form = $(e.target);//By submitting the form the DOM node of the form HTML element can be accessed via e.target

         //to make asynchronous calls to the server
         $.ajax({
           //The type is post because data is sent to the sever
             type: 'POST',
            //The url is the address of the server and the end point in which your controller will handle the request
             url: 'http://dev.cccedwardstreetparish.org/Prayerrequestform',
             //Data type is the format you want the server to respond as whenever possible
             dataType: 'json',
             //Data that will be sent to the Prayerrequestform controller.  form.serialize will get the name and value of each input field and create a string of name value pairs
             data: $form.serialize(),
             //Success is called if the request was successfull.  Success is the key and function is the value.  The response is passed to the function argument
             success: function(response){
               $('#csrf').val(response.csrfHash).attr('name', response.csrfTokenName);
               console.log(response);
                //  $('#csrf').val(response.csrfHash).attr('name', response.csrfTokenName);
                 if(response.result === 'error'){
                   $('#prayer-request-alert-message')//target #prayer-request-alert-message
                   .removeClass('alert-success')
                   .addClass('alert-warning')
                   .html('Sorry, cannot send the message. Make sure you supplied the right Email address')
                   .show();//show method shows the element alert message within the modal
                   $('#prayer-request-alert-modal').modal('show');//target prayer-request-alert-message and showing modal
                 } else if(response.result === 'ok') {
                     $form.formValidation('resetForm', true);
                     $('#prayer-request-alert-message')
                     .removeClass('alert-warning')
                     .addClass('alert-success')
                     .html('Thank you, your message has been sent.')
                     .show();
                     $('#prayer-request-alert-modal').modal('show');
                 }
             },
             //If there is a error with the request the error fuction will be called
             error: function(xhr){//XHR IS THE RESPONSE PROVIDED BY jQuery ajax method

                console.log(xhr);
                  //status is a special response key word that represent a HTTP status code
                 if(xhr.status == 400) { //Validation error or other reason for Bad request
                    //responseJSON is a conversion of a JSON response converted into a JavaScript object which was named responseJSON
                     var json = xhr.responseJSON;
                     $('#csrf').val(json.csrfHash).attr('name', json.csrfTokenName);
                     $('#prayer-request-alert-message')
                          .removeClass('alert-success')
                          .addClass('alert-warning')
                          .html('<h3>Sorry, there was a problem with your request.</h3><p><small>'+json.message+'</small></p>')
                          .show();
                          $('#prayer-request-alert-modal').modal('show');
                     console.log(json.message);
                 }
             }
         });
     });
});
