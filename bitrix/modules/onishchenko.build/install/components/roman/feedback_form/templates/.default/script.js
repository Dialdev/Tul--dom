$(document).ready(function(){

    var input_phone = $('#contact-form [name = phone]');
    input_phone.mask("8(999) 999-9999");

    $('#contact-form .submit-contact-form').click(function(){
        var input_name = $('#contact-form [name = name]');
        var input_email = $('#contact-form [name = email]');
        var input_message = $('#contact-form [name = message]');
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var correct_email = (pattern.test(input_email.val())) ? true : false;
        var recaptcha = $('#recaptcha-feedback-form [name = g-recaptcha-response]').val();
        if(feedback_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_name.val().trim() && correct_email && input_phone.val().trim() && input_message.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: feedback_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'FEEDBACK',
                    sessid:$('#contact-form [name = sessid]').val().trim(),
                    name:input_name.val().trim(),
                    email:input_email.val(),
                    phone:input_phone.val(),
                    message:input_message.val().trim()
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_phone.val('');
                    input_message.val('');
                    input_name.removeClass('feedback-error');
                    input_message.removeClass('feedback-error');
                    input_phone.removeClass('feedback-error');
                    input_email.removeClass('feedback-error');
                    $('#contact-form #message').text(msg);
                }
            });
        }
        else if(!correct_email && input_phone.val().trim() && input_message.val().trim() && input_name.val().trim()){
            $('#contact-form #message').text(feedback_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_message.removeClass('feedback-error');
            input_phone.removeClass('feedback-error');
        }
        else if(correct_email && input_phone.val().trim() && input_message.val().trim() && input_name.val().trim() && !recaptcha){
            $('#contact-form #message').text(feedback_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('#contact-form #message').text(feedback_js_obj.REQUIRED_FIELDS);
            input_email.addClass('feedback-error');
            input_name.addClass('feedback-error');
            input_message.addClass('feedback-error');
            input_phone.addClass('feedback-error');
        }

    });

    $('#contact-form .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });

});