<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Staff extends CBitrixComponent
{

    public $arButtons;

    public function onPrepareComponentParams($arParams)
    {
        if(!$arParams['IBLOCK_ID'] || $arParams['IBLOCK_ID'] == 0)
            echo GetMessage('ERROR_MESS');
        else
            $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        if(!$arParams['CACHE_TIME'])
            $arParams['CACHE_TIME'] = 36000000;
        return $arParams;
    }

	private function setArResult()
    {
        $arFilter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'],'ACTIVE' => 'Y'];
        $arSelect = ['ID','IBLOCK_ID','NAME'];
        $r = CIBlockSection::GetList(["SORT"=>"ASC"],$arFilter,false,$arSelect);
        while($res = $r -> Fetch()){
            $this->arResult[] = $res;
        }
        $arFilter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'],'ACTIVE' => 'Y'];
        $arSelect = ['ID','IBLOCK_ID','NAME','PREVIEW_PICTURE','PREVIEW_TEXT','PROPERTY_EMAIL','IBLOCK_SECTION_ID'];
        $r = CIBlockElement::GetList(["SORT"=>"ASC"],$arFilter,false,false,$arSelect);
        $i = 0;
        while($res = $r -> Fetch()){
            $arElements[$i] = $res;
            $arElements[$i]['IMG'] = CFile::GetPath($res['PREVIEW_PICTURE']);
            $this -> arButtons = CIBlock::GetPanelButtons(
                $res["IBLOCK_ID"],
                $res["ID"],
                0,
                ["SECTION_BUTTONS"=>false, "SESSID"=>false]
            );
            $arElements[$i]["EDIT_LINK"] = $this -> arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arElements[$i]["DELETE_LINK"] = $this -> arButtons["edit"]["delete_element"]["ACTION_URL"];
            $i++;
        }
        foreach($this->arResult as $k1 => $v1) {
            foreach($arElements as $k2 => $v2) {
                if($arElements[$k2]['IBLOCK_SECTION_ID'] == $this->arResult[$k1]['ID'])
                    $this->arResult[$k1]['ITEMS'][] = $arElements[$k2];
            }
        }
	}

	public function executeComponent()
    {
        if ($this->StartResultCache()){
            if (!Bitrix\Main\Loader::includeModule("iblock")) {
                $this->abortResultCache();
                return;
            }
			$this->setArResult();
            $this->setResultCacheKeys([]);
            $this->IncludeComponentTemplate();
        }
	}
}