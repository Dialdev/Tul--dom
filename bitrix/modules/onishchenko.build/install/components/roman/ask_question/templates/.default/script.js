$(document).ready(function(){

    $('#form_question .submit-contact-form').click(function(){
        var input_name = $('#form_question [name = name]');
        var input_email = $('#form_question [name = email]');
        var input_message = $('#form_question [name = message]');
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var correct_email = (pattern.test(input_email.val())) ? true : false;
        var staff = $('#form_question [name = staff]').data('staffid');
        var staff_name = $('#form_question [name = staff]').val();
        var staff_email = ($('#form_question [name = staff]').data('email'))? $('#form_question [name = staff]').data('email') : false ;
        var recaptcha = $('#recaptcha-question-staff-form [name = g-recaptcha-response]').val();
        if(question_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_name.val().trim() && correct_email  && input_message.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: question_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'QUESTION',
                    sessid:$('#form_question [name = sessid]').val().trim(),
                    action:'staff_question',
                    name:input_name.val().trim(),
                    staff:staff,email:input_email.val(),
                    message:input_message.val().trim(),
                    staff_email:staff_email,
                    staff_name:staff_name
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_message.val('');
                    input_email.removeClass('feedback-error');
                    input_name.removeClass('feedback-error');
                    input_message.removeClass('feedback-error');
                    $('#form_question #message').text(msg);
                }
            });
        }
        else if(!correct_email  && input_message.val().trim() && input_name.val().trim()){
            $('#form_question #message').text(question_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_message.removeClass('feedback-error');
        }
        else if(correct_email  && input_message.val().trim() && input_name.val().trim() && !recaptcha){
            $('#form_question #message').text(question_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('#form_question #message').text(question_js_obj.REQUIRED_FIELDS);
            input_email.addClass('feedback-error');
            input_name.addClass('feedback-error');
            input_message.addClass('feedback-error');
        }

    });

    $('#form_question .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });


});