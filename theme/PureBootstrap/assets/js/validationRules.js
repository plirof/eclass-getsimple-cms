/****************************************************
*
* @File:      validationRules.js
* @Package:   GetSimple
* @Action:    PureBootstrap theme for GetSimple CMS
* @Author:    John Stray [https://www.johnstray.id.au/]
*
*****************************************************/
/**
   These validation rules will need to be modified according to the forms on
   your website that need validating. Visit the following website for info:
   http://bootstrapvalidator.com/
**/

$(document).ready(function() {
    $('#contact-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitButtons: 'button[type="submit"]',
        fields: {
            name: {
                validators: {
					notEmpty: {
						message: 'Your name is required and cannot be empty!',
					},
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'Name must consist of alphabetical characters and spaces only!'
                    },
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Your email is required and cannot be empty!'
                    },
                    emailAddress: {
                        message: 'Please type a valid email address!'
                    }
                }
            },
            website: {
                validators: {
                    regexp: {
						regexp: /^([a-zA-Z0-9\-]+(\.[a-zA-Z0-9\-]+)+\.*)$/,
                        message: 'Please enter a valid website address!'
                    }
                }
            },
            message: {
                validators: {
                    notEmpty: {
                        message: 'A message is required and cannot be empty!'
                    },
                    regexp: {
                        regexp: /^[\w\s\.\,\'\"\&\!\?\(\)\-\:\;\/]+$/,
                        message: 'Your message contains invalid characters!'
                    }
                }
            }
        }
    });
});