$(document).ready(function(){
    $('.revolution-slider').show().revolution({
        dottedOverlay:"none",
        delay:10000,
        gridwidth:1170,
        gridheight:430,
        sliderLayout:"auto",
        navigation: {
            keyboardNavigation:"on",
            onHoverStop:"on",
            arrows: {
                style:"preview1",
                enable:true,
                hide_onmobile:true,
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:1500,
                hide_under:0,
                hide_over:9999,
                tmp:'',
                left : {
                    h_align:"left",
                    v_align:"center",
                    h_offset:0,
                    v_offset:0,
                },
                right : {
                    h_align:"right",
                    v_align:"center",
                    h_offset:0,
                    v_offset:0
                }
            },
            bullets: {
                style:"preview1",
                enable:true,
                hide_onmobile:true,
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:1500,
                hide_under:0,
                hide_over:9999,
                direction:"horizontal",
                h_align:"center",
                v_align:"bottom",
                space:10,
                h_offset:0,
                v_offset:20,
                tmp:'<span></span><span></span>'
            },
            parallax:{
                type:"off",
                bgparallax:"off",
                disable_onmobile:"on"
            }
        },
        shadow:0,
        spinner:"spinner0",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        disableProgressBar: "on"
    });
});