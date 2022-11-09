<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class VK_comments extends CBitrixComponent
{

    public function executeComponent()
    {
        Bitrix\Main\Page\Asset::getInstance()->addJs("https://vk.com/js/api/openapi.js?147");
		$this->IncludeComponentTemplate();
	}
}