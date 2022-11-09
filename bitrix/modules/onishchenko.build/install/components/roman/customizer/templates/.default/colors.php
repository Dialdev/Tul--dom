<?php

$color1 = ($_POST['COLOR_1']) ? $_POST['COLOR_1'] : $_COOKIE['COLOR_1'];
$color2 = ($_POST['COLOR_2']) ? $_POST['COLOR_2'] : $_COOKIE['COLOR_2'];
$color3 = ($_POST['COLOR_3']) ? $_POST['COLOR_3'] : $_COOKIE['COLOR_3'];
$color4 = ($_POST['COLOR_4']) ? $_POST['COLOR_4'] : $_COOKIE['COLOR_4'];

if($color1 && $color2 && $color3 && $color4){

    function cssGenerate($colors){
        $subject =  file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/roman/customizer/templates/.default/colors.tpl');
        $new_css =  str_ireplace(['#COLOR_1#','#COLOR_2#','#COLOR_3#','#COLOR_4#'], $colors, $subject);
        if($new_css){
            saveSessionColors($colors);
            header('Content-type: text/css;');
            echo $new_css;
        }
    }

    function saveSessionColors($colors){
        setcookie("COLOR_1", trim($colors[0],'#'),0,'/');
        setcookie("COLOR_2", trim($colors[1],'#'),0,'/');
        setcookie("COLOR_3", trim($colors[2],'#'),0,'/');
        setcookie("COLOR_4", trim($colors[3],'#'),0,'/');
    }

    function checkColor(array $colors){
        foreach($colors as &$value){
            if(!preg_match('/[a-z0-9]{3,6}/i', $value)) {
                return false;
            }
            else{
                $value = '#' . $value;
            }
        }
        cssGenerate($colors);
    }
    checkColor([$color1, $color2, $color3, $color4]);
}