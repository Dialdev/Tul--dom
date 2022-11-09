<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>
   <ul class="vertical-menu" style="margin-bottom: 60px;">
    <?
    $previousLevel = 0;
foreach($arResult as $arItem):?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>
    <?if ($arItem["IS_PARENT"]):?>
    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
   <li <?if ($arItem["SELECTED"]):?>class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span class="template-arrow-menu"></span></a>
   <ul>
    <?else:?>
   <li<?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span class="template-arrow-menu"></span></a>
   <ul>
    <?endif?>
    <?else:?>
        <?if ($arItem["PERMISSION"] > "D"):?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
             <li <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span class="template-arrow-menu"></span></a></li>
            <?else:?>
             <li<?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span class="template-arrow-menu"></span></a></li>
            <?endif?>
        <?endif?>
    <?endif?>
    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
    <?if ($previousLevel > 1):?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>
   </ul>
<?endif?>