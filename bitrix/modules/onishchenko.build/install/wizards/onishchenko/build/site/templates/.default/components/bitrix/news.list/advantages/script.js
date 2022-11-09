$(document).ready(function(){
    var text_block = $('.my-column .features-list.big p');
    var height = $(text_block[0]).height();
    text_block.each(function(index){
        if($(text_block[index]).height() > height){
            height = $(text_block[index]).height();
        }
    });
    text_block.height(height);

    var h4 = $('.my-h4');
    var height_h4 = $(h4[0]).height();
    h4.each(function(index){
        if($(h4[index]).height() > height_h4){
            height_h4 = $(h4[index]).height();
        }
    });
    h4.height(height_h4);
});