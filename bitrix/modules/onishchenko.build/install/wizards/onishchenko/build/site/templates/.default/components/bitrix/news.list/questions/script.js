$(document).ready(function(){
    $('.my-accordion').click(function(){
        var parent_data_id = $(this).parent().data('id');
        $('[data-id='+parent_data_id+']').find('.my-accordion-text').slideToggle(400);
        var icon = $('[data-id='+parent_data_id+']').find('.my-icon');
        if(icon.hasClass('template-arrow-circle-right')) {
            icon.removeClass('template-arrow-circle-right');
            icon.addClass('template-arrow-circle-down');
        }
        else{
            icon.removeClass('template-arrow-circle-down');
            icon.addClass('template-arrow-circle-right');
        }
    });
});