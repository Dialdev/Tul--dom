<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div id="vk_comments"></div>
<script type="text/javascript">
    VK.init({
        apiId:  <?=intval($arParams['KEY'])?>,
        onlyWidgets: true
    });
    VK.Widgets.Comments(
        'vk_comments'
    );
</script>




