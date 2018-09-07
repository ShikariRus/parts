<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $PRODUCT_ID = intval($_POST['id']);
    $QUANTITY = intval($_POST['quantity']);
    Add2BasketByProductID($PRODUCT_ID, $QUANTITY);
}else{
    echo 'parameter lost';
}
    $APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "",
    array(
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_PERSONAL" => "/personal/",
        "SHOW_PERSONAL_LINK" => "N",
    ),
    false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>