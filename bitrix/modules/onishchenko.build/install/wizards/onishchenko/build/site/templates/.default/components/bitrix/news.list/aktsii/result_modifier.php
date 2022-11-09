<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult['ITEMS'] as &$item){
    if($item['DATE_ACTIVE_FROM'] && $item['DATE_ACTIVE_TO']){
        $item['DATE_FROM'] = CIBlockFormatProperties::DateFormat('j M Y', MakeTimeStamp($item["DATE_ACTIVE_FROM"], CSite::GetDateFormat()));
        $item['DATE_TO'] = CIBlockFormatProperties::DateFormat('j M Y', MakeTimeStamp($item["DATE_ACTIVE_TO"], CSite::GetDateFormat()));
    }
}