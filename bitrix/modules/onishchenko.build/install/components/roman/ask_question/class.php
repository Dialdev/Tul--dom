<?php
use \Onishchenko\Build\Recaptcha,
    \Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Question extends CBitrixComponent
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

    private function addMessageIblock($arAddElement)
    {
        $arAddElement['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $arAddElement['ACTIVE'] = 'Y';

        if (Loader::includeModule("iblock")) {
            $el = new CIBlockElement;
            return  $el->Add($arAddElement);
        }
    }

    private function sendMail($arEventFields, $eventName)
    {
        CEvent::Send($eventName, SITE_ID, $arEventFields);
    }

    private function faqEvent()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['name']));
        $message = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['message']));
        $email = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['email']));
        $subject = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['subject']));
        $arAddElement = [
            'NAME' => $name,
            'PREVIEW_TEXT' => $message,
            'PROPERTY_VALUES' => [
                'EMAIL' => $email,
                'SUBJECT' => $subject,
            ]
        ];

        if($this->addMessageIblock($arAddElement)) {
            if($this->arParams['EMAIL_TO']) {
                $arEventFields = [
                    'AUTHOR_NAME' => $name,
                    'AUTHOR_EMAIL' => $email,
                    'MESSAGE' => $message,
                    'SUBJECT' => $subject,
                    'EMAIL_TO' => $this->arParams['EMAIL_TO']
                ];
                $this->sendMail($arEventFields, 'BUILD_FAQ');
            }
            $this->printMessage(GetMessage('SUCCESS_MESSAGE'));
        }
        else
            $this->printMessage(GetMessage('ERROR_MESSAGE'));
    }

    private function staffEvent()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['name']));
        $message = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['message']));
        $email = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['email']));
        $subject = GetMessage('SUBJECT_STAFF');

        $arAddElement = [
            'NAME' => $name,
            'PREVIEW_TEXT' => $message,
            'PROPERTY_VALUES' => [
                'EMAIL' => $email,
                'SUBJECT' => $subject,
                'STAFF' => (int) $_POST['staff'],
            ]
        ];

        if($this->addMessageIblock($arAddElement)) {
            if($this->arParams['EMAIL_TO']) {
                $arEventFields = [
                    'AUTHOR_NAME' => $name,
                    'AUTHOR_EMAIL' => $email,
                    'MESSAGE' => $message,
                    'STAFF' => htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['staff_name'])),
                    'EMAIL_TO' => $this->arParams['EMAIL_TO']
                ];
                $this->sendMail($arEventFields, 'BUILD_STAFF_QUESTION');
            }
            $this->printMessage(GetMessage('SUCCESS_MESSAGE'));
        }
        else
            $this->printMessage(GetMessage('ERROR_MESSAGE'));
    }

    private function buildEvent()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['name']));
        $message = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['message']));
        $email = ($_POST['email'])? htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['email'])) : GetMessage('NO_EMAIL');
        $subject = GetMessage('SUBJECT_BUILD') . htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['build_name']));
        $phone = htmlspecialcharsbx($_POST['phone']);

        $arAddElement = [
            'NAME' => $name,
            'PREVIEW_TEXT' => $message,
            'PROPERTY_VALUES' => [
                'EMAIL' => $email,
                'SUBJECT' => $subject,
                'BUILD' => (int) $_POST['build'],
                'PHONE' => $phone,
            ]
        ];

        if($this->addMessageIblock($arAddElement)) {
            if($this->arParams['EMAIL_TO']) {
                $arEventFields = [
                    'AUTHOR_NAME' => $name,
                    'AUTHOR_EMAIL' => $email,
                    'PHONE' => $phone,
                    'MESSAGE' => $message,
                    'BUILD' => htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['build_name'])),
                    'EMAIL_TO' => $this->arParams['EMAIL_TO']
                ];
                $this->sendMail($arEventFields, 'BUILD_QUESTION');
            }
            $this->printMessage(GetMessage('SUCCESS_MESSAGE'));
        }
        else
            $this->printMessage(GetMessage('ERROR_MESSAGE'));
    }

    private function handlerData()
    {
        switch ($_POST['action']){
            case 'faq_question':
                $this->faqEvent();
                break;
            case 'staff_question':
                $this->staffEvent();
                break;
            case 'build_question':
                $this->buildEvent();
                break;
        }
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
        if($_POST['ajax'] == 'QUESTION' && check_bitrix_sessid()) {
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