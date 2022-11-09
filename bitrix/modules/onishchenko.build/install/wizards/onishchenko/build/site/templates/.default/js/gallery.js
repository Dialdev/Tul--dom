$(document).ready(function(){
    $(".isotope").isotope({
        masonry: {
            gutter: 30
        }
    });
    $(window).on("hashchange", function(event){
        var hashSplit = $.param.fragment().split("-");
        var hashString = "";
        for(var i=0; i<hashSplit.length-1; i++)
            hashString = hashString + hashSplit[i] + (i+1<hashSplit.length-1 ? "-" : "");
        var hashOptions = $.deparam.fragment();
        if(hashSplit[0].substr(0,7)=="filter"){
            var filterClass = decodeURIComponent($.param.fragment()).substr(7, decodeURIComponent($.param.fragment()).length);
            $(".isotope-filters a").removeClass("selected");
            if($('.isotope-filters a[href="#filter-' + filterClass + '"]').length)
                $('.isotope-filters a[href="#filter-' + filterClass + '"]').addClass("selected");
            else
                $(".isotope-filters li:first a").addClass("selected");
            $(".isotope").isotope({filter: (filterClass!="*" ? "." : "") + filterClass});
        }
    }).trigger("hashchange");
});
