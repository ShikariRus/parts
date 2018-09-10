<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var SaleOrderCustom $component */

$hideDelivery = empty($arResult['DELIVERY']);
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
var_dump($arParams['PATH_TO_PERSONAL']);
?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">
    <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
    <input type="hidden" name="location_type" value="code">
    <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
    <div id="bx-soa-main-notifications">
        <div class="alert alert-danger" style="display:none"></div>
        <div data-type="informer" style="display:none"></div>
    </div>
    <div class="block-head">Шаг 1 из 5. <b>Введите данные</b></div>
    <div class="block-body">
        <label class="form-label">Контактное лицо:</label>
        <div class="row">
            <input type="text" id="checkout-name" class="form-input half-width" name="NAME" value="<?=$arUser['NAME']?>" placeholder="Имя" required>
            <input type="text" id="checkout-surname" class="form-input half-width" name="LAST_NAME" value="<?=$arUser['LAST_NAME']?>" placeholder="Фамилия" required>
        </div>
        <div class="row">
            <input type="text" id="checkout-email" class="form-input half-width" name="EMAIL" value="<?=$arUser['EMAIL']?>" placeholder="Адрес эллектронной почты" required>
            <input type="text" id="checkout-telephone" class="form-input half-width" name="PHONE" value="<?=$arUser['PERSONAL_PHONE']?>" placeholder="Телефон" required>
        </div>

        <label class="form-label">Адрес доставки:</label>
        <div class="row">
            <input type="text" id="checkout-address" class="form-input full-width end-block" name="ADDRESS" value="<?=$arUser['UF_ADDRESS']?>" placeholder="пример: г.Москва Дмитровское шоссе 102к2с3" required>
        </div>
    </div>
    <div class="block-head">Шаг 2 из 5. <b>Выберите способ достаки</b></div>
    <div class="block-body">
        <div class="row">
            <?
            if (empty($arUser['UF_DELIVERY'])){
                $del_arr = $arResult['DELIVERY'];
                $arUser['UF_DELIVERY'] = array_shift($del_arr)['NAME'];
            }
            ?>
            <? foreach ($component->getAvailableDeliveries() as $delivery){ ?>
                <pre>
                    <? var_dump($delivery); ?>
                </pre>
                <div class="delivery-item">
                    <div class="row">
                        <div class="delivery-icon">
                            <img src="<?=$delivery['LOGOTIP']['SRC']?>" alt="<?=$delivery['NAME']?>">
                        </div>
                        <div class="delivery-description">
                            <div class="form-radio">
                                <label for="checkout-delivery_<?=$delivery['ID']?>"><input <?=$arUser['UF_DELIVERY'] == $delivery['NAME'] ? 'checked' : ''; ?> type="radio" id="checkout-delivery_<?=$delivery['ID']?>" name="DELIVERY_ID" value="<?=$delivery['ID']?>"><?=$delivery['NAME']?></label>
                            </div>
                            <div class="text">
                                <p><?=$delivery['DESCRIPTION']?></p>
                                <? if (isset($delivery['PERIOD_TEXT'])){ ?>
                                    <p><b>Сроки:</b> <?=$delivery['PERIOD_TEXT']?></p>
                                <? } ?>
                                <? if ($delivery['PRICE'] != 0){ ?>
                                    <p><b>Стоимость:</b> <?=$delivery['PRICE_FORMATED']?></p>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
    <div class="block-head">Шаг 3 из 5. <b>Выберите способ оплаты</b></div>
    <div class="block-body">
        <!--        PAY_SYSTEM_ID-->
        <div class="row">
            <? foreach ($arResult['PAY_SYSTEM'] as $pay_system){ ?>
                <div class="delivery-item">
                    <div class="row">
                        <div class="delivery-icon">
                            <img src="<?=$pay_system['PSA_LOGOTIP']['SRC']?>" alt="<?=$pay_system['NAME']?>">
                        </div>
                        <div class="delivery-description">
                            <div class="form-radio">
                                <label for="checkout-payment_<?=$pay_system['ID']?>"><input <?=isset($pay_system['CHECKED']) ? 'checked' : '' ?> type="radio" id="checkout-payment_<?=$pay_system['ID']?>" name="PAY_SYSTEM_ID" value="<?=$pay_system['ID']?>"><?=$pay_system['NAME']?></label>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
    <div class="block-head">Шаг 4 из 5. <b>Оставьте комментарий</b></div>
    <div class="block-body">
        <label class="form-label">Ваше дополнение к заказу:</label>
        <div class="row">
            <textarea name="ORDER_DESCRIPTION" class="form-input full-width" id="checkout-comment" style="resize: none;" placeholder="Оставьте комментарий здесь"></textarea>
        </div>
    </div>
    <div class="block-head">Шаг 5 из 5. <b>проверьте корзину</b></div>
    <div class="table-body">
        <? foreach ($arResult['GRID']['ROWS'] as $cart_item){ ?>
            <?
            $res = CIBlockElement::GetByID($cart_item['data']['PRODUCT_ID']);
            $category_id = $res->GetNext()['IBLOCK_SECTION_ID'];
            $category = CIBlockSection::GetByID((int)$category_id)->GetNext();
            $category_name = $category["NAME"];
            $category_href = $category["SECTION_PAGE_URL"];
            ?>
            <div class="table-row">
                <div class="table-body-cell product-image">
                    <a href="<?=$cart_item['data']['DETAIL_PAGE_URL']?>" target="_blank">
                        <img src="<?=$cart_item['data']['PREVIEW_PICTURE_SRC']?>" alt="<?=$cart_item['data']['NAME']?>">
                    </a>
                </div>
                <div class="table-body-cell product-name display-flex">
                    <div class="product-meta">
                        <a href="<?=$cart_item['data']['DETAIL_PAGE_URL']?>" target="_blank">
                            <p class="product-meta-name"><?=$cart_item['data']['NAME']?></p>
                        </a>
                        <a href="<?=$category_href?>">
                            <p class="product-meta-category"><?=$category_name?></p>
                        </a>
                        <p class="product-article">Артикул: <span class="light"><a href="/search?code=<?=$cart_item['data']['PROPERTY_CML2_ARTICLE_VALUE']?>"><?=$cart_item['data']['PROPERTY_CML2_ARTICLE_VALUE']?></a></span></p>
                    </div>
                </div>
                <div class="table-body-cell product-quantity">
                    <p class="light">Кол-во:</p>
                    <p class="quantity"><?=$cart_item['data']['QUANTITY']?> <?=$cart_item['data']['MEASURE_TEXT']?></p>
                </div>
                <div class="table-body-cell product-total">
                    <p><span class="bold"><?=$cart_item['data']['SUM_BASE_FORMATED']?></span></p>
                    <!--                                <p class="product-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить из корзины</p>-->
                </div>
            </div>
        <? } ?>
    </div>
    <div class="checkout-submit">
        <div class="total">
            <p>Всего, с учётом доставки:</p>
            <p class="bold"><span class="price-total-all"><?=$arResult['JS_DATA']['TOTAL']['ORDER_TOTAL_PRICE_FORMATED']?></span></p>
        </div>
        <div id="bx-soa-orderSave">
            <button type="button" name="save" class="btn small checkout" data-save-button="true">Оформить заказ</button>
        </div>
    </div>
</form>