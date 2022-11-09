<?
$arFilter = array('IBLOCK_ID' => intval($arParams['IBLOCK_ID']),'ACTIVE' => 'Y');
$arSelect = array('ID','IBLOCK_ID','NAME','CODE');
$r = CIBlockSection::GetList(array(),$arFilter,false,$arSelect);
while($res = $r -> Fetch()){
  $arResult['IBLOCK_SECTION_LIST'][] = $res;
}