<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arSelect = Array('ID','IBLOCK_ID','NAME','PREVIEW_TEXT');
$arFilter = Array("IBLOCK_ID"=>$arResult['PROPERTIES']['QUESTIONS']['LINK_IBLOCK_ID'],"ID"=>$arResult['PROPERTIES']['QUESTIONS']['VALUE'], "ACTIVE"=>"Y");
$r = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($res = $r->Fetch()){
    $arResult['QUESTIONS'][] = $res;
}
$this->__component->SetResultCacheKeys(array('ELEMENTS_SECTION','DISPLAY_PROPERTIES'));
?>