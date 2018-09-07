<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
    <div class="table-footer" data-entity="basket-checkout-aligner">
        <div class="table-row">
            <div class="left-block">
                <button type="button" class="btn transparent red small clear-cart">Очистить корзину</button>
<!--                onclick="--><?//CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());?><!--"-->
            </div>
            <div class="right-block">
                <div class="agreement">Делая заказ, вы даёте свое согласие на обработку персональных данных <br>
                    в соответствии с <a href="#">Условиями</a>, а также с <a href="#">Условием продажи</a>
                </div>
                <div class="btn-block">
                    <button type="button" class="btn small checkout" data-entity="basket-checkout-button" {{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}><?=Loc::getMessage('SBB_ORDER')?></button>
                    <button type="button" class="btn transparent small blue return-to-shop" onclick="window.location = '/catalog'">Продолжить покупки</button>
                </div>
                <div class="total-price-cart">
                    <p>Всего, без учёта доставки:</p>
                    <p class="bold"><span class="price-total-all" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span></p>
                </div>
            </div>
        </div>
    </div>
	<div data-entity="basket-checkout-aligner">
		<? if ($arParams['HIDE_COUPON'] !== 'Y')
		{
			?>
			<div class="basket-coupon-section">
				<div class="basket-coupon-block-field">
					<div class="basket-coupon-block-field-description">
						<?=Loc::getMessage('SBB_COUPON_ENTER')?>:
					</div>
					<div class="form">
						<div class="form-group" style="position: relative;">
							<input type="text" class="form-control" id="" placeholder="" data-entity="basket-coupon-input">
							<span class="basket-coupon-block-coupon-btn"></span>
						</div>
					</div>
				</div>
			</div>
			<?
		} ?>
		<? if ($arParams['HIDE_COUPON'] !== 'Y') { ?>
			<div class="basket-coupon-alert-section">
				<div class="basket-coupon-alert-inner">
					{{#COUPON_LIST}}
					<div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{{DISCOUNT_NAME}}}){{/DISCOUNT_NAME}}
						</span>
						<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
						</span>
					</div>
					{{/COUPON_LIST}}
				</div>
			</div>
		<? } ?>
	</div>
</script>