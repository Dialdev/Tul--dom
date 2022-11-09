$(document).ready(function(){

    $('#faq .submit-contact-form').click(function(){
        var input_name = $('#faq [name = name]');
        var input_email = $('#faq [name = email]');
        var input_message = $('#faq [name = message]');
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var correct_email = (pattern.test(input_email.val())) ? true : false;
        var input_subject = $('#faq [name = subject]');
        var recaptcha = $('#recaptcha-question-faq-form [name = g-recaptcha-response]').val();
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
                    sessid:$('#faq  [name = sessid]').val().trim(),
                    action:'faq_question',
                    name:input_name.val().trim(),
                    email:input_email.val(),
                    message:input_message.val().trim(),
                    subject:input_subject.val()
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_message.val('');
                    input_subject.val('');
                    input_email.removeClass('feedback-error');
                    input_name.removeClass('feedback-error');
                    input_message.removeClass('feedback-error');
                    input_subject.removeClass('feedback-error');
                    $('#faq #message').text(msg);
                }
            });
        }
        else if(!correct_email  && input_message.val().trim() && input_name.val().trim() && input_subject.val().trim()){
            $('#faq #message').text(question_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_message.removeClass('feedback-error');
            input_subject.removeClass('feedback-error');
        }
        else if(correct_email  && input_message.val().trim() && input_name.val().trim() && input_subject.val().trim() && !recaptcha){
            $('#faq #message').text(question_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('#faq #message').text(question_js_obj.REQUIRED_FIELDS);
            input_email.addClass('feedback-error');
            input_name.addClass('feedback-error');
            input_message.addClass('feedback-error');
            input_subject.addClass('feedback-error');
        }

    });

    $('#faq .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });


});