<?$APPLICATION->IncludeComponent(
    "roman:call",
    ".default",
    array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "#IB_CALL_FORM#",
        "EMAIL_TO" => "#EMAIL#",
        "COMPONENT_TEMPLATE" => ".default",
    ),
    false
);
?>
<?if($jivosite_key = COption::GetOptionString("main", "jivosite_key", "")):?>
    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script>
        (function(){ var widget_id = '<?=$jivosite_key?>';var d=document;var w=window;function l(){
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>
    <!-- {/literal} END JIVOSITE CODE -->
<?endif;?>
