$( function() {
    $( '#gallery' ).jGallery({
        browserHistory: false,
        slideshowAutostart: false,
        slideshowCanRandom: false,
        canZoom: true,
        draggableZoom: true,
        height: '500px',
        maxMobileWidth: 767,
        slideshow: false,
        title: true,
        titleExpanded: false,
        tooltipClose: param.CLOSE,
        tooltipFullScreen: param.FULL_SCREEN,
        tooltipZoom: param.BIG,
        width: '62%',
        tooltipSeeAllPhotos: param.SHOW,
        canMinimalizeThumbnails: false,
    });

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

} );