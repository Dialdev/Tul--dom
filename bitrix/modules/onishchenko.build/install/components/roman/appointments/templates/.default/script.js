$(document).ready(function(){

    var input_phone = $('.form-appointments [name = phone]');
    input_phone.mask("8(999) 999-9999");

    $('.form-appointments .submit-contact-form').click(function(){
        var input_name = $('.form-appointments [name = name]');
        var input_email = $('.form-appointments [name = email]');
        var service = $('.form-appointments [name = service]').data('serviceid');
        var service_name = $('.form-appointments [name = service]').val();
        var input_message = $('.form-appointments [name = message]');
        var recaptcha = $('#recaptcha-appointments-form [name = g-recaptcha-response]').val();
        if(appointments_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_email.val()) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            var correct_email = (pattern.test(input_email.val())) ? true : false;
        }
        else{
            var correct_email = true;
        }
        if(input_name.val().trim() && correct_email && input_phone.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: appointments_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'APPOINTMENTS',
                    sessid:$('.form-appointments [name = sessid]').val().trim(),
                    phone:input_phone.val().trim(),
                    name:input_name.val().trim(),
                    service:service,
                    email:input_email.val().trim(),
                    service_name:service_name,
                    message:input_message.val().trim()
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_phone.val('');
                    input_message.val('');
                    input_name.removeClass('feedback-error');
                    input_phone.removeClass('feedback-error');
                    $('.form-appointments #message').text(msg);
                }
            });
        }
        else if(!correct_email  && input_name.val().trim() && input_phone.val().trim()){
            $('.form-appointments #message').text(appointments_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_phone.removeClass('feedback-error');
        }
        else if(correct_email  && input_name.val().trim() && input_phone.val().trim() && !recaptcha){
            $('.form-appointments #message').text(appointments_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('.form-appointments #message').text(appointments_js_obj.REQUIRED_FIELDS);
            input_phone.addClass('feedback-error');
            input_name.addClass('feedback-error');
        }

    });

    $('.form-appointments .contact-form').find('input').keydown(function(){
        $(this).removeClass('feedback-error');
    });

});