<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
   <ul class="services-list">
       <?foreach($arResult["SECTIONS"] as $arItem):?>
           <?
           $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strSectionEdit);
           $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
           ?>
          <li id="<? echo $this->GetEditAreaId($arItem['ID']); ?>" class="catalog-section-item">
             <a href="<?echo $arItem["SECTION_PAGE_URL"]?>" title="<?echo $arItem["NAME"]?>">
                <img src="<?=$arItem["PICTURE"]["SRC"]?>"  alt="<?=$arItem["PICTURE"]["ALT"]?>" title="<?=$arItem["PICTURE"]["TITLE"]?>">
             </a>
             <h4 class="box-header"><a class="custom_color" href="<?echo $arItem["SECTION_PAGE_URL"]?>" title="<?echo $arItem["NAME"]?>"><?=$arItem["NAME"]?><span class="template-arrow-menu"></span></a></h4>
          </li>
       <?endforeach;?>
   </ul>