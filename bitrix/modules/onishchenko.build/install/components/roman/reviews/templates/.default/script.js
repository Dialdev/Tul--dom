$(document).ready(function(){

    $('#reviews-form .submit-contact-form').click(function(){
        var input_name = $('#reviews-form [name = name]');
        var input_email = $('#reviews-form [name = email]');
        var input_message = $('#reviews-form [name = message]');
        var input_service = $('#reviews-form [name = service]');
        var recaptcha = $('#recaptcha-reviews-form [name = g-recaptcha-response]').val();
        if(param.no_google_api){
            recaptcha = true;
        }
        if(input_email.val()) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            var correct_email = (pattern.test(input_email.val())) ? true : false;
        }
        else{
            var correct_email = true;
        }
        if(input_name.val().trim() && correct_email && input_service.val().trim() && input_message.val().trim() && recaptcha){
            $.ajax({
                type: "POST",
                url: param.page,
                dataType: 'json',
                data: {
                    recaptcha:recaptcha,
                    ajax:'REVIEWS',
                    sessid:$('#reviews-form [name = sessid]').val().trim(),
                    name:input_name.val().trim(),
                    service:input_service.val().trim(),
                    email:input_email.val(),
                    message:input_message.val().trim()
                },
                success: function(msg){
                    if(param.allow_comments == 'Y' && msg.recaptcha_status == 'Y'){
                        $('<div class="review-item row">'+
                            '<div class="reviews-photo-wrap">'+
                                '<img class="staff-photo" src="'+param.DEFAULT_TEMPLATE_PATH+'/images/noavatar.png" alt="'+input_name.val()+'" title="'+input_name.val()+'">'+
                            '</div>'+
                            '<div class="review-body">'+
                                '<div>'+
                                    '<h5>'+input_name.val()+'</h5>'+
                                '</div>'+
                                '<p>'+input_message.val()+'</p>'+
                            '</div>'+
                        '</div>').prependTo('.column.column-3-4');
                        $('#reviews-form #message').text(param.OK);
                    }
                    else if(param.allow_comments !== 'Y' && msg.recaptcha_status == 'Y'){
                        $('#reviews-form #message').text(param.MODERATION);
                    }
                    else{
                        $('#reviews-form #message').text(param.ERROR);
                    }
                    input_name.val('');
                    input_email.val('');
                    input_service.val('');
                    input_message.val('');
                    input_name.removeClass('feedback-error');
                    input_email.removeClass('feedback-error');
                    input_service.removeClass('feedback-error');
                    input_message.removeClass('feedback-error');
                }
            });
        }
        else if(!correct_email && input_service.val().trim() && input_message.val().trim() && input_name.val().trim()){
            $('#reviews-form #message').text(param.CORRECT_EMAIL);
            input_email.addClass('feedback-error');
            input_name.removeClass('feedback-error');
            input_message.removeClass('feedback-error');
            input_service.removeClass('feedback-error');
        }
        else if(correct_email && input_service.val().trim() && input_message.val().trim() && input_name.val().trim() && !recaptcha){
            $('#reviews-form #message').text(param.APPLY_NO_ROBOT);
        }
        else{
            $('#reviews-form #message').text(param.REQUIRED_FIELDS);
            input_name.addClass('feedback-error');
            input_message.addClass('feedback-error');
            input_service.addClass('feedback-error');
        }
    });

    $('#reviews-form .contact-form').find('input,textarea').keydown(function(){
        $(this).removeClass('feedback-error');
    });


});