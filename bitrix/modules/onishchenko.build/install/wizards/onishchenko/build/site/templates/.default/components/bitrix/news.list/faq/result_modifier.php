<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arrSections = array_unique(array_column($arResult['ITEMS'],'IBLOCK_SECTION_ID'));

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID' => $arrSections);
$arSelect = array('ID','IBLOCK_ID','NAME');
$r = CIBlockSection::GetList(array(),$arFilter,false,$arSelect);
while($res = $r->Fetch()){
    $arResult['SECTIONS'][] = $res;
}

?>
