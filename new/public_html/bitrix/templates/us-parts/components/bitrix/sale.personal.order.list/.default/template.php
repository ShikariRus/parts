<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__); ?>
<!--  Content zone  -->
<!-- Orders item -->
<div class="orders">
<? if (!empty($arResult['ERRORS']['FATAL'])) {
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

} else {
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS'])) {

	}
	?>

	<?
	if (!count($arResult['ORDERS'])) { ?>
		<div class="row col-md-12 col-sm-12">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">
				<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
			</a>
		</div>
		<? }else {
		$paymentChangeData = array();
		$orderHeaderStatus = null; ?>
        <div class="product-table">
        <div class="table-head">
            <div class="table-cell">Мои заказы</div>
        </div>
            <div class="table-body">
                <? foreach ($arResult['ORDERS'] as $key => $order) { ?>
                    <? foreach ($order['BASKET_ITEMS'] as $bk_item){ ?>
                        <?
                            $prop = CIBlockElement::GetByID($bk_item['PRODUCT_ID'])->GetNextElement()->GetProperties();
                            $product = CIBlockElement::GetByID($bk_item['PRODUCT_ID'])->GetNextElement();
                            $category = CIBlockSection::GetByID($product->fields['IBLOCK_SECTION_ID'])->GetNext();
                            $image = CFile::GetPath($product->fields["PREVIEW_PICTURE"]);
                        ?>
                        <div class="table-row">
                            <div class="table-body-cell product-image">
                                <a href="<?=$bk_item['DETAIL_PAGE_URL']?>" target="_blank">
                                    <img src="<?=$image?>" alt="break-1">
                                </a>
                            </div>
                            <div class="table-body-cell product-name"><a class="name" href="<?=$bk_item['DETAIL_PAGE_URL']?>" target="_blank"><?=$bk_item['NAME']?> <?=$category['NAME']?></a> <p class="product-article">Артикул: <span class="light"><?=$prop['CML2_ARTICLE']['VALUE']?></span></p></div>
                            <div class="table-body-cell product-quantity">
                                <p class="light">Кол-во:</p>
                                <p class="quantity"><?=$bk_item['QUANTITY']?> <?= !empty($MEASURE_NAME) ? $MEASURE_NAME : "шт."?></p>
                            </div>
                            <div class="table-body-cell product-price">
                                <p class="price"><b><?=$bk_item['PRICE'] * $bk_item['QUANTITY']?></b> руб.</p>
                                <?
                                    $delivery_time = $prop['CML2_DELIVERY_DATE']['VALUE'];
                                ?>
                                <p class="product-delivery">Доставка <?=$delivery_time?></p>
                            </div>
                        </div>
                    <? } ?>
                    <div class="table-row footer-row">
                        <div class="table-body-cell product-image"></div>
                        <div class="table-body-cell product-name"></div>
                        <div class="table-body-cell product-quantity"></div>
                        <div class="table-body-cell product-price">
                            <? if (!empty($order['ORDER']['PRICE_DELIVERY'])) { ?>
                                <? $delivery_price = number_format($order['ORDER']['PRICE_DELIVERY'], 2, '.', ' '); ?>
                                <p>Стоимость доставки: <?=$delivery_price?> руб.</p>
                            <? } ?>
                            <p>Итого <?=$order['ORDER']['FORMATED_PRICE']?></p>
                        </div>
                    </div>
                <?} ?>
            </div>
        </div>
        <? } ?>
	<? echo $arResult["NAV_STRING"]; ?>
</div>
	<? if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
?>
