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
} );