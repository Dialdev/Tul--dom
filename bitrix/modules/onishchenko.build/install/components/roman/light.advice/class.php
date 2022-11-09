<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class LightAdvice extends CBitrixComponent
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
		if(Bitrix\Main\Loader::includeModule("iblock")) {
            $arFilter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'],'ACTIVE' => 'Y'];
            $arSelect = ['ID','NAME','IBLOCK_ID','PREVIEW_TEXT'];
            $r = CIBlockElement::GetList([], $arFilter, false, false, $arSelect );
			while($res = $r -> Fetch()) {
				$this->arResult[] = $res;
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