<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<!--  Content zone  -->
<!-- Catalog list -->
<div class="product product-page">
<!--    <pre>-->
<!--        --><?// var_dump($arResult); ?>
<!--    </pre>-->
    <div class="top-row">
        <div class="title-section"><?=$name?></div>
        <div class="product-article">Артикул: <span class="light"><?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span></div>
    </div>
    <? if ($arResult['CATALOG_QUANTITY'] > 10){ ?>
        <div class="product-stock in-stock">В наличии</div>
    <? }else if ($arResult['CATALOG_QUANTITY'] <= 10 && $arResult['CATALOG_QUANTITY'] > 0 ){ ?>
        <div class="product-stock low-quantity">Меньше 10</div>
    <? }else{ ?>
        <div class="product-stock out-of-stock">Нет в наличии</div>
    <? }?>
    <div class="product-item">
        <div class="left-block">
            <div class="row">
                <div class="product-image">
                    <div class="wrapper">
                        <img data-image="<?=$arResult['DETAIL_PICTURE']['SRC']?>" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$name?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="center-block">
            <div class="product-info">
                <p class="info-title"><b>Информация о детали:</b></p>
                <ul>
                    <?
                    $attr = [];
                    foreach ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $key_n => $attr_name){
                        $attr[$key_n]['NAME'] = $attr_name;
                    } foreach ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['DESCRIPTION'] as $key_d => $attr_desc){
                        $attr[$key_d]['DESC'] = $attr_desc;
                    }
                    ?>
                    <? foreach ($attr as $attr_item){ ?>
                        <li><?=$attr_item['NAME']?> - <?=$attr_item['DESC']?></li>
                    <? } ?>
                </ul>
                <p class="info-title"><b>Комментарий:</b></p>
                <p class="product-comment"><?=$arResult['PROPERTIES']['CML2_COMMENT']['VALUE']?></p>
            </div>
        </div>
        <div class="right-block">
            <?
            $price = number_format($arResult['ITEM_PRICES'][0]['PRICE'], 2, '.', ' ');
            ?>
            <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="add_form">
                <input type="hidden" name="price" class="price-add-to-cart" value="<?=$item['ITEM_PRICES'][0]['PRICE']?>">
                <input type="hidden" name="id" value="<?=$arResult["ID"]?>">
                <div class="product-price"><span class="price" data-price="<?=$arResult['ITEM_PRICES'][0]['PRICE']?>"><?=$price?></span> руб.</div>
                <div class="product-quantity"><span>Кол-во:</span><button type="button" class="quantity-change quantity-minus deactivated"><i class="fa fa-minus" aria-hidden="true"></i></button><input data-max-quantity="<?=$item['CATALOG_QUANTITY']?>" type="text" name="quantity" class="input-product-quantity" value="1"><button type="button" class="quantity-change quantity-plus"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
                <div class="product-cart"><button type="submit" class="btn small"><i class="fa fa-shopping-cart" aria-hidden="true"></i>В корзину</button></div>
            </form>
        </div>
    </div>
    <div class="related-products product-block">
        <div class="title-block">Похожие товары</div>
        <div class="product-grid">
            <div class="row">
                <div class="product-item">
                    <div class="image">
                        <a href="/product-item.php" target="_blank">
                            <img src="./assets/images/product/product-2.png" width="180" height="180" alt="cart-product-item-1">
                        </a>
                    </div>
                    <div class="product-meta">
                        <a href="/product-item.php" target="_blank">
                            <p class="product-name">MINTEX MDB2026</p>
                            <p class="product-price bold">1 177.97 руб.</p>
                        </a>
                    </div>
                </div>
                <div class="product-item">
                    <div class="image">
                        <a href="/product-item.php" target="_blank">
                            <img src="./assets/images/product/product-3.png" width="180" height="180" alt="cart-product-item-2">
                        </a>
                    </div>
                    <div class="product-meta">
                        <a href="/product-item.php" target="_blank">
                            <p class="product-name">MINTEX MDB1613</p>
                            <p class="product-price bold">1 244.56 руб.</p>
                        </a>
                    </div>
                </div>
                <div class="product-item">
                    <div class="image">
                        <a href="/product-item.php" target="_blank">
                            <img src="./assets/images/product/product-4.png" width="180" height="180" alt="cart-product-item-3">
                        </a>
                    </div>
                    <div class="product-meta">
                        <a href="/product-item.php" target="_blank">
                            <p class="product-name">MINTEX MDB1945</p>
                            <p class="product-price bold">1 256.94 руб.</p>
                        </a>
                    </div>
                </div>
                <div class="product-item">
                    <div class="image">
                        <a href="/product-item.php" target="_blank">
                            <img src="./assets/images/product/product-5.png" width="180" height="180" alt="cart-product-item-4">
                        </a>
                    </div>
                    <div class="product-meta">
                        <a href="/product-item.php" target="_blank">
                            <p class="product-name">MINTEX MD582</p>
                            <p class="product-price bold">1 534.49 руб.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.related-products').css({'transition' : '200ms','margin-top' : $('.product-comment').height()+35+'px' });

        $('.quantity-minus').on('click', function () {
            var $input = $(this).parent('.product-quantity').find('input');
            var quantity = $input.val();
            var $row = $(this).parents('.product-item');
            if (quantity > 1){
                $input.val(parseInt(quantity) - 1);
            }
            if ($input.val() <= 1){
                $(this).addClass('deactivated');
            }
            changePrice($input.val(), $row);
        });
        $('.quantity-plus').on('click', function () {
            var $input = $(this).parent('.product-quantity').find('input');
            var quantity = $input.val();
            var $row = $(this).parents('.product-item');
            $input.val(parseInt(quantity) + 1);
            if ($input.val() > 1){
                $(this).parent('.product-quantity').find('.quantity-minus').removeClass('deactivated');
            }
            changePrice($input.val(), $row);
        });
        $('.input-product-quantity').on('change input', function () {
            var $input = $(this);
            var $row = $(this).parents('.product-item');
            if ($input.val() > 1){
                $(this).parent('.product-quantity').find('.quantity-minus').removeClass('deactivated');
            }else if ($input.val() == 1){
                $(this).parent('.product-quantity').find('.quantity-minus').addClass('deactivated');
            }else if ($input.val() == 0){
                $input.val(1);
            }
            changePrice($input.val(), $row);
        });
        function changePrice(quantity, $target) {
            var price_one = $target.find('.product-price span.price').attr('data-price');
            price_one = price_one.replace(' ', '');
            var price_new = parseFloat(price_one) * parseFloat(quantity);
            $target.find('.product-price span.price').animate({ 'num': price_new }, {
                duration: 100,
                step: function (price_new){
                    $('.price-add-to-cart').val(price_new);
                    price_new = price_new.toFixed(2);
                    price_new = String(price_new).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');
                    $(this).text(price_new);
                }
            });
        }
        $('.product-image .wrapper').on('click', function () {
            var image = $(this).find('img').attr('data-image');
            $('<div  class="img-to-view"><i class="fa fa-times close" aria-hidden="true"></i><img src="'+image+'" /></div>').appendTo($('body'));
            setTimeout(function () {
                $('.overlay, .img-to-view').toggleClass('active');
            }, 10);
        });
        $('.overlay').on('click', function () {
            $('.overlay, .img-to-view').toggleClass('active');
            setTimeout(function () {
                $('.img-to-view').remove();
            }, 200);
        });
        $('body').on('click', '.img-to-view .close', function () {
            $('.overlay, .img-to-view').toggleClass('active');
            setTimeout(function () {
                $('.img-to-view').remove();
            }, 200);
        });
        BX.ready(function(){
            var options = {
                url: '/catalog/add2basket.php?RND='+Math.random()+'&ajax_basket=Y',
                type: "POST",
                target: '.basket-container',
                complete: function(responseText) {
                    $('[data-popup="added-to-cart"]').toggleClass('active');
                }
            };
            $(".add_form").ajaxForm(options);
        });
    });
</script>
