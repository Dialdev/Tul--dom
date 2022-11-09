<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прайс-лист");
?>
	<div class="clearfix">
		<div class="row" style="overflow-x: auto;">
         <h4  style="margin-bottom: 20px;">Цены на проектирование</h4>
         <table>
            <thead>
               <tr>
                  <th width="10%">№</th>
                  <th width="70%">Наименование</th>
                  <th width="5%">Ед.изм.</th>
                  <th width="15%">Цена(ед.)</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Эскизный проект</td>
                  <td>кв/м</td>
                  <td>570 руб. </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Архитектурный проект</td>
                  <td>кв/м</td>
                  <td>560 руб.</td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Конструктивный проект</td>
                  <td>кв/м</td>
                  <td>750 руб.</td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Проект по внутреннему электроснабжению дома</td>
                  <td>кв/м</td>
                  <td>124 руб.</td>
               </tr>
               <tr>
                  <td>5</td>
                  <td>Проект отопления дома (ОВ)</td>
                  <td>кв/м</td>
                  <td>295 руб.</td>
               </tr>
               <tr>
                  <td>6</td>
                  <td>Проект естественной вентиляции дома</td>
                  <td>кв/м</td>
                  <td>240 руб.</td>
               </tr>
               <tr>
                  <td>7</td>
                  <td>Проект по внутреннему водоснабжению и канализации дома (ВК</td>
                  <td>кв/м</td>
                  <td>190 руб.</td>
               </tr>
            </tbody>
         </table>
         <h4  style="margin-bottom: 20px;margin-top:20px;">Цены на строительство</h4>
         <table>
            <thead>
               <tr>
                  <th width="10%">№</th>
                  <th width="70%">Наименование</th>
                  <th width="5%">Ед.изм.</th>
                  <th width="15%">Цена(ед.)</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Строительство "коробки" с внутренними перегородками, без строительного материала</td>
                  <td><span class="square">м<sup style="font-size: 10px;">2</sup></span></td>
                  <td>7400 руб.</td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Строительство "коробки" с внутренними перегородками, включая строительный материал</td>
                  <td><span class="square">м<sup style="font-size: 10px;">2</sup></span></td>
                  <td>7900 руб.</td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Отделочные внутренние работы с материалами Эконом класс</td>
                  <td><span class="square">м<sup style="font-size: 10px;">2</sup></span></td>
                  <td>7850 руб.</td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Отделочные внутренние работы с материалами Бизнес класс</td>
                  <td><span class="square">м<sup style="font-size: 10px;">2</sup></span></td>
                  <td>9990 руб.</td>
               </tr>
            </tbody>
         </table>
         <h4  style="margin-bottom: 20px;margin-top: 20px;">Цена на строительные материалы</h4>
         <table>
            <thead>
            <tr>
               <th width="10%">№</th>
               <th width="70%">Наименование</th>
               <th width="5%">Ед.изм.</th>
               <th width="15%">Цена(ед.)</th>
            </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Оцилиндрованное бревно 300х300</td>
                  <td>м.пог.</td>
                  <td>1400 руб.</td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Оцилиндрованное бревно 370х370</td>
                  <td>м.пог.</td>
                  <td>1900 руб.</td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Клееный брус 200*400</td>
                  <td>м.пог.</td>
                  <td>1100 руб.</td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Отделочные внутренние работы с материалами Бизнес класс</td>
                  <td>м.пог.</td>
                  <td>8400 руб.</td>
               </tr>
            </tbody>
         </table>
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>