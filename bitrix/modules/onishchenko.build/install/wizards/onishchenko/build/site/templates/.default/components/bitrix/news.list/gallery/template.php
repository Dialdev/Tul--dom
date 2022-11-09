<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->addExternalCss(DEFAULT_TEMPLATE_PATH."/css/jquery.fancybox.min.css");
$this->addExternalJS(DEFAULT_TEMPLATE_PATH."/js/jquery.fancybox.min.js");
$this->setFrameMode(true);
?>
<div class="clearfix">
   <div class="row">
      <ul class="tabs-navigation small isotope-filters margin-top-50">
         <li><a class="selected" href="#filter-*"><?=GetMessage('ALL')?></a></li>
         <?foreach($arResult['IBLOCK_SECTION_LIST'] as $item):?>
         <li><a  href="#filter-<?=$item['ID']?>" title="<?=$item['NAME']?>"><?=$item['NAME']?></a></li>
         <?endforeach;?>
      </ul>
      <ul class="galleries-list isotope" style="position: relative; height: 420px;">
       <?foreach($arResult['ITEMS'] as $item):?>
         <?
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
           if($item['PREVIEW_PICTURE']){
               $image = CFile::ResizeImageGet($item['PREVIEW_PICTURE']['ID'], ["width" => 270, "height" => 180], BX_RESIZE_IMAGE_PROPORTIONAL);
           }
           else{
               $image['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
           }
            ?>
         <li class="<?=$item['IBLOCK_SECTION_ID']?>" style="position: absolute; left: 0px; top: 0px;" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$item['NAME']?>">
               <img src="<?=$image['src']?>" alt="<?=$item['NAME']?>">
            </a>
            <div class="view align-center">
               <div class="vertical-align-table">
                  <div class="vertical-align-cell">
                     <p class="description"><?=$item['NAME']?></p>
                     <a href="<?=$item['PREVIEW_PICTURE']['SRC']?>" class="gallery show-big-photo template-search"></a>
                     <a href="<?=$item['DETAIL_PAGE_URL']?>" class="show-big-photo">...</a>
                  </div>
               </div>
            </div>
         </li>
          <?endforeach;?>
      </ul>
   </div>
</div>