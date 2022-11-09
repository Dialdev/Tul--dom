$(document).ready(function(){
    var block = $('.call-to-action.col-3.detail-action');
    var height = $(block[0]).height();
    block.each(function(index){
        if($(block[index]).height() > height){
            height = $(block[index]).height();
        }
    });
    block.height(height);
});