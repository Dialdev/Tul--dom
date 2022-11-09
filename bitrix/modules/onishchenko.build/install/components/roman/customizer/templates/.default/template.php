<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(file_exists($_SERVER['DOCUMENT_ROOT'] . $templateFolder."/colors.css")){
    $this->addExternalCss($templateFolder."/colors.css");
}
$this->setFrameMode(true);
?>
<script>
    var CastomizerJsObj = {
        page:"<?=$APPLICATION->GetCurPage();?>",
        sessid:"<?=bitrix_sessid()?>",
        cssGeneratePage:"<?=$templateFolder . '/colors.php'?>",
        FLY_SIDEBAR:"<?=$arResult['FLY_SIDEBAR']?>",
        FLY_HEADER:"<?=$arResult['FLY_HEADER']?>",
        MAIN_PAGE_REVIEWS:"<?=$arResult['MAIN_PAGE_REVIEWS']?>",
        FOR_DEMO:"<?=$arParams['FOR_DEMO']?>",
        <?if($arResult['ADMIN']):?>
        ADMIN:true,
        <?endif;?>
    };
</script>
<?php
$this->addExternalJS($templateFolder."/colorpicker.js");
if($arResult['TMP_COLORS']):?>
   <span id="css-customizer">
   <link rel="stylesheet" href="<?=$templateFolder."/colors.php?" . time()?>">
   </span>
<?endif?>
<div class="customizer-container">
    <?if($arParams['FOR_DEMO'] == 'Y' || $arResult['ADMIN']):?>
       <div class="gear" title="open/close">
          <img src="<?=$templateFolder?>/images/gear.svg" alt="gear">
       </div>
    <?endif;?>
    <?if($arParams['FOR_DEMO'] == 'Y'):?>
       <div class="show-admin button-form form-admin active">
          <span class="rotate-text"><?=GetMessage('SHOW_ADMIN_PANEL')?></span>
       </div>
    <?endif;?>
   <div class="customizer-header"><?=GetMessage('COMPONENT_NAME')?></div>
   <div class="customizer-sub">
      <div class="customizer-tabs">
         <div class="customizer-tab active" data-color-id="1" data-color="<?=$arResult['COLOR_1']?>"><?=GetMessage('COLOR_1')?><i></i></div>
         <div class="customizer-tab" data-color-id="2" data-color="<?=$arResult['COLOR_2']?>"><?=GetMessage('COLOR_2')?><i></i></div>
         <div class="customizer-tab" data-color-id="3" data-color="<?=$arResult['COLOR_3']?>"><?=GetMessage('COLOR_3')?><i></i></div>
         <div class="customizer-tab" data-color-id="4" data-color="<?=$arResult['COLOR_4']?>"><?=GetMessage('COLOR_4')?><i></i></div>
         <style>
            .customizer-tab:first-child i{
               background:<?= '#' . $arResult['COLOR_1']?>;
            }
            .customizer-tab:nth-child(2) i{
               background:<?= '#' . $arResult['COLOR_2']?>;
            }
            .customizer-tab:nth-child(3) i{
               background:<?= '#' . $arResult['COLOR_3']?>;
            }
            .customizer-tab:nth-child(4) i{
               background:<?= '#' . $arResult['COLOR_4']?>;
            }
         </style>
      </div>
      <p id="colorpickerHolder"></p>
   </div>
   <div class="customizer-sub">
      <div class="toggle-container">
         <div class="customizer-row">
            <div class="label"><?=GetMessage('HEAD')?></div>
            <div class="onoffswitch">
               <input type="checkbox" name="top_menu" class="onoffswitch-checkbox" id="top_menu" <?if($arResult['FLY_HEADER'] == 'Y'):?>checked<?endif;?>>
               <label class="onoffswitch-label" for="top_menu"></label>
            </div>
         </div>
         <div class="customizer-row">
            <div class="label"><?=GetMessage('SIDEBAR')?></div>
            <div class="onoffswitch">
               <input type="checkbox" name="sidebar" class="onoffswitch-checkbox" id="sidebar" <?if($arResult['FLY_SIDEBAR'] == 'Y'):?>checked<?endif;?>>
               <label class="onoffswitch-label" for="sidebar"></label>
            </div>
         </div>
         <div class="customizer-row">
            <div class="label"><?=GetMessage('REVIEWS_FOR_MAIN')?></div>
            <div class="onoffswitch">
               <input type="checkbox" name="reviews_controller" class="onoffswitch-checkbox" id="reviews" <?if($arResult['MAIN_PAGE_REVIEWS'] == 'Y'):?>checked<?endif;?>>
               <label class="onoffswitch-label" for="reviews"></label>
            </div>
         </div>
         <a href="javascript:void(null)" <?if(!$arResult['ADMIN']):?>class="save no-admin" title="<?=GetMessage('ONLY_ADMIN')?>"<?else:?>class="save"<?endif;?>><i class="template-bullet"></i><?=GetMessage('SAVE')?></a>
         <a href="javascript:void(null)" class="reset"><i class="template-bullet"></i><?=GetMessage('RESET')?></a>
      </div>
   </div>
</div>