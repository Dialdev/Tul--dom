$(document).ready(function(){

    $('#form_job .submit-contact-form').click(function(){
        var input_name = $('#form_job [name = name]');
        var input_email = $('#form_job [name = email]');
        var input_resume = $('#form_job [name = resume]');
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var correct_email = (pattern.test(input_email.val())) ? true : false;
        var job = $('#form_job [name = job]').data('jobid');
        var job_name = $('#form_job [name = job]').val();
        var recaptcha = $('#recaptcha-job-form [name = g-recaptcha-response]').val();
        if(job_js_obj.no_google_api){
            recaptcha = true;
        }
        if(input_name.val().trim() && correct_email  && input_resume.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: job_js_obj.page,
                data: {
                    recaptcha:recaptcha,
                    ajax:'JOB',
                    sessid:$('#form_job [name = sessid]').val().trim(),
                    name:input_name.val().trim(),
                    job:job,email:input_email.val(),
                    resume:input_resume.val().trim(),
                    job_name:job_name
                },
                success: function(msg){
                    input_name.val('');
                    input_email.val('');
                    input_resume.val('');
                    input_email.removeClass('feedback-error');
                    input_name.removeClass('feedback-error');
                    input_resume.removeClass('feedback-error');
                    $('#form_job #message').text(msg);
                }
            });
        }
        else if(!correct_email  && input_resume.val().trim() && input_name.val().trim()){
            $('#form_job #message').text(job_js_obj.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_resume.removeClass('feedback-error');
        }
        else if(correct_email && input_resume.val().trim() && input_name.val().trim()  && !recaptcha){
            $('#form_job #message').text(job_js_obj.APPLY_NO_ROBOT);
        }
        else{
            $('#form_job #message').text(job_js_obj.REQUIRED_FIELDS);
            input_email.addClass('feedback-error');
            input_name.addClass('feedback-error');
            input_resume.addClass('feedback-error');
        }

    });

    $('#form_job .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });

});