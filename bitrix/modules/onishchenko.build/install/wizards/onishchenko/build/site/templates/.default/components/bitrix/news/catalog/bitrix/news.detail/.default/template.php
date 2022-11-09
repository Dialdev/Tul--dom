<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->addExternalJS(DEFAULT_TEMPLATE_PATH."/gallery/jgallery.min.js");
$this->addExternalJS(DEFAULT_TEMPLATE_PATH."/gallery/touchswipe.min.js");
$this->addExternalCss(DEFAULT_TEMPLATE_PATH."/gallery/font-awesome.min.css");
$this->addExternalCss(DEFAULT_TEMPLATE_PATH."/gallery/jgallery.min.css");
$this->addExternalJS("//yastatic.net/share2/share.js");
$this->setFrameMode(true);
?>
<div id="gallery">
   <?if($arResult['DETAIL_PICTURE']['SRC']):?>
    <?$min_photo = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],["width" => 114, "height" => 77], BX_RESIZE_IMAGE_PROPORTIONAL);?>
   <a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
      <img src="<?=$min_photo['src']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
   </a>
   <?else:?>
      <a href="<?=DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif'?>">
         <img src="<?=DEFAULT_TEMPLATE_PATH . '/images/no-photo-min.gif'?>" alt="<?=GetMessage('NO_PHOTO')?>" <?=GetMessage('NO_PHOTO')?>>
      </a>
   <?endif;?>
    <?if( is_array($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] ) ):?>
       <?if( isset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'][0] ) ):?>
         <?
            $i = 2;
            foreach($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] as $photo):
             $min_photo = CFile::ResizeImageGet($photo['ID'],["width" => 114, "height" => 77], BX_RESIZE_IMAGE_PROPORTIONAL);
         ?>
            <a href="<?=$photo['SRC']?>">
               <img src="<?=$min_photo['src']?>" alt='<?=$arResult["DETAIL_PICTURE"]["ALT"] . ' ' . GetMessage('PHOTO') . " - $i"?>' title='<?=$arResult["DETAIL_PICTURE"]["TITLE"] . "- $i" . GetMessage('PHOTO')?>'>
            </a>
             <?$i++;?>
         <?endforeach;?>
       <?else:?>
         <?$min_photo = CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['ID'],["width" => 114, "height" => 77], BX_RESIZE_IMAGE_PROPORTIONAL);?>
          <a href="<?=$arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE']['SRC']?>">
             <img src="<?=$min_photo['src']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?> <?=GetMessage('PHOTO')?> - 2" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?> - 2">
          </a>
       <?endif;?>
    <?endif;?>
</div>
<div class="price catalog-price">
   <div class="top-container">
      <div class="square"><?=number_format($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'],0,false, ' ')?> &#8381;</div>
      <div class="square color"><?=$arResult['PROPERTIES']['PLOSHCHAD']['VALUE']?> <?=GetMessage('METRE')?><sup>2</sup></div>
   </div>
</div>
<div class="table">
   <?foreach($arResult['FOR_RIGHT_TABLE'] as $name => $value):?>
   <div class="table-tr">
      <div class="table-td"><?=$name?></div>
      <div class="table-td"><?if($value):?><?=$value?><?else:?><a href="#"><?=GetMessage('CLARIFY')?></a><?endif;?></div>
   </div>
    <?endforeach;?>
</div>
<div class="price catalog-price">
   <div class="button-container">
      <a class="button-form form-call more" href="#" title="<?=GetMessage('READ_MORE')?>" data-buildid="<?=$arResult['ID']?>" data-buildname="<?=$arResult['NAME']?>"><?=GetMessage('CALCULATE_COST')?></a>
      <a class="button-form form-question more simple" href="#" title="<?=GetMessage('READ_MORE')?>" data-buildid="<?=$arResult['ID']?>" data-buildname="<?=$arResult['NAME']?>"><?=GetMessage('ASK_QUESTION')?></a>
   </div>
</div>
<div class="share-container">
   <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,telegram"></div>
</div>
<div style="clear:both"></div>
<?if(is_array($arResult['DISPLAY_PROPERTIES']['FASADI']['FILE_VALUE'])):?>
   <h4 class="box-header"><?=GetMessage('FACADES')?></h4>
   <div class="row">
       <?if( isset($arResult['DISPLAY_PROPERTIES']['FASADI']['FILE_VALUE'][0] ) ):?>
           <?$i = 1;?>
            <?foreach($arResult['DISPLAY_PROPERTIES']['FASADI']['FILE_VALUE'] as $photo):
               $min_photo = CFile::ResizeImageGet($photo['ID'],["width" => 200, "height" => 150], BX_RESIZE_IMAGE_PROPORTIONAL);
            ?>
             <div class="facadi-container">
                <a href="<?=$photo['SRC']?>" class="gallery">
                   <img src="<?=$min_photo['src']?>" alt="<?=GetMessage('FACADE')?> - <?=$i?>">
                </a>
             </div>
               <?$i++;?>
         <?endforeach;?>
         <?else:
           $min_photo = CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['FASADI']['FILE_VALUE']['ID'],["width" => 200, "height" => 150], BX_RESIZE_IMAGE_PROPORTIONAL);
         ?>
          <div class="facadi-container">
             <a href="<?=$arResult['DISPLAY_PROPERTIES']['FASADI']['FILE_VALUE']['SRC']?>" class="gallery">
               <img src="<?=$min_photo['src']?>" alt="<?=GetMessage('FACADE')?>">
             </a>
          </div>
       <?endif;?>
   </div>
<?endif;?>
<div class="detail-text">
    <?=$arResult['DETAIL_TEXT']?>
</div>
<?if(is_array($arResult['DISPLAY_PROPERTIES']['SCHEME']['FILE_VALUE'])):?>
   <h4 class="box-header"><?=GetMessage('SCHEMES')?></h4>
   <div class="row">
      <?if( isset($arResult['DISPLAY_PROPERTIES']['SCHEME']['FILE_VALUE'][0] ) ):?>
          <?$i = 1;?>
         <?foreach($arResult['DISPLAY_PROPERTIES']['SCHEME']['FILE_VALUE'] as $photo):
            $min_photo = CFile::ResizeImageGet($photo['ID'],["width" => 400, "height" => 268], BX_RESIZE_IMAGE_PROPORTIONAL);
         ?>
          <div class="scheme-container">
             <a href="<?=$photo['SRC']?>" class="gallery">
               <img src="<?=$min_photo['src']?>" alt="<?=GetMessage('SCHEME')?> - <?=$i;?>">
             </a>
          </div>
           <?$i++;?>
       <?endforeach;?>
      <?else:
          $min_photo = CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['SCHEME']['FILE_VALUE']['ID'],["width" => 400, "height" => 268], BX_RESIZE_IMAGE_PROPORTIONAL);
       ?>
         <div class="scheme-container">
            <a href="<?=$arResult['DISPLAY_PROPERTIES']['SCHEME']['FILE_VALUE']['SRC']?>" class="gallery">
               <img src="<?=$min_photo['src']?>" alt="<?=GetMessage('SCHEME')?>">
            </a>
         </div>
      <?endif;?>
   </div>
<?endif;?>
<script>
   var param = {
       CLOSE:"<?=GetMessage('CLOSE')?>",
       FULL_SCREEN:"<?=GetMessage('FULL_SCREEN')?>",
       BIG:"<?=GetMessage('BIG')?>",
       SHOW:"<?=GetMessage('SHOW')?>",
   }
</script>