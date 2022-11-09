<?php
use \Onishchenko\Build\Recaptcha,
    \Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Appointments extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        $arParams['EMAIL_TO'] = trim($arParams['EMAIL_TO']);
        if (!$arParams['IBLOCK_ID'] || $arParams['IBLOCK_ID'] == 0)
            echo GetMessage('ERROR_MESS');
        else
            $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        return $arParams;
    }

    private function addMessageIblock($name, $email = false, $service, $service_name, $phone)
    {
        if (Loader::includeModule("iblock")) {
            $el = new CIBlockElement;
            if($email)
                $PROP['EMAIL'] = $email;
            else
                $PROP['EMAIL'] = GetMessage('NO_EMAIL');

            $PROP['SERVICE'] = $service;
            $PROP['PHONE'] = $phone;
            $arAddElement = [
                "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
                "PROPERTY_VALUES"=> $PROP,
                "NAME" => $name,
                "ACTIVE" => "Y",
            ];

            if($PRODUCT_ID = $el->Add($arAddElement)){
                if($this->arParams['EMAIL_TO'])
                    $this->sendMail($name, $email, $service_name, $phone);
                return GetMessage('SUCCESS_MESSAGE');
            }
            else
                return GetMessage('ERROR_MESSAGE');

        }
        else {
            $this->abortResultCache();
            return;
        }
    }

    private function sendMail($name, $email, $service_name, $phone)
    {
        $arEventFields = [
            "AUTHOR_EMAIL" => $email,
            "AUTHOR_NAME" => $name,
            "PHONE" => $phone,
            "SERVICE_NAME" => $service_name,
            "EMAIL_TO" => $this->arParams['EMAIL_TO'],
        ];
        CEvent::Send("BUILD_APPOINTMENTS_FORM", SITE_ID, $arEventFields);
    }

    private function handlerData()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['name']));
        $email = ($_POST['email'])? htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['email'])): false;
        $service = (int) $_POST['service'];
        $phone = htmlspecialcharsbx($_POST['phone']);
        $service_name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['service_name']));
        $mess = $this->addMessageIblock($name, $email, $service, $service_name, $phone);
        $this->printMessage($mess);
    }

    private function checkGoogleAPI()
    {
        if(Recaptcha::checkGoogleAPI())
            $this->arResult['RECAPTCHA'] = 'Y';
        else
            $this->arResult['RECAPTCHA'] = 'N';
    }

    private function printMessage($message)
    {
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo $message;
        die();
    }

    public function executeComponent()
    {
        $this->checkGoogleAPI();
        if($_POST['ajax'] == 'APPOINTMENTS' && check_bitrix_sessid()) {
            if ($this->arResult['RECAPTCHA'] == 'N')
                $this->handlerData();
            else {
                if (Recaptcha::checkValidRecaptcha($_POST['recaptcha']))
                    $this->handlerData();
                else
                    $this->printMessage(GetMessage('RECAPTCHA_ERROR'));
            }
        }
        else
            $this->IncludeComponentTemplate();
    }
}