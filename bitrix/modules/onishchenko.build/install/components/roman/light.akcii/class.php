<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class LightAkcii extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        if(!$arParams['IBLOCK_ID'] || $arParams['IBLOCK_ID'] == 0)
            echo GetMessage('ERROR_MESS');
        else
            $arParams['IBLOCK_ID'] = (int) $arParams['IBLOCK_ID'];
        if(!$arParams['CACHE_TIME'])
            $arParams['CACHE_TIME'] = 36000000;
        return $arParams;
    }

	private function setArResult()
    {
		if(Bitrix\Main\Loader::includeModule("iblock")){
            $arFilter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'],'ACTIVE' => 'Y','ACTIVE_DATE' => 'Y'];
            $arSelect = ['ID','IBLOCK_ID','NAME','PREVIEW_TEXT','DATE_ACTIVE_FROM','DATE_ACTIVE_TO'];
            $r = CIBlockElement::GetList([],$arFilter,false,false,$arSelect);
            $i = 0;
            while($res = $r -> Fetch()) {
				$this->arResult[$i] = $res;
				if($res["DATE_ACTIVE_FROM"] && $res["DATE_ACTIVE_TO"]) {
                    $this->arResult[$i]['DATE_FROM'] = CIBlockFormatProperties::DateFormat('j M Y', MakeTimeStamp($res["DATE_ACTIVE_FROM"], CSite::GetDateFormat()));
                    $this->arResult[$i]['DATE_TO'] = CIBlockFormatProperties::DateFormat('j M Y', MakeTimeStamp($res["DATE_ACTIVE_TO"], CSite::GetDateFormat()));
                }
				$i++;
			}
		}
	}

	public function executeComponent()
    {
        if ($this->StartResultCache()){
			$this->setArResult();
            $this->IncludeComponentTemplate();
        }
	}
}