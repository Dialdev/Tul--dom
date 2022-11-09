$(document).ready(function(){
    var text_block = $('.staff-info-container');
    var height = $(text_block[0]).height();
    text_block.each(function(index){
        if($(text_block[index]).height() > height){
            height = $(text_block[index]).height();
        }
    });
    text_block.height(height);

});