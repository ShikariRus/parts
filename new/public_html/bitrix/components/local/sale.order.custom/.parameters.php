<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 * */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if( !Loader::includeModule("iblock") ) {
    throw new \Exception('Не загружены модули необходимые для работы компонента');
}

$arComponentParameters = [
    "GROUPS" => [
        "SETTINGS" => [
            "NAME" => Loc::getMessage('ORDER_PROP_SETTINGS'),
            "SORT" => 550,
        ],
        "AJAX" => [
            "NAME" => Loc::getMessage('ORDER_PROP_AJAX'),
            "SORT" => 550,
        ],
    ],
    "PARAMETERS" => [
        'IS_AJAX' => [
            'PARENT' => 'AJAX',
            'NAME' => Loc::getMessage('ORDER_AJAX_PROP'),
            "TYPE" => "CHECKBOX",
            "MULTIPLE" => "N",
            'DEFAULT' => "N"
        ],
    ]
];