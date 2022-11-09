<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>
    <div class="theme-page padding-bottom-66">
        <div class="clearfix page-404 top-border">
            <div class="row margin-top-70">
                <div class="column column-1-1">
                    <h2>OOPS.</h2>
                    <h1>404</h1>
                    <p class="description align-center">Извините, данной страницы не существует.</p>
                </div>
            </div>
        </div>
    </div>
<?


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>