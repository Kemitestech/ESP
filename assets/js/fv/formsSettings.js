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
                        max: 30,
                        message: 'Your full name must be less than 30 characters'
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
						min: 8,
						message: 'Please enter at least 8 digits'
					}
                }
            },
            subject: {
                validators: {
                    notEmpty: {
                        message: 'A subject is required'
                    },
                    stringLength: {
                        max: 20,
                        message: 'The subject must be less than 20 characters'
                    }
                }
            },
			message: {
                validators: {
                    stringLength: {
                        max: 500,
                        message: 'Your enquiry must be less than 500 characters'
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
                    stringLength: {
                         max: 30,
                         message: 'Your full name must be less than 30 characters'
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
       request: {
                 validators: {
                     stringLength: {
                         max: 700,
                         message: 'Your enquiry must be less than 700 characters'
                     },
                     notEmpty: {
                         message: 'Please tell us about your prayer request'
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
                   .html('<h3>Sorry, cannot send the message</h3><p><small>Make sure you supplied the right Email address</small><p>')
                   .show();//show method shows the element alert message within the modal
                   $('#prayer-request-alert-modal').modal('show');//target prayer-request-alert-message and showing modal
                 } else if(response.result === 'ok') {
                     $form.formValidation('resetForm', true);
                     $('#prayer-request-alert-message')
                     .removeClass('alert-warning')
                     .addClass('alert-success')
                     .html('<h3>Thank you, your prayer request has been received.</h3>')
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
