<?

$citadel_xpsupdateclient_default_option = array(
    'USE_RESTFUL_API' => 'Y',
    'PATH_RESTFUL_API' => '/citadel.xpsupdateclient/',
    'USE_ACCESS_CONTROL_ALLOW_ORIGIN_FILTER' => "N",
    'WHITE_LIST_DOMAIN_ACCESS_CONTROL_ALLOW_ORIGIN' => "*",
    'USE_LOG' => "N",
    'LOG_PATH' => '',
    'TOKEN_KEYWORD' => '',
    'HTTP_CLIENT' => function_exists("curl_version") && is_array(curl_version()) ? 'curl' : 'http',
);
