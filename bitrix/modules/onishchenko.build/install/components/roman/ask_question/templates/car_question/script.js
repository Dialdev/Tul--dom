$(document).ready(function(){

    var input_phone = $('.form-question [name = phone]');
    input_phone.mask("8(999) 999-9999");

    $('.form-question .submit-contact-form').click(function(){
        var input_name = $('.form-question [name = name]');
        var input_email = $('.form-question [name = email]');
        var input_message = $('.form-question [name = message]');
        var build = $('.form-question [name = build]').data('buildid');
        var build_name = $('.form-question [name = build]').val();
        if(input_email.val()) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            var correct_email = (pattern.test(input_email.val())) ? true : false;
        }
        else{
            var correct_email = true;
        }
        var recaptcha = $('#recaptcha-question-build-form [name = g-recaptcha-response]').val();
        if(question_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_name.val().trim() && correct_email  && input_message.val().trim() && input_phone.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: question_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'QUESTION',
                    sessid:$('.form-question [name = sessid]').val().trim(),
                    action:'build_question',
                    phone:input_phone.val().trim(),
                    name:input_name.val().trim(),
                    build:build,
                    email:input_email.val(),
                    message:input_message.val().trim(),
                    build_name:build_name
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_message.val('');
                    input_phone.val('');
                    input_email.removeClass('feedback-error');
                    input_name.removeClass('feedback-error');
                    input_message.removeClass('feedback-error');
                    input_phone.removeClass('feedback-error');
                    $('.form-question #message').text(msg);
                }
            });
        }
        else if(!correct_email  && input_message.val().trim() && input_name.val().trim() && input_phone.val().trim()){
            $('.form-question #message').text(question_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_message.removeClass('feedback-error');
            input_phone.removeClass('feedback-error');
        }
        else if(correct_email  && input_message.val().trim() && input_name.val().trim() && input_phone.val().trim() && !recaptcha){
            $('.form-question #message').text(question_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('.form-question #message').text(question_js_obj.REQUIRED_FIELDS);
            input_phone.addClass('feedback-error');
            input_name.addClass('feedback-error');
            input_message.addClass('feedback-error');
        }

    });

    $('.form-question .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });


});