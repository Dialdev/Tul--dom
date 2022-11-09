<?
//Отключаем статистику Bitrix
define("NO_KEEP_STATISTIC", true);
//Подключаем движок
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//устанавливаем тип ответа как xml документ
header('Content-Type: application/xml; charset=utf-8');


$array_pages = array();

//Простые текстовые страницы: начало
$array_pages[] = array(
   	'NAME' => 'Главная',
   	'URL' => '/',
);
$array_pages[] = array(
   	'NAME' => 'Каталог',
   	'URL' => '/catalog/',
);
$array_pages[] = array(
   	'NAME' => 'Акции',
   	'URL' => '/sale/',
);
$array_pages[] = array(
   	'NAME' => 'Услуги',
   	'URL' => '/services/',
);
$array_pages[] = array(
	'NAME' => 'Блог',
   	'URL' => '/blog/',
);
$array_pages[] = array(
   	'NAME' => 'Как купить',
   	'URL' => '/help/',
);
$array_pages[] = array(
   	'NAME' => 'Компания',
   	'URL' => '/company/',
);
$array_pages[] = array(
   	'NAME' => 'Контакты',
   	'URL' => '/contacts/',
);
$array_pages[] = array(
	'NAME' => 'Плитные материалы для строительства',
   	'URL' => '/catalog/plitnye_materialy/',
);
$array_pages[] = array(
   	'NAME' => 'Цемент и смеси',
   	'URL' => '/catalog/zement_i_smesi/',
);
$array_pages[] = array(
   	'NAME' => 'Вологодский северный лес',
   	'URL' => 'https://tula.vosl.ru/',
);
$array_pages[] = array(
   	'NAME' => 'Австрийское редприятие ТАМАК',
   	'URL' => 'https://profbuildgroup.ru/',
);


//Простые текстовые страницы: конец


$array_iblocks_id = array('24', '13', '113', '21', '19', '23', '22'); //ID инфоблоков, разделы и элементы которых попадут в карту сайта
if(CModule::IncludeModule("iblock"))
{
	foreach($array_iblocks_id as $iblock_id)
	{
		//Список разделов
   		$res = CIBlockSection::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE" => "Y"
	      	),
      		false,
    		array(
    		"ID",
    		"NAME",
    		"SECTION_PAGE_URL",
    		"TIMESTAMP_X"
    	));
   		while($ob = $res->GetNext())
   		{
			$array_pages_iblock[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $ob['SECTION_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X']
			);
   		}
		//Список элементов
   		$res = CIBlockElement::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE_DATE" => "Y",
	         	"ACTIVE" => "Y"
	      	),
      		false,
      		false,
    		array(
    		"ID",
    		"NAME",
    		"DETAIL_PAGE_URL",
    		"TIMESTAMP_X"
    	));
   		while($ob = $res->GetNext())
   		{
			$array_pages_iblock[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $ob['DETAIL_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X']
			);
   		}
	}
}

//Создаём XML документ: начало
$xml_content = '';
$xml_content_iblock = '';
$dateformat = 'Y-m-d';
if($_SERVER['HTTP_X_FORWARDED_PROTO']=='https' ) {
	$site_url = 'https://'.$_SERVER['HTTP_HOST'];	
} else {
	$site_url = 'http://'.$_SERVER['HTTP_HOST'];	
}
$quantity_elements = 0;
foreach($array_pages as $v){
	$quantity_elements++;
	if ($quantity_elements == 1){
		$priority = 1;
	} else {
		$priority = 0.6;
	}
	if ($quantity_elements == 2) {
		$priority = 0.8;
	}
	if ($quantity_elements == 3) {
		$priority = 0.8;
	}
	if ($quantity_elements == 4) {
		$priority = 0.8;
	}
	if ($quantity_elements == 5) {
		$priority = 0.8;
	}
	if ($quantity_elements == 6) {
		$priority = 0.8;
	}
	if ($quantity_elements == 7) {
		$priority = 0.8;
	}
	if ($quantity_elements == 8) {
		$priority = 0.8;
	}
	if ($quantity_elements == 9) {
		$priority = 0.8;
	}
	if ($quantity_elements == 10) {
		$priority = 0.8;
	}
	if ($quantity_elements == 11) {
		$priority = 0.8;
	}
	if ($quantity_elements == 12) {
		$priority = 0.8;
	}
	
	$page_url = mb_substr( $v['URL']."index.php", 1);
	$lastmod = date($dateformat, filemtime($page_url));
	$month = "monthly";
	$xml_content.='<url>
		<loc>'.$site_url.$v['URL'].'</loc>
		<lastmod>'.$lastmod.'</lastmod>
		<changefreq>'.$month.'</changefreq>
		<priority>'.$priority.'</priority>
	</url>
	';
}
foreach($array_pages_iblock as $v){
	$quantity_elements++;
	$priority = 0.6;
	$lastmod = date($dateformat, MakeTimeStamp($v['LASTMOD'], "DD.MM.YYYY"));
	$xml_content_iblock.='<url>
		<loc>'.$site_url.$v['URL'].'</loc>
		<lastmod>'.$lastmod.'</lastmod>
		<priority>'.$priority.'</priority>
		
	</url>
	';
}
$quantity_elements = 0;

//Создаём XML документ: конец

//Выводим документ
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	'.$xml_content.''.$xml_content_iblock.'
</urlset>
';
?>
