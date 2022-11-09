<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->addExternalJS("//yastatic.net/share2/share.js");
$this->setFrameMode(true);
?>
<div class="post single">
   <?if($arResult['PROPERTIES']['YOUTUBE']['VALUE']):?>
   <iframe width="100%"  height="470px" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']['YOUTUBE']['VALUE']?>" frameborder="0" allowfullscreen></iframe>
   <?else:?>
      <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" width="100%">
   <?endif;?>
   <div class="post-content-details-container clearfix">
      <ul class="post-content-details">
         <li><?=$arResult['DISPLAY_ACTIVE_FROM']?></li>
         <li><?=GetMessage('AUTHOR')?>: <?=strstr($arResult['CREATED_USER_NAME'],' ')?></li>
         <li class="template-eye"><?=($arResult['SHOW_COUNTER']) ? $arResult['SHOW_COUNTER'] : 0 ?></li>
      </ul>
   </div>
   <h3 class="box-header"><?=$arResult['NAME']?></h3>
   <div class="detail-text">
       <?=$arResult['DETAIL_TEXT']?>
   </div>
   <div style="text-align: right;" class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,telegram"></div>
   <div class="row padding-top-54 padding-bottom-20">
      <a class="more" href="<?=$arParams['BACK']?>" title="<?=GetMessage('AGO')?>"><span><?=GetMessage('AGO')?></span></a>
   </div>
</div>