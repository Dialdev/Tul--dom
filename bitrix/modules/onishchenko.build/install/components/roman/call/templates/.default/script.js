$(document).ready(function(){
    var input_phone = $('.form-call [name = phone]');
    input_phone.mask("8(999) 999-9999");

    $('.form-call .submit-contact-form').click(function(){
        var input_name = $('.form-call [name = name]');
        var input_message = $('.form-call [name = message]');
        var recaptcha = $('#recaptcha-call-form [name = g-recaptcha-response]').val();
        if(call_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_name.val().trim() && input_phone.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: call_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'CALL',
                    sessid:$('.form-call [name = sessid]').val().trim(),
                    name:input_name.val().trim(),
                    phone:input_phone.val(),
                    message:input_message.val().trim()
                },
                success: function(msg){
                    input_name.val('');
                    input_phone.val('');
                    input_message.val('');
                    input_name.removeClass('feedback-error');
                    input_phone.removeClass('feedback-error');
                    $('.form-call #message').text(msg);
                }
            });
        }
        else if(input_name.val().trim() && input_phone.val().trim() && !recaptcha){
            $('.form-call #message').text(call_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('.form-call #message').text(call_js_obj.REQUIRED_FIELDS);
            input_name.addClass('feedback-error');
            input_phone.addClass('feedback-error');
        }
    });

    $('.form-call .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });

});