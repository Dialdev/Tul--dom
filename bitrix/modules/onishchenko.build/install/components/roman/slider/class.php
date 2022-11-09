<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class MainSlider extends CBitrixComponent
{

    public $arButtons;

    public function onPrepareComponentParams($arParams)
    {
        if (!$arParams['IBLOCK_ID'] || $arParams['IBLOCK_ID'] == 0)
            echo GetMessage('ERROR_MESS');
        else
            $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        if (!$arParams['CACHE_TIME'])
            $arParams['CACHE_TIME'] = 36000000;
        return $arParams;
    }

    private function setArResult()
    {
        $arFilter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'];
        $arSelect = [
            'ID',
            'IBLOCK_ID',
            'NAME',
            'PREVIEW_PICTURE',
            'PROPERTY_LINK_BUTTON',
            'PROPERTY_MAIN_TEXT',
            'PROPERTY_POSITION_X',
            'PROPERTY_POSITION_Y',
            'PROPERTY_TEXT_COLOR',
            'PROPERTY_ZAGOLOVOK_COLOR',
            'PROPERTY_TEXT_SHADOW',
        ];
        $r = CIBlockElement::GetList(["SORT" => "ASC"], $arFilter, false, false, $arSelect);
        $i = 0;
        while ($res = $r->Fetch()) {
            $this->arResult[$i] = $res;
            $this->arResult[$i]['SRC'] = CFile::GetPath($res['PREVIEW_PICTURE']);
            $this->arButtons = CIBlock::GetPanelButtons(
                $res["IBLOCK_ID"],
                $res["ID"],
                0,
                ["SECTION_BUTTONS" => false, "SESSID" => false]
            );
            $this->arResult[$i]["EDIT_LINK"] = $this->arButtons["edit"]["edit_element"]["ACTION_URL"];
            $this->arResult[$i]["DELETE_LINK"] = $this->arButtons["edit"]["delete_element"]["ACTION_URL"];
            $i++;
        }

    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
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