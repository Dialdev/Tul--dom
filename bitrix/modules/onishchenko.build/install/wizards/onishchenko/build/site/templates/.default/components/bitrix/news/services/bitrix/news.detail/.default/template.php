<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$this->addExternalJS("//yastatic.net/share2/share.js");

if($arResult['DETAIL_PICTURE']['ID']){
    $image1 = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ["width" => 420, "height" => 280], BX_RESIZE_IMAGE_PROPORTIONAL);
}
else{
    $image1['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
}
if($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']){
    $image2 = CFile::ResizeImageGet($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'], ["width" => 420, "height" => 280], BX_RESIZE_IMAGE_PROPORTIONAL);
}
else{
    $image2['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
}
?>
<div class="column column-3-4">
   <div class="row">
      <div class="column column-1-2">
         <a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="gallery">
            <img class='detail-service-img' src="<?=$image1['src']?>" alt="<?=$arResult['NAME']?>" width="100%">
         </a>
      </div>
      <div class="column column-1-2">
         <a href="<?=$arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['SRC']?>" class="gallery">
            <img class='detail-service-img' src="<?=$image2['src']?>" alt="<?=$arResult['NAME']?> - 2" width="100%">
         </a>
      </div>
   </div>

   <div class="gray service-consultation">
      <div class="service-consultation-column"><a href="#" class="more button-form form-appointments" href="#" data-serviceid="<?=$arResult['ID']?>" data-servicename="<?=$arResult['NAME']?>"><?=GetMessage('ORDER_SERVICE')?></a></div>
      <div class="service-consultation-column"><?=GetMessage('TEXT')?> </div>
   </div>

   <div class="row page-margin-top">
      <div class="column-1-1">
         <div class="detail-text">
             <?=$arResult['DETAIL_TEXT']?>
         </div>
      </div>
      <div style="margin-top:20px;text-align: right;" class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,telegram"></div>
   </div>
   <?if($arResult['QUESTIONS']):?>
   <div class="row page-margin-top padding-bottom-50">
      <div class="column" style="width:100%;">
         <h4 class="box-header"><?=GetMessage('POPULAR_QUESTIONS')?></h4>
         <ul class="accordion" style="margin-top:20px;">
         <?$i = 1;?>
         <?foreach($arResult['QUESTIONS'] as $questions):?>
            <li class="my-item" data-id="<?=$i?>">
               <h4 class="my-accordion">
               <?if($i == 1):?>
                  <span class="my-icon template-arrow-circle-down"></span>
               <?else:?>
                  <span class="my-icon template-arrow-circle-right"></span>
               <?endif;?>
                   <?=$questions['NAME']?>
               </h4>
               <p class="my-accordion-text" <?if($i == 1):?>style="display:block"<?endif;?>><?=$questions['PREVIEW_TEXT']?></p>
            </li>
         <?$i++;?>
         <?endforeach;?>
         </ul>
      </div>
   </div>
   <?endif;?>

      <h4 class="box-header"><?=GetMessage('ADVANTAGES')?></h4>
      <div  class="detail-service-advantages" style="overflow: hidden;margin-bottom:20px;margin-top:20px;">
         <div class="list-container">
            <div class="list-icon-container">
               <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/service_icon/kirpichi.png" alt="<?=GetMessage('ADVANTAGES_1')?>">
            </div>
            <span class="detail-service">
               <?=GetMessage('ADVANTAGES_1')?>
            </span>
         </div>
         <div class="list-container">
            <div class="list-icon-container">
               <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/service_icon/kran.png" alt="<?=GetMessage('ADVANTAGES_2')?>">
            </div>
            <span class="detail-service">
                <?=GetMessage('ADVANTAGES_2')?>
            </span>
         </div>
      </div>
      <div class="detail-service-advantages" style="overflow: hidden;">
         <div class="list-container">
            <div class="list-icon-container">
               <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/service_icon/skidki.png" alt="<?=GetMessage('ADVANTAGES_3')?>">
            </div>
            <span class="detail-service">
               <?=GetMessage('ADVANTAGES_3')?>
            </span>
         </div>
         <div class="list-container">
            <div class="list-icon-container">
               <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/service_icon/stroiteli.png" alt="<?=GetMessage('ADVANTAGES_4')?>">
            </div>
            <span class="detail-service">
               <?=GetMessage('ADVANTAGES_4')?>
            </span>
         </div>
      </div>
</div>