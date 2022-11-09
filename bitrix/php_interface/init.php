<?php
 AddEventHandler("sale", "OnOrderNewSendEmail", "ModifySaleMails");
 
 function ModifySaleMails($orderID, &$eventName, &$arFields)
 {
    $arOrder = CSaleOrder::GetByID($orderID);  
 
    $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);  
 
    $phone = ""; 
    $address = "";
 
    while ($arProps = $order_props->Fetch()){    
      if ($arProps["CODE"] == "PHONE"){
          $phone = htmlspecialchars($arProps["VALUE"]);}
 
      if ($arProps["CODE"] == "ADDRESS"){
         $address = htmlspecialchars($arProps["VALUE"]);}
    }
 
  if (!empty($arOrder["USER_DESCRIPTION"])){
      $arFields["DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];}
 
    //-- добавляем новые поля в массив результатов
    $arFields["PHONE"] =  $phone;
    $arFields["ADDRESS"] = $address;
 }


AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));  
class CMainHandlers {
  public static function OnEpilogHandler() {
      if (isset($_GET['PAGEN_1']) && intval($_GET['PAGEN_1'])>0) {
        $title = $GLOBALS['APPLICATION']->GetTitle();
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' - Cтраница '.intval($_GET['PAGEN_1']));

          $desc = $GLOBALS['APPLICATION']->GetProperty('description');
          $GLOBALS['APPLICATION']->SetPageProperty('description', $desc.' - Cтраница '.intval($_GET['PAGEN_1']));

     }
      if (isset($_GET['PAGEN_2']) && intval($_GET['PAGEN_2'])>0) {
        $title = $GLOBALS['APPLICATION']->GetTitle();
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.' - Cтраница '.intval($_GET['PAGEN_2']));

          $desc = $GLOBALS['APPLICATION']->GetProperty('description');
          $GLOBALS['APPLICATION']->SetPageProperty('description', $desc.' - Cтраница '.intval($_GET['PAGEN_2']));

     }
  }
}