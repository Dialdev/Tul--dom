<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="revolution-slider-container" >
   <div class="revolution-slider" style="height:460px !important;">
      <ul style="display: none;">
      <?foreach($arResult as $item):?>
          <?
          $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($staff["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
          ?>
         <li data-transition="fade" data-masterspeed="500" data-slotamount="1" data-delay="6000" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <img src="<?=$item['SRC']?>" alt="<?=$item['NAME']?>" data-bgfit="cover">
            <div class="tp-caption"
                 data-frames='[{"delay":0,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                 data-x="<?=$item['PROPERTY_POSITION_X_VALUE']?>"
                 data-y="<?=$item['PROPERTY_POSITION_Y_VALUE']?>"

            >
               <h2><a <?if($item['PROPERTY_ZAGOLOVOK_COLOR_VALUE']):?>style="color:<?=$item['PROPERTY_ZAGOLOVOK_COLOR_VALUE']?>;"<?endif;?>
                      href="<?=$item['PROPERTY_LINK_BUTTON_VALUE']?>"
                      title="<?=$item['NAME']?>">
                    <?=$item['NAME']?>
                  </a>
               </h2>
               <p style="margin-top:20px;
               <?if($item['PROPERTY_TEXT_COLOR_VALUE']):?>color:<?=$item['PROPERTY_TEXT_COLOR_VALUE']?>;<?endif;?>
               <?if($item['PROPERTY_TEXT_SHADOW_VALUE'] == 'Y'):?>text-shadow: 1px 1px 30px black;<?endif;?>"
                  class="description">
                  <?=$item['PROPERTY_MAIN_TEXT_VALUE']?>
               </p>
               <div style="margin-top:40px;" class="slider-button">
                  <a target="_top" class="more" href="<?=SITE_DIR . $item['PROPERTY_LINK_BUTTON_VALUE']?>" title="<?=$item['NAME']?>"><span><?=GetMessage('BUTTON_TEXT')?></span></a>
               </div>
            </div>
         </li>
      <?endforeach;?>
      </ul>
   </div>
</div>



