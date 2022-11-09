<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if(empty($arResult))
	return "";
$strReturn = '';
$strReturn .= '<div class="bread-crumb-container"><ul class="bread-crumb">';
$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++){
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' ' : '');
	$arrow = ($index > 0? '<li class="separator">></li>' : '');
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1){
		$strReturn .= $arrow.'<li>
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" >
					'.$title.'
				</a></li>';
	}
	else{
		$strReturn .= $arrow.'<li>'.$title.'</li>';
	}
}
$strReturn .= '</ul></div>';
return $strReturn;

