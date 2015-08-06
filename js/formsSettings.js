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
			enquiry: {
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
    });
});