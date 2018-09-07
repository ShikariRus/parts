<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
if (!$compositeStub) { ?>
    <?
    CModule::IncludeModule("sale");
    CModule::IncludeModule("currency");
    $arItems = GetBasketList();
    $num_prodcts = 0;
    $quantity=0;
    for ($i = 0; $i<count($arItems); $i++)
    {
        $num_prodcts++;
        $quantity =$quantity+$arItems[$i]["QUANTITY"];
    }
    ?>
    <a href="<?=$arParams['PATH_TO_BASKET']?>">
        <i class="fa fa-shopping-cart" aria-hidden="true">
            <? if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($quantity > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) { ?>
                <span class="count"><?=$quantity?></span>
            <? } ?>
        </i>
    </a>
<? } ?>