<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$сache = Bitrix\Main\Data\Cache::createInstance();
$cache_id = SITE_DIR . 'elements_menu';

if ($сache->initCache(36000000, $cache_id, $cache_id)) {
    $aMenuLinksExt = $сache->getVars();
}
elseif($сache->startDataCache()){
    $r = CIBlockElement::GetList(["SORT"=>"ASC"],['IBLOCK_ID' => '#IB_SERVICES#','ACTIVE' => 'Y'], false, false, ['ID','IBLOCK_ID','NAME','CODE','DETAIL_PAGE_URL']);
    $i =0;
    while($res = $r->Fetch()){
        $aMenuLinksExt[$i][0] = $res['NAME'];
        $aMenuLinksExt[$i][1] = str_replace(['#SITE_DIR#/', '#ELEMENT_ID#', '#ELEMENT_CODE#'], [SITE_DIR, $res['ID'], $res['CODE']], $res['DETAIL_PAGE_URL']);
        $i++;
    }
    $сache->endDataCache($aMenuLinksExt);
}
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>
