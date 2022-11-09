<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$for_right_table = array(
    $arResult['PROPERTIES']['PLOSHCHAD'],
    $arResult['PROPERTIES']['COUNT_ROOMS'],
    $arResult['PROPERTIES']['FLOORS'],
    $arResult['PROPERTIES']['ATTIC'],
    $arResult['PROPERTIES']['GARAGE'],
    $arResult['PROPERTIES']['ROOF'],
    $arResult['PROPERTIES']['TILT_ROOF'],
    $arResult['PROPERTIES']['WALL'],
);
$arResult['FOR_RIGHT_TABLE'] = array_combine(
    array_column($for_right_table,'NAME') ,
    array_column($for_right_table,'VALUE')
);

$this->__component->SetResultCacheKeys(array('DISPLAY_PROPERTIES'));