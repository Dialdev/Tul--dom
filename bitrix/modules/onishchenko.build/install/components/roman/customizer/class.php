<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Customizer extends CBitrixComponent
{

    private $defaultSettings = [
        'COLOR_1' => 'f5f5f5',
        'COLOR_2' => '333333',
        'COLOR_3' => '08a152',
        'COLOR_4' => '08a152',
        'FLY_SIDEBAR' => 'Y',
        'FLY_HEADER' => 'Y',
        'MAIN_PAGE_REVIEWS' => 'Y',
    ];

    private function getCssPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/roman/customizer/templates/.default/colors.css';
    }

    private function getTpl()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/roman/customizer/templates/.default/colors.tpl';
    }

    private function getSettingsPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . $this->__path . '/.settings.php';
    }

    private function getArResult()
    {
        if (file_exists($this->getSettingsPath()))
            $this->arResult = include_once $this->getSettingsPath();
        else
            $this->arResult = $this->defaultSettings;
        if ($_COOKIE['COLOR_1'] && $_COOKIE['COLOR_2'] && $_COOKIE['COLOR_3'] && $_COOKIE['COLOR_4']) {
            $this->arResult['COLOR_1'] = $_COOKIE['COLOR_1'];
            $this->arResult['COLOR_2'] = $_COOKIE['COLOR_2'];
            $this->arResult['COLOR_3'] = $_COOKIE['COLOR_3'];
            $this->arResult['COLOR_4'] = $_COOKIE['COLOR_4'];
            $this->arResult['TMP_COLORS'] = true;
        }
        if ($_COOKIE['FLY_SIDEBAR']) {
            $this->arResult['FLY_SIDEBAR'] = $_COOKIE['FLY_SIDEBAR'];
        }
        if ($_COOKIE['FLY_HEADER']) {
            $this->arResult['FLY_HEADER'] = $_COOKIE['FLY_HEADER'];
        }
        if ($_COOKIE['MAIN_PAGE_REVIEWS']) {
            $this->arResult['MAIN_PAGE_REVIEWS'] = $_COOKIE['MAIN_PAGE_REVIEWS'];
        }
        if($GLOBALS['USER']->isAdmin()) {
            $this->arResult['ADMIN'] = true;
        }

    }

    private function setSettings()
    {
        $colors = [
            $_POST['COLOR_1'],
            $_POST['COLOR_2'],
            $_POST['COLOR_3'],
            $_POST['COLOR_4'],
        ];

        $others = [
            $_POST['FLY_SIDEBAR'],
            $_POST['FLY_HEADER'],
            $_POST['MAIN_PAGE_REVIEWS'],
        ];

        if ($this->checkValid($colors, $others)) {
            if ($this->saveCss()) {
                $this->arResult['COLOR_1'] = $_POST['COLOR_1'];
                $this->arResult['COLOR_2'] = $_POST['COLOR_2'];
                $this->arResult['COLOR_3'] = $_POST['COLOR_3'];
                $this->arResult['COLOR_4'] = $_POST['COLOR_4'];
                $this->arResult['FLY_SIDEBAR'] = $_POST['FLY_SIDEBAR'];
                $this->arResult['FLY_HEADER'] = $_POST['FLY_HEADER'];
                $this->arResult['MAIN_PAGE_REVIEWS'] = $_POST['MAIN_PAGE_REVIEWS'];
                $this->saveSettings();
            }
        }
    }

    private function setDefaultSettings(){
        unlink($this->getCssPath());
        unlink($this->getSettingsPath());
    }

    private function checkValid($colors, $others)
    {
        foreach ($colors as $value) {
            if (!preg_match('/[a-z0-9]{3,6}/i', $value)) {
                return false;
            }
        }
        foreach ($others as $value) {
            if (!preg_match('/[YN]{1}/', $value)) {
                return false;
            }
        }
        return true;
    }

    private function saveSettings()
    {
        $settings = <<<"EOD"
        <?php
            return [
                'COLOR_1' => '{$this->arResult['COLOR_1']}',
                'COLOR_2' => '{$this->arResult['COLOR_2']}',
                'COLOR_3' => '{$this->arResult['COLOR_3']}',
                'COLOR_4' => '{$this->arResult['COLOR_4']}',
                'FLY_SIDEBAR' => '{$this->arResult['FLY_SIDEBAR']}',
                'FLY_HEADER' => '{$this->arResult['FLY_HEADER']}',
                'MAIN_PAGE_REVIEWS' => '{$this->arResult['MAIN_PAGE_REVIEWS']}',
            ];
EOD;
        file_put_contents($this->getSettingsPath(), $settings);
    }

    private function saveCss()
    {

        $search = [
            '#COLOR_1#',
            '#COLOR_2#',
            '#COLOR_3#',
            '#COLOR_4#'
        ];

        $replace = [
            '#' . $_POST['COLOR_1'],
            '#' . $_POST['COLOR_2'],
            '#' . $_POST['COLOR_3'],
            '#' . $_POST['COLOR_4']
        ];

        $subject = file_get_contents($this->getTpl());
        $new_css = str_ireplace($search, $replace, $subject);
        if ($new_css) {
            return file_put_contents($this->getCssPath(), $new_css);
        }
        return false;
    }

    public function executeComponent()
    {
        $this->getArResult();
        if ($_POST['ajax'] == 'CUSTOMIZER' && check_bitrix_sessid()) {
            if ($_POST['action'] == 'SAVE' && $GLOBALS['USER']->isAdmin()) {
                $this->setSettings();
            }
            elseif ($_POST['action'] == 'DEFAULT') {
                setcookie("COLOR_1", ' ', time() - 1000, '/');
                setcookie("COLOR_2", ' ', time() - 1000, '/');
                setcookie("COLOR_3", ' ', time() - 1000, '/');
                setcookie("COLOR_4", ' ', time() - 1000, '/');
                setcookie("FLY_SIDEBAR", ' ', time() - 1000, '/');
                setcookie("FLY_HEADER", ' ', time() - 1000, '/');
                setcookie("MAIN_PAGE_REVIEWS", ' ', time() - 1000, '/');
                if($GLOBALS['USER']->isAdmin()){
                    $this->setDefaultSettings();
                }
            }
        }
        else {
            $this->IncludeComponentTemplate();
        }
    }
}