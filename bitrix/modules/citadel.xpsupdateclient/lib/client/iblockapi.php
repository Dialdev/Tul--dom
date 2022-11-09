<?

namespace Citadel\XpsUpdateClient\Client;


use Bitrix\Main\Diag\Debug;
use Citadel\XpsUpdateClient;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);


class IblockApi extends Api\Api
{

    function __construct($url)
    {
        parent::__construct($url);
    }


    public function getIblockTypes()
    {
        return $this->query('GET', '/iblock.types/');
    }


    public function getIblockItems()
    {
        return $this->query('GET', '/iblock.items/');
    }


    public function getIblockProperties()
    {
        return $this->query('GET', '/iblock.properties/');
    }


    public static function getElementsByClient($client_id)
    {
        $oIblockElement = new \CIBlockElement();

        $aIbloks = XpsUpdateClient\Client\Iblock::getIblocks();
        $aClient = XpsUpdateClient\Table\ClientTable::getById($client_id)->fetch();

        $api =  new self($aClient['SERVER_URL']);
        $api->setTokenAuthorization($aClient['SERVER_KEY']);

        $aElements = [];

        $aFilter = [
            "IBLOCK_ID" => $aClient['CLIENT_IBLOCK_ID'],
            "ACTIVE" => "Y",
        ];

        $aProps = [
            "ID",
        ];

        $aKeyProperty = $aIbloks['IBLOCKS'][$aClient['CLIENT_IBLOCK_ID']]['PROPERTIES'][$aClient['CLIENT_IBLOCK_KEY_ID']];

        $aProps[] = $aKeyProperty['PROPERTY_IS_FIELD'] ? $aKeyProperty['CODE'] : "PROPERTY_" . $aKeyProperty['CODE'];

        $rsElements = $oIblockElement->GetList(
            [],
            $aFilter,
            false,
            false,
            $aProps
        );

        while ($aElement = $rsElements->GetNext())
        {
            $ar = [
                'ID' => $aElement['ID']
            ];

            $ar[$aClient['SERVER_IBLOCK_KEY_ID']] = $aKeyProperty['PROPERTY_IS_FIELD'] ? $aElement[$aKeyProperty['CODE']] : $aElement['PROPERTY_' . $aKeyProperty['CODE'] . '_VALUE'];

            $aElements[$ar['ID']] = $ar;
        }

        $aClient['ELEMENTS'] = array_values($aElements);

        $aResponse = $api->query('POST', '/iblock.elements/', json_encode($aClient, JSON_UNESCAPED_UNICODE));

        $updatedCount = 0;

        //Debug::dump($aResponse);

        foreach ($aResponse as $aServerElement)
        {
            if (isset($aElements[$aServerElement['~CLIENT_IBLOCK_ID']]))
            {
                $aElementValues = [];
                $aElementPropertyValues = [];
                $tmFiles = [];

                foreach ($aClient['PROPERTIES_JSON']['CLIENT'] as $propertyKey => $clientPropertyId)
                {
                    $aClientProperty = $aIbloks['IBLOCKS'][$aClient['CLIENT_IBLOCK_ID']]['PROPERTIES'][$clientPropertyId];
                    $serverPropertyValue = $aServerElement[$aClient['PROPERTIES_JSON']['SERVER'][$propertyKey]];

                    $serverPropertyValue = isset($serverPropertyValue['TEXT']) ? $serverPropertyValue['TEXT'] : $serverPropertyValue;

                    if ($aClientProperty['PROPERTY_TYPE'] == 'F' && $serverPropertyValue['SRC'])
                    {
                        $tmpFileContent = file_get_contents($serverPropertyValue['SRC']);

                        if ($tmpFileContent !== false)
                        {
                            $tmpFilePath = Application::getDocumentRoot() . '/upload/tmp/' . $serverPropertyValue['NAME'];
                            $tmpFileSize = file_put_contents($tmpFilePath, $tmpFileContent);

                            if ($tmpFileSize !== false)
                            {
                                $aFile = \CFile::MakeFileArray($tmpFilePath);

                                if ($aClientProperty['PROPERTY_IS_FIELD'])
                                {
                                    $aFile['del'] = "Y";
                                    $aFile['description'] = $serverPropertyValue['DESCRIPTION'];
                                    $serverPropertyValue = $aFile;
                                }
                                else
                                {
                                    $serverPropertyValue = [
                                        'VALUE' => $aFile,
                                        'DESCRIPTION' => $serverPropertyValue['DESCRIPTION']
                                    ];
                                }

                                $tmFiles[] = $tmpFilePath;
                            }
                            else
                            {
                                continue;
                            }
                        }
                    }

                    if ($aClientProperty['PROPERTY_IS_FIELD'])
                    {
                        $aElementValues[$aClientProperty['CODE']] = $serverPropertyValue;
                    }
                    else
                    {
                        $aElementPropertyValues[$aClientProperty['ID']] = $serverPropertyValue;
                    }
                }

                $oIblockElement->Update($aServerElement['~CLIENT_IBLOCK_ID'], $aElementValues);
                \CIBlockElement::SetPropertyValuesEx($aServerElement['~CLIENT_IBLOCK_ID'], $aClient['CLIENT_IBLOCK_ID'], $aElementPropertyValues);

                foreach ($tmFiles as $fileName)
                {
                    @unlink($fileName);
                }

//                Debug::dump($aElementValues);
//                Debug::dump($aElementPropertyValues);

                $updatedCount++;
            }
        }

        return $updatedCount;
    }

}