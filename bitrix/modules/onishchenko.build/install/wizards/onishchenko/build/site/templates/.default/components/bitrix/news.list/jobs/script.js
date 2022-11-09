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

    $('.tab-jobs').click(function(){
        var item = $('.my-item');
        if(!$(this).hasClass('active-job') && !$(this).hasClass('all')){
            $('.tab-jobs').removeClass('active-job');
            $(this).addClass('active-job');
            var sectionID = $(this).data('sectionid');
            item.hide();
            $('[data-itemsectionid='+sectionID+']').show();
            var firstitem = $($('[data-itemsectionid='+sectionID+']')[0]);
            firstitem.css('border-top','1px solid #E2E6E7');
            firstitem.find('.my-accordion-text').css('display','block');
            var icon = firstitem.find('.my-icon');
            if(icon.hasClass('template-arrow-circle-right')) {
                icon.removeClass('template-arrow-circle-right');
                icon.addClass('template-arrow-circle-down');
            }
        }
        else if($(this).hasClass('all') && !$(this).hasClass('active-job')){
            $('.tab-jobs').removeClass('active-job');
            $(this).addClass('active-job');
            item.each(function(index){
                if(index > 0){
                    $(item.find('.my-accordion-text')[index]).css('display','none');
                    $(item.find('.my-icon')[index]).removeClass('template-arrow-circle-down');
                    $(item.find('.my-icon')[index]).addClass('template-arrow-circle-right');
                }
            });
            item.show();
        }
    });
});