$(document).ready(function () {
    if(CastomizerJsObj.FLY_HEADER == 'Y'){
        $('.header-container').addClass('sticky');
    }

    if(CastomizerJsObj.FLY_SIDEBAR == 'Y'){
        $('#fly_sidebar').addClass('re-smart-column');
    }

    if(CastomizerJsObj.MAIN_PAGE_REVIEWS != 'Y'){
        $('.parallax.parallax-1').hide();
    }

    $('[name = top_menu]').change(function(){
        var top_menu = $('.header-container');
        if($(this).is(":checked")){
            top_menu.addClass('sticky');
            document.cookie = "FLY_HEADER=Y; path=/;";
            window.fly_menu();
        }
        else{
            top_menu.removeClass('sticky');
            $('#cs-sticky-clone').remove();
            document.cookie = "FLY_HEADER=N; path=/;";
        }
    });

    $('[name = sidebar]').change(function(){
        var sidebar = $('#fly_sidebar');
        if($(this).is(":checked")){
            sidebar.addClass('re-smart-column');
            document.cookie = "FLY_SIDEBAR=Y; path=/;";
        }
        else{
            sidebar.removeClass('re-smart-column');
            $('.re-smart-column-wrapper').css('position','static');
            document.cookie = "FLY_SIDEBAR=N; path=/;";
        }
    });


    $('[name = reviews_controller]').change(function(){
        var main_page_reviews = $('.row.full-width.padding-top-70.padding-bottom-66.parallax.parallax-1');
        if($(this).is(":checked")){
            main_page_reviews.show();
            document.cookie = "MAIN_PAGE_REVIEWS=Y; path=/;";
        }
        else{
            main_page_reviews.hide();
            document.cookie = "MAIN_PAGE_REVIEWS=N; path=/;";
        }
    });

    $('.gear').click(function(){
        if(CastomizerJsObj.FOR_DEMO == 'Y'){
            $('.customizer-container .show-admin').toggleClass('active');
        }
        $('.customizer-container').toggleClass('active');
        $('#colorpickerHolder').ColorPicker(
            {
                flat: true,
                color:'#' + $('.customizer-tab.active').data('color'),
                onChange: function (hsb, hex, rgb) {
                    $('.customizer-tab.active').data('color', hex);
                    $('.customizer-tab.active i').css('background','#'+hex);
                }
            }
        );
        $(this).toggleClass('into');
    });

    $('.customizer-tab').click(function(){
        $('.customizer-tab').removeClass('active');
        $(this).addClass('active');
        var color = '#' + $(this).data('color');
        $('#colorpickerHolder').ColorPickerSetColor(color);
    });

    function preloader(obj){
        $(obj).append('<img class="customizer-preloader" src="/bitrix/templates/.default/images/preloader.gif">');
    }

    $('.customizer-container .save').click(function(){
        if(!CastomizerJsObj.ADMIN)
            return false;
        var FLY_SIDEBAR = ($('[name = sidebar]').is(":checked")) ? 'Y' : 'N';
        var FLY_HEADER = ($('[name = top_menu]').is(":checked")) ? 'Y' : 'N';
        var MAIN_PAGE_REVIEWS = ($('[name = reviews_controller]').is(":checked")) ? 'Y' : 'N';
        preloader(this);
        $.ajax({
            type: "POST",
            url: CastomizerJsObj.page,
            data: {
                ajax:'CUSTOMIZER',
                action:'SAVE',
                sessid:CastomizerJsObj.sessid,
                COLOR_1:$('.customizer-tab:nth-child(1)').data('color'),
                COLOR_2:$('.customizer-tab:nth-child(2)').data('color'),
                COLOR_3:$('.customizer-tab:nth-child(3)').data('color'),
                COLOR_4:$('.customizer-tab:nth-child(4)').data('color'),
                FLY_SIDEBAR:FLY_SIDEBAR,
                FLY_HEADER:FLY_HEADER,
                MAIN_PAGE_REVIEWS:MAIN_PAGE_REVIEWS
            },
            success: function(){
                document.location.href = CastomizerJsObj.page;
            }
        });
    });

    $('.customizer-container .reset').click(function(){
        preloader(this);
        $.ajax({
            type: "POST",
            url: CastomizerJsObj.page,
            data: {
                ajax:'CUSTOMIZER',
                action:'DEFAULT',
                sessid:CastomizerJsObj.sessid,
            },
            success: function(){
                document.location.href = CastomizerJsObj.page;
            }
        });
    });

});