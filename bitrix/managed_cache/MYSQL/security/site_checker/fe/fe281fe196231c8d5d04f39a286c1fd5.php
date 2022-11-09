<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001655715076';
$dateexpire = '001658307076';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:2:{s:7:"results";a:11:{i:0;a:5:{s:5:"title";s:128:"Уровень безопасности административной группы не является повышенным";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:182:"Пониженный уровень безопасности административной группы может значительно помочь злоумышленнику";s:14:"recommendation";s:337:"Ужесточить <a href="/bitrix/admin/group_edit.php?ID=1&tabControl_active_tab=edit2"  target="_blank">политики безопасности административной</a> группы или выбрать предопределенную настройку уровня безопасности "Повышенный".";s:15:"additional_info";s:0:"";}i:1;a:5:{s:5:"title";s:102:"Пароль к БД не содержит спецсимволов(знаков препинания)";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:138:"Пароль слишком прост, что повышает риск взлома учетной записи в базе данных";s:14:"recommendation";s:57:"Добавить спецсимволов в пароль";s:15:"additional_info";s:0:"";}i:2;a:5:{s:5:"title";s:291:"Обнаружено как минимум 1 файлов или директорий с доступом на запись для всех пользователей окружения в котором работает веб-сервер (не пользователей Bitrix Framework)";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:275:"Право на запись у всех системных пользователей может служить причиной полной компрометации ресурса, путем модификации исходного кода вашего проекта";s:14:"recommendation";s:119:"Необходимо отобрать лишние права у всех системных пользователей";s:15:"additional_info";s:66:"Последние 1 файлов/директорий:<br>/bitrix";}i:3;a:5:{s:5:"title";s:142:"Директория хранения файлов сессий доступна для всех системных пользователей";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:180:"Это может позволить читать/изменять сессионные данные, через скрипты других виртуальных серверов";s:14:"recommendation";s:265:"Корректно настроить файловые права или сменить директорию хранения либо включить хранение сессий в БД: <a href="/bitrix/admin/security_session.php">Защита сессий</a>";s:15:"additional_info";s:110:"Директория хранения сессий: /var/www/u0004063/data/bin-tmp/<br>
Права: drwxrwxrwx";}i:4;a:5:{s:5:"title";s:148:"Предположительно в директории хранения сессий находятся сессии других проектов";s:8:"critical";s:5:"HIGHT";s:6:"detail";s:180:"Это может позволить читать/изменять сессионные данные, через скрипты других виртуальных серверов";s:14:"recommendation";s:192:"Сменить директорию хранения либо включить хранение сессий в БД: <a href="/bitrix/admin/security_session.php">Защита сессий</a>";s:15:"additional_info";s:355:"Причина: файл сессии не содержит подписи текущего сайта<br>
Файл: /var/www/u0004063/data/bin-tmp//sess_68accf6b16b1dac371f6673b1e3efade<br>
Подпись текущего сайта: 599b00c4f6bf579fa0711de55102273b<br>
Содержимое файла: <pre>modx.session.created.time|i:1608048704;</pre>";}i:5;a:5:{s:5:"title";s:113:"Разрешено отображение сайта во фрейме с произвольного домена";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:307:"Запрет отображения фреймов сайта со сторонних доменов способен предотвратить целый класс атак, таких как <a href="https://www.owasp.org/index.php/Clickjacking" target="_blank">Clickjacking</a>, Framesniffing и т.д.";s:14:"recommendation";s:1875:"Скорее всего, вам будет достаточно разрешения на просмотр сайта в фреймах только на страницах текущего сайта.
Сделать это достаточно просто, достаточно добавить заголовок ответа "X-Frame-Options: SAMEORIGIN" в конфигурации вашего frontend-сервера.
</p><p>В случае использования nginx:<br>
1. Найти секцию server, отвечающую за обработку запросов нужного сайта. Зачастую это файлы в /etc/nginx/site-enabled/*.conf<br>
2. Добавить строку:
<pre>
add_header X-Frame-Options SAMEORIGIN;
</pre>
3. Перезапустить nginx<br>
Подробнее об этой директиве можно прочесть в документации к nginx: <a href="http://nginx.org/ru/docs/http/ngx_http_headers_module.html" target="_blank">Модуль ngx_http_headers_module</a>
</p><p>В случае использования Apache:<br>
1. Найти конфигурационный файл для вашего сайта, зачастую это файлы /etc/apache2/httpd.conf, /etc/apache2/vhost.d/*.conf<br>
2. Добавить строки:
<pre>
&lt;IfModule headers_module&gt;
	Header set X-Frame-Options SAMEORIGIN
&lt;/IfModule&gt;
</pre>
3. Перезапустить Apache<br>
4. Убедиться, что он корректно обрабатывается Apache и этот заголовок никто не переопределяет<br>
Подробнее об этой директиве можно прочесть в документации к Apache: <a href="http://httpd.apache.org/docs/2.2/mod/mod_headers.html" target="_blank">Apache Module mod_headers</a>
</p>";s:15:"additional_info";s:2427:"Адрес: <a href="https://tuldom.ru/" target="_blank">https://tuldom.ru/</a><br>Запрос/Ответ: <pre>GET / HTTP/1.1
user-agent: BitrixCloud BitrixSecurityScanner/Robin-Scooter
accept: */*
host: tuldom.ru

HTTP/1.1 200 OK
Server: nginx
Date: Tue, 15 Dec 2020 16:13:38 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.2.14
P3P: policyref=&quot;/bitrix/p3p.xml&quot;, CP=&quot;NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA&quot;
X-Powered-CMS: Bitrix Site Manager (5d08d43793f923be450e6afd48a0bec0)
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate
Pragma: no-cache
Content-Encoding: none
Set-Cookie: PHPSESSID=0ceb0281dfbea8e852441c006c363372; path=/; HttpOnly
Set-Cookie: BITRIX_SM_SALE_UID=66692bfb07d55f14b62f8e8166986381; expires=Fri, 10-Dec-2021 16:13:38 GMT; Max-Age=31104000; path=/

&lt;!DOCTYPE html&gt;
&lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot; xml:lang=&quot;ru&quot; lang=&quot;ru&quot;  &gt;
&lt;head&gt;
	&lt;title&gt;Купить строительные материалы в Туле - Tuldom.ru&lt;/title&gt;
	&lt;meta name=&quot;viewport&quot; content=&quot;initial-scale=1.0, width=device-width&quot; /&gt;
	&lt;meta name=&quot;HandheldFriendly&quot; content=&quot;true&quot; /&gt;
	&lt;meta name=&quot;yes&quot; content=&quot;yes&quot; /&gt;
	&lt;meta name=&quot;apple-mobile-web-app-status-bar-style&quot; content=&quot;black&quot; /&gt;
	&lt;meta name=&quot;SKYPE_TOOLBAR&quot; content=&quot;SKYPE_TOOLBAR_PARSER_COMPATIBLE&quot; /&gt;
	&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot; /&gt;
&lt;meta name=&quot;keywords&quot; content=&quot;Строительные материалы купить&quot; /&gt;
&lt;meta name=&quot;description&quot; content=&quot;Магазин строительных материалов в Туле&quot; /&gt;
&lt;link href=&quot;/bitrix/js/main/core/css/core.min.css?15756125092854&quot; rel=&quot;stylesheet&quot; /&gt;

&lt;link href=&quot;/bitrix/cache/css/s1/aspro_max/template_12d0b6b169ecc9f7606bbaf78f869c78/template_12d0b6b169ecc9f7606bbaf78f869c78_v1.css?16080475211266197&quot;  data-template-style=&quot;true&quot; rel=&quot;stylesheet&quot; /&gt;
&lt;script&gt;if(!window.BX)window.BX={};if(!window.BX.message)windo
----------Only 1Kb of body shown----------<pre>";}i:6;a:5:{s:5:"title";s:68:"Разрешено чтение файлов по URL (URL wrappers)";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:256:"Если эта, сомнительная, возможность PHP не требуется - рекомендуется отключить, т.к. она может стать отправной точкой для различного типа атак";s:14:"recommendation";s:89:"Необходимо в настройках php указать:<br>allow_url_fopen = Off";s:15:"additional_info";s:0:"";}i:7;a:5:{s:5:"title";s:110:"Установлен не корректный порядок формирования массива _REQUEST";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:392:"Зачастую в массив _REQUEST нет необходимости добавлять любые переменные, кроме массивов _GET и _POST. В противном случае это может привести к раскрытию информации о пользователе/сайте и иным не предсказуемым последствиям.";s:14:"recommendation";s:88:"Необходимо в настройках php указать:<br>request_order = "GP"";s:15:"additional_info";s:75:"Текущее значение: ""<br>Рекомендованное: "GP"";}i:8;a:5:{s:5:"title";s:119:"Временные файлы хранятся в пределах корневой директории проекта";s:8:"critical";s:6:"MIDDLE";s:6:"detail";s:271:"Хранение временных файлов, создаваемых при использовании CTempFile, в пределах корневой директории проекта не рекомендовано и несет с собой ряд рисков.";s:14:"recommendation";s:883:"Необходимо определить константу "BX_TEMPORARY_FILES_DIRECTORY" в "bitrix/php_interface/dbconn.php" с указанием необходимого пути.<br>
Выполните следующие шаги:<br>
1. Выберите директорию вне корня проекта. Например, это может быть "/home/bitrix/tmp/www"<br>
2. Создайте ее. Для этого выполните следующую комманду:
<pre>
mkdir -p -m 700 /полный/путь/к/директории
</pre>
3. В файле "bitrix/php_interface/dbconn.php" определите соответствующую константу, чтобы система начала использовать эту директорию:
<pre>
define("BX_TEMPORARY_FILES_DIRECTORY", "/полный/путь/к/директории");
</pre>";s:15:"additional_info";s:84:"Текущая директория: /var/www/u0004063/data/www/tuldom.ru/upload/tmp";}i:9;a:5:{s:5:"title";s:44:"Включен Automatic MIME Type Detection";s:8:"critical";s:3:"LOW";s:6:"detail";s:248:"По умолчанию в Internet Explorer/FlashPlayer включен автоматический mime-сниффинг, что может служить источником XSS нападения или раскрытия информации.";s:14:"recommendation";s:1752:"Скорее всего, вам не нужна эта функция, поэтому её можно безболезненно отключить, добавив заголовок ответа "X-Content-Type-Options: nosniff" в конфигурации вашего веб-сервера.
</p><p>В случае использования nginx:<br>
1. Найти секцию server, отвечающую за обработку запросов нужного сайта. Зачастую это файлы в /etc/nginx/site-enabled/*.conf<br>
2. Добавить строку:
<pre>
add_header X-Content-Type-Options nosniff;
</pre>
3. Перезапустить nginx<br>
Подробнее об этой директиве можно прочесть в документации к nginx: <a href="http://nginx.org/ru/docs/http/ngx_http_headers_module.html" target="_blank">Модуль ngx_http_headers_module</a>
</p><p>В случае использования Apache:<br>
1. Найти конфигурационный файл для вашего сайта, зачастую это файлы /etc/apache2/httpd.conf, /etc/apache2/vhost.d/*.conf<br>
2. Добавить строки:
<pre>
&lt;IfModule headers_module&gt;
	Header set X-Content-Type-Options nosniff
&lt;/IfModule&gt;
</pre>
3. Перезапустить Apache<br>
4. Убедиться, что он корректно обрабатывается Apache и этот заголовок никто не переопределяет<br>
Подробнее об этой директиве можно прочесть в документации к Apache: <a href="http://httpd.apache.org/docs/2.2/mod/mod_headers.html" target="_blank">Apache Module mod_headers</a>
</p>";s:15:"additional_info";s:1898:"Адрес: <a href="https://tuldom.ru/bitrix/js/main/core/core.js?rnd=0.05921189770383972" target="_blank">https://tuldom.ru/bitrix/js/main/core/core.js?rnd=0.05921189770383972</a><br>Запрос/Ответ: <pre>GET /bitrix/js/main/core/core.js?rnd=0.05921189770383972 HTTP/1.1
user-agent: BitrixCloud BitrixSecurityScanner/Robin-Scooter
accept: */*
host: tuldom.ru

HTTP/1.1 200 OK
Server: nginx
Date: Tue, 15 Dec 2020 16:13:45 GMT
Content-Type: application/javascript
Content-Length: 549323
Last-Modified: Tue, 15 Dec 2020 15:49:10 GMT
Connection: keep-alive
Vary: Accept-Encoding
ETag: &quot;5fd8daf6-861cb&quot;
Expires: Tue, 22 Dec 2020 16:13:45 GMT
Cache-Control: max-age=604800
Accept-Ranges: bytes

;(function() {

	if (typeof window.BX === \'function\')
	{
		return;
	}

/**
 * Babel external helpers
 * (c) 2018 Babel
 * @license MIT
 */
(function (global) {
  var babelHelpers = global.babelHelpers = {};

  function _typeof(obj) {
    if (typeof Symbol === &quot;function&quot; &amp;&amp; typeof Symbol.iterator === &quot;symbol&quot;) {
      babelHelpers.typeof = _typeof = function (obj) {
        return typeof obj;
      };
    } else {
      babelHelpers.typeof = _typeof = function (obj) {
        return obj &amp;&amp; typeof Symbol === &quot;function&quot; &amp;&amp; obj.constructor === Symbol &amp;&amp; obj !== Symbol.prototype ? &quot;symbol&quot; : typeof obj;
      };
    }

    return _typeof(obj);
  }

  babelHelpers.typeof = _typeof;
  var REACT_ELEMENT_TYPE;

  function _createRawReactElement(type, props, key, children) {
    if (!REACT_ELEMENT_TYPE) {
      REACT_ELEMENT_TYPE = typeof Symbol === &quot;function&quot; &amp;&amp; Symbol.for &amp;&amp; Symbol.for(&quot;react.element&quot;) || 0xeac7;
    }

    var defaultProps = type &amp;&amp; type.defaultProps;
    var childrenLength = arguments.length - 3;


----------Only 1Kb of body shown----------<pre>";}i:10;a:5:{s:5:"title";s:38:"Включен вывод ошибок";s:8:"critical";s:3:"LOW";s:6:"detail";s:202:"Вывод ошибок предназначен для разработки и тестовых стендов, он не должен использоваться на конечном ресурсе.";s:14:"recommendation";s:88:"Необходимо в настройках php указать:<br>display_errors = Off";s:15:"additional_info";s:0:"";}}s:9:"test_date";s:10:"15.12.2020";}}';
return true;
?>