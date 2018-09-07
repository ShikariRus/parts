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
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH' => $arParams['COMPARE_PATH'],
	'COMPARE_NAME' => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS' => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
	'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL' => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
	'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
	'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
?>
<? if (isset($_GET['ID'])){ ?>
<div class="product-grid">
    <div class="row">
    <? if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) { ?>
        <? $areaIds = array();
        foreach ($arResult['ITEMS'] as $item) {?>
            <div class="product-item">
                <div class="image">
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_blank">
                        <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" width="180" height="180" alt="<?=$item['NAME']?>">
                    </a>
                </div>
                <div class="product-meta">
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_blank">
                        <p class="product-name"><?=$item['NAME']?></p>
                        <? $price = number_format($item['ITEM_PRICES'][0]['PRICE'], 2, '.', ' '); ?>
                        <p class="product-price bold"><?=$price?> руб.</p>
                    </a>
                </div>
            </div>
        <? }
    } ?>
    </div>
</div>
<?}else{?>
    <div class="product-list">
    <? if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) { ?>
        <? $areaIds = array();

        foreach ($arResult['ITEMS'] as $item) {
            $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
            $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
            $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
            ?>
            <div class="product-item">
                <?
                    $mark_item = '';
                    if (!$_GET['marka']) {
                        $mark_item = explode('|', $item['PROPERTIES']['PODKHODIMOST']['VALUE'][0])[0];
                    }else{
                        $mark_item = $_GET['marka'];
                    }
                ?>
                <div class="product-title"><b><?=$item['NAME']?></b> <span class="mark light" style="text-transform: uppercase">(<?=$mark_item?>)</span></div>
                <div class="row">
                    <div class="left-block">
                        <div class="row">
                            <div class="product-image">
                                <div class="wrapper">
                                    <img data-image="<?=$item['DETAIL_PICTURE']['SRC']?>" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="product image">
                                </div>
                            </div>
                            <div class="product-info">
                                <p class="info-title"><b>Информация о детали:</b></p>
                                <ul>
                                    <?
                                    $attr = [];
                                    foreach ($item['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $key_n => $attr_name){
                                        $attr[$key_n]['NAME'] = $attr_name;
                                    } foreach ($item['PROPERTIES']['CML2_ATTRIBUTES']['DESCRIPTION'] as $key_d => $attr_desc){
                                        $attr[$key_d]['DESC'] = $attr_desc;
                                    }
                                    ?>
                                    <? foreach ($attr as $attr_item){ ?>
                                        <li><?=$attr_item['NAME']?> - <span class="light"><?=$attr_item['DESC']?></span></li>
                                    <? } ?>
                                </ul>
                                <a class="btn transparent small blue" href="<?=$item['DETAIL_PAGE_URL']?>&marka=<?=$_GET['marka']?>&model=<?=$_GET['model']?>&year=<?=$_GET['year']?>&SECTION_ID=<?=$_GET['SECTION_ID']?>">Смотреть всю информацию</a>
                            </div>
                        </div>
                    </div>
                    <div class="right-block">
                        <? if ($item['CATALOG_QUANTITY'] > 10){ ?>
                            <div class="product-stock in-stock">В наличии</div>
                        <? }else if ($item['CATALOG_QUANTITY'] <= 10 && $item['CATALOG_QUANTITY'] > 0 ){ ?>
                            <div class="product-stock low-quantity">Меньше 10</div>
                        <? }else{ ?>
                            <div class="product-stock out-of-stock">Нет в наличии</div>
                        <? }?>
                        <?
                        $price = number_format($item['ITEM_PRICES'][0]['PRICE'], 2, '.', ' ');
                        ?>
                        <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="add_form">
                            <div class="product-article">Артикул: <span class="light"><?=$item['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span></div>
                            <? if (!empty($item['PROPERTIES']['CML2_DELIVERY_DATE']['VALUE'])){ ?>
                                <div class="product-delivery">Срок доставки: <span class="light"><?=$item['PROPERTIES']['CML2_DELIVERY_DATE']['VALUE']?></span></div>
                            <? } ?>
                            <? if ($price != 0){ ?>
                                <div class="product-price"><span class="price" data-price="<?=$item['ITEM_PRICES'][0]['PRICE']?>"><?=$price?></span> руб.</div>
                            <? } ?>
                            <input type="hidden" name="price" class="price-add-to-cart" value="<?=$item['ITEM_PRICES'][0]['PRICE']?>">
                            <input type="hidden" name="id" value="<?=$item["ID"]?>">
                            <? if ($item['CATALOG_QUANTITY'] > 0){ ?>
                                <div class="product-quantity"><span>Кол-во:</span><button type="button" class="quantity-change quantity-minus deactivated"><i class="fa fa-minus" aria-hidden="true"></i></button><input data-max-quantity="<?=$item['CATALOG_QUANTITY']?>" type="text" name="quantity" class="input-product-quantity" value="1"><button type="button" class="quantity-change quantity-plus"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
                                <div class="product-cart"><button type="submit" class="btn small"><i class="fa fa-shopping-cart" aria-hidden="true"></i>В корзину</button></div>
                            <? } ?>
                        </form>
                        <button class="btn small blue mobile-more"><a href="<?=$item['DETAIL_PAGE_URL']?>&marka=<?=$_GET['marka']?>&model=<?=$_GET['model']?>&year=<?=$_GET['year']?>&SECTION_ID=<?=$_GET['SECTION_ID']?>">Подробнее</a></button>
                    </div>
                </div>
            </div>
        <? }
        ?>
        <? foreach ($arResult['ITEM_ROWS'] as $rowData) { ?>

        <? } ?>
    <? }else{ ?>
        <? if (isset($_GET['code']) || isset($_GET['marka'])) { ?>
            <p>Поиск не дал результатов</p>
        <? } ?>
    <? } ?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
    <script>
        $(function () {
            $('.quantity-minus').on('click', function () {
                var $input = $(this).parent('.product-quantity').find('input');
                var quantity = $input.val();
                var $row = $(this).parents('.product-item');
                if (quantity > 1){
                    $input.val(parseInt(quantity) - 1);
                }
                if ($input.val() == 1){
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
    </script>
</div>
<? } ?>

<? $signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER')?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});
	var <?=$obName?> = new JCCatalogSectionComponent({
		siteId: '<?=$component->getSiteId()?>',
		componentPath: '<?=CUtil::JSEscape($componentPath)?>',
		navParams: <?=CUtil::PhpToJSObject($navParams)?>,
		deferredLoad: false, // enable it for deferred load
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
		lazyLoad: !!'<?=$showLazyLoad?>',
		loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
		template: '<?=CUtil::JSEscape($signedTemplate)?>',
		ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
		parameters: '<?=CUtil::JSEscape($signedParams)?>',
		container: '<?=$containerName?>'
	});
</script>