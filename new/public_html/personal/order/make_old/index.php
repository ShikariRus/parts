<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>

    <div class="checkout">
        <div class="title-section">Оформление заказа</div>
        <div class="checkout-block">
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.order.ajax",
    "template",
    array(
        "PAY_FROM_ACCOUNT" => "Y",
        "COUNT_DELIVERY_TAX" => "N",
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
        "ALLOW_AUTO_REGISTER" => "Y",
        "SEND_NEW_USER_NOTIFY" => "Y",
        "DELIVERY_NO_AJAX" => "H",
        "TEMPLATE_LOCATION" => "popup",
        "PROP_1" => "",
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_PERSONAL" => "/personal/order/",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "PATH_TO_ORDER" => "/personal/order/make/",
        "SET_TITLE" => "Y",
        "SHOW_ACCOUNT_NUMBER" => "Y",
        "DELIVERY_NO_SESSION" => "Y",
        "COMPATIBLE_MODE" => "N",
        "BASKET_POSITION" => "after",
        "BASKET_IMAGES_SCALING" => "adaptive",
        "SERVICES_IMAGES_SCALING" => "adaptive",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "1",
        "USER_CONSENT_IS_CHECKED" => "N",
        "USER_CONSENT_IS_LOADED" => "N",
        "COMPONENT_TEMPLATE" => "template",
        "ALLOW_APPEND_ORDER" => "Y",
        "SHOW_NOT_CALCULATED_DELIVERIES" => "L",
        "SPOT_LOCATION_BY_GEOIP" => "Y",
        "DELIVERY_TO_PAYSYSTEM" => "d2p",
        "SHOW_VAT_PRICE" => "Y",
        "USE_PREPAYMENT" => "N",
        "USE_PRELOAD" => "Y",
        "ALLOW_USER_PROFILES" => "N",
        "ALLOW_NEW_PROFILE" => "N",
        "TEMPLATE_THEME" => "site",
        "SHOW_ORDER_BUTTON" => "final_step",
        "SHOW_TOTAL_ORDER_BUTTON" => "N",
        "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
        "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
        "SHOW_DELIVERY_LIST_NAMES" => "Y",
        "SHOW_DELIVERY_INFO_NAME" => "Y",
        "SHOW_DELIVERY_PARENT_NAMES" => "Y",
        "SHOW_STORES_IMAGES" => "Y",
        "SKIP_USELESS_BLOCK" => "Y",
        "SHOW_BASKET_HEADERS" => "N",
        "DELIVERY_FADE_EXTRA_SERVICES" => "N",
        "SHOW_COUPONS_BASKET" => "N",
        "SHOW_COUPONS_DELIVERY" => "N",
        "SHOW_COUPONS_PAY_SYSTEM" => "N",
        "SHOW_NEAREST_PICKUP" => "N",
        "DELIVERIES_PER_PAGE" => "9",
        "PAY_SYSTEMS_PER_PAGE" => "9",
        "PICKUPS_PER_PAGE" => "5",
        "SHOW_PICKUP_MAP" => "Y",
        "SHOW_MAP_IN_PROPS" => "N",
        "PICKUP_MAP_TYPE" => "yandex",
        "PROPS_FADE_LIST_1" => array(
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7",
        ),
        "PROPS_FADE_LIST_2" => array(
            0 => "8",
            1 => "12",
            2 => "13",
            3 => "14",
            4 => "19",
        ),
        "ACTION_VARIABLE" => "soa-action",
        "PATH_TO_AUTH" => "/auth/",
        "DISABLE_BASKET_REDIRECT" => "N",
        "USE_PHONE_NORMALIZATION" => "Y",
        "PRODUCT_COLUMNS_VISIBLE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "PROPS",
            2 => "PROPERTY_CML2_ARTICLE",
        ),
        "ADDITIONAL_PICT_PROP_4" => "-",
        "ADDITIONAL_PICT_PROP_8" => "-",
        "PRODUCT_COLUMNS_HIDDEN" => array(
        ),
        "USE_YM_GOALS" => "N",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_CUSTOM_MAIN_MESSAGES" => "N",
        "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
        "USE_CUSTOM_ERROR_MESSAGES" => "N"
    ),
    false
);?>
        <div class="block-title bold">Условия поставки</div>
        <div class="text">
                <p class="bold title">Оплатить Вы можете:</p>
                <p>1. По счету на физ. лицо (нужны Ваши полные паспортные данные и контактный телефон для отправки в Т.К.)</p>
                <p>2. По счету на юр. лицо (нужны реквизиты компании)</p>
                <p>3. Перевод на карточку Сбербанка (мы присылаем вам № карточки, Вы делаете на нее перевод и указываете Ваши полные паспортные данные и контактный телефон для отправки в Т.К.)</p>
                <br>
                <p class="bold title">После оплаты, получить детали Возможно:</p>
                <p><b>Самовывозом</b> в магазине (адрес на нашем сайте www.us-parts.ru , раздел контакты)</p>
                <p>Мы отправляем в регионы <b>через Транспортные Компании</b> на ваш выбор:</p>
                <p>(Пэк, Деловые Линии, Желдорэкпедиция, Кит, Даймекс, Прогресс)</p>
                <p>Доставка по Москве до ТК - Бесплатно. За доставку в Ваш город, Вы платите при получении груза по месту в
                    транспорной компании.</p>
                <p>При доставке клиенту с <b>EMS-почта России</b>.(услуги экспресс-доставки по России и в 190 стран мира)</p>
                <p>Стоимость заказа подорожает на сумму отправки, так как оплачивается нами сразу при отправке из Москвы!</p>
                <p>Точку Сбербанка (мы присылаем вам № карточки, Вы делаете на нее перевод и указываете Ваши полные паспортные данные и контактный телефон для отправки в Т.К.)</p>
            </div>
        </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>