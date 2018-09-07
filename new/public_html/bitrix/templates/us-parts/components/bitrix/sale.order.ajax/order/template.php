<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
    Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

if (empty($arParams['TEMPLATE_THEME']))
{
    $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
    $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
    $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
    $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
    if (!is_file(Main\Application::getDocumentRoot().'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
    {
        $arParams['TEMPLATE_THEME'] = 'blue';
    }
}

$arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
$arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['SHOW_ORDER_BUTTON']))
{
    $arParams['SHOW_ORDER_BUTTON'] = 'final_step';
}

$arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after')))
{
    $arParams['BASKET_POSITION'] = 'after';
}

$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_COUPONS_BASKET'] = $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_DELIVERY'] = $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_PAY_SYSTEM'] = $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME']))
{
    $arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME']))
{
    $arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME']))
{
    $arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME']))
{
    $arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME']))
{
    $arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME']))
{
    $arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME']))
{
    $arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BACK']))
{
    $arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FURTHER']))
{
    $arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_EDIT']))
{
    $arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER']))
{
    $arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PRICE']))
{
    $arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERIOD']))
{
    $arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK']))
{
    $arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD']))
{
    $arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE']))
{
    $arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY']))
{
    $arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE']))
{
    $arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1']))
{
    $arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2']))
{
    $arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3']))
{
    $arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS']))
{
    $arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON']))
{
    $arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_COUPON']))
{
    $arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE']))
{
    $arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE']))
{
    $arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE']))
{
    $arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST']))
{
    $arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST']))
{
    $arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP']))
{
    $arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE']))
{
    $arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC']))
{
    $arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE']))
{
    $arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT']))
{
    $arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT']))
{
    $arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE']))
{
    $arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT']))
{
    $arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']))
{
    $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
}

$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
    case 'ru':
        $locale = 'ru-RU'; break;
    case 'ua':
        $locale = 'ru-UA'; break;
    case 'tk':
        $locale = 'tr-TR'; break;
    default:
        $locale = 'en-US'; break;
}

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css', true);
$APPLICATION->SetAdditionalCSS($templateFolder.'/style.css', true);
$this->addExternalJs($templateFolder.'/order_ajax.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
$this->addExternalJs($templateFolder.'/script.js');
?>
    <NOSCRIPT>
        <div style="color:red"><?=Loc::getMessage('SOA_NO_JS')?></div>
    </NOSCRIPT>
<?

if (strlen($request->get('ORDER_ID')) > 0)
{
    include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
    include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
    $hideDelivery = empty($arResult['DELIVERY']);
    ?>
    <?
    global $USER;
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    ?>
    <form action="<?=POST_FORM_ACTION_URI?>" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">
        <?
        echo bitrix_sessid_post();

        if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0)
        {
            echo $arResult['PREPAY_ADIT_FIELDS'];
        }
        ?>
        <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
        <input type="hidden" name="location_type" value="code">
        <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
        <div id="bx-soa-order" class="row" style="opacity: 1">
            <!--	MAIN BLOCK	-->
            <div class="col-sm-12 bx-soa">
                <div id="bx-soa-main-notifications">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div data-type="informer" style="display:none"></div>
                </div>
                <div class="block-head">Шаг 1 из 5. <b>Введите данные</b></div>
                <div class="block-body">
                    <label class="form-label">Контактное лицо:</label>
                    <div class="row">
                        <input type="text" id="checkout-name" class="form-input half-width" name="ORDER_PROP_1" value="<?=$arUser['NAME']?>" placeholder="Имя" required>
                        <input type="text" id="checkout-surname" class="form-input half-width" name="checkout-surname" value="<?=$arUser['LAST_NAME']?>" placeholder="Фамилия" required>
                    </div>
                    <div class="row">
                        <input type="text" id="checkout-email" class="form-input half-width" name="ORDER_PROP_2" value="<?=$arUser['EMAIL']?>" placeholder="Адрес эллектронной почты" required>
                        <input type="text" id="checkout-telephone" class="form-input half-width" name="ORDER_PROP_3" value="<?=$arUser['PERSONAL_PHONE']?>" placeholder="Телефон" required>
                    </div>

                    <label class="form-label">Адрес доставки:</label>
                    <div class="row">
                        <input type="text" id="checkout-address" class="form-input full-width end-block" name="ORDER_PROP_7" value="<?=$arUser['UF_ADDRESS']?>" placeholder="пример: г.Москва Дмитровское шоссе 102к2с3" required>
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
                        <? foreach ($arResult['DELIVERY'] as $delivery){ ?>
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
                    <?
                    if ($arParams['USER_CONSENT'] === 'Y')
                    {
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.userconsent.request',
                            '',
                            array(
                                'ID' => $arParams['USER_CONSENT_ID'],
                                'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
                                'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
                                'AUTO_SAVE' => 'N',
                                'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
                                'REPLACE' => array(
                                    'button_caption' => isset($arParams['~MESS_ORDER']) ? $arParams['~MESS_ORDER'] : $arParams['MESS_ORDER'],
                                    'fields' => $arResult['USER_CONSENT_PROPERTY_DATA']
                                )
                            )
                        );
                    }
                    ?>
                    <!--	ORDER SAVE BLOCK	-->
                    <div id="bx-soa-orderSave">
                        <div class="checkbox">
                            <?
                            if ($arParams['USER_CONSENT'] === 'Y')
                            {
                                $APPLICATION->IncludeComponent(
                                    'bitrix:main.userconsent.request',
                                    '',
                                    array(
                                        'ID' => $arParams['USER_CONSENT_ID'],
                                        'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
                                        'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
                                        'AUTO_SAVE' => 'N',
                                        'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
                                        'REPLACE' => array(
                                            'button_caption' => isset($arParams['~MESS_ORDER']) ? $arParams['~MESS_ORDER'] : $arParams['MESS_ORDER'],
                                            'fields' => $arResult['USER_CONSENT_PROPERTY_DATA']
                                        )
                                    )
                                );
                            }
                            ?>
                        </div>
                        <button type="button" class="btn small checkout" data-save-button="true">Оформить заказ</button>
                    </div>
                </div>

                <div style="display: none;">
                    <div id='bx-soa-basket-hidden' class="bx-soa-section"></div>
                    <div id='bx-soa-region-hidden' class="bx-soa-section"></div>
                    <div id='bx-soa-paysystem-hidden' class="bx-soa-section"></div>
                    <div id='bx-soa-delivery-hidden' class="bx-soa-section"></div>
                    <div id='bx-soa-pickup-hidden' class="bx-soa-section"></div>
                    <div id="bx-soa-properties-hidden" class="bx-soa-section"></div>
                    <div id="bx-soa-auth-hidden" class="bx-soa-section">
                        <div class="bx-soa-section-content container-fluid reg"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="bx-soa-saved-files" style="display:none"></div>
    <div id="bx-soa-soc-auth-services" style="display:none">
        <?
        $arServices = false;
        $arResult['ALLOW_SOCSERV_AUTHORIZATION'] = Main\Config\Option::get('main', 'allow_socserv_authorization', 'Y') != 'N' ? 'Y' : 'N';
        $arResult['FOR_INTRANET'] = false;

        if (Main\ModuleManager::isModuleInstalled('intranet') || Main\ModuleManager::isModuleInstalled('rest'))
            $arResult['FOR_INTRANET'] = true;

        if (Main\Loader::includeModule('socialservices') && $arResult['ALLOW_SOCSERV_AUTHORIZATION'] === 'Y')
        {
            $oAuthManager = new CSocServAuthManager();
            $arServices = $oAuthManager->GetActiveAuthServices(array(
                'BACKURL' => $this->arParams['~CURRENT_PAGE'],
                'FOR_INTRANET' => $arResult['FOR_INTRANET'],
            ));

            if (!empty($arServices))
            {
                $APPLICATION->IncludeComponent(
                    'bitrix:socserv.auth.form',
                    'flat',
                    array(
                        'AUTH_SERVICES' => $arServices,
                        'AUTH_URL' => $arParams['~CURRENT_PAGE'],
                        'POST' => $arResult['POST'],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
            }
        }
        ?>
    </div>

    <div style="display: none">
        <?
        // we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it
        $APPLICATION->IncludeComponent(
            'bitrix:sale.location.selector.steps',
            '.default',
            array(),
            false
        );
        $APPLICATION->IncludeComponent(
            'bitrix:sale.location.selector.search',
            '.default',
            array(),
            false
        );
        ?>
    </div>
    <?
    $signer = new Main\Security\Sign\Signer;
    $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
    $messages = Loc::loadLanguageFile(__FILE__);
    ?>
    <script>
        BX.message(<?=CUtil::PhpToJSObject($messages)?>);
        BX.Sale.OrderAjaxComponent.init({
            result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
            locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
            params: <?=CUtil::PhpToJSObject($arParams)?>,
            signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
            siteId: '<?=$component->getSiteId()?>',
            ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
            templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
            propertyValidation: true,
            showWarnings: true,
            pickUpMap: {
                defaultMapPosition: {
                    lat: 55.76,
                    lon: 37.64,
                    zoom: 7
                },
                secureGeoLocation: false,
                geoLocationMaxTime: 5000,
                minToShowNearestBlock: 3,
                nearestPickUpsToShow: 3
            },
            propertyMap: {
                defaultMapPosition: {
                    lat: 55.76,
                    lon: 37.64,
                    zoom: 7
                }
            },
            orderBlockId: 'bx-soa-order',
            authBlockId: 'bx-soa-auth',
            basketBlockId: 'bx-soa-basket',
            regionBlockId: 'bx-soa-region',
            paySystemBlockId: 'bx-soa-paysystem',
            deliveryBlockId: 'bx-soa-delivery',
            pickUpBlockId: 'bx-soa-pickup',
            propsBlockId: 'bx-soa-properties',
            totalBlockId: 'bx-soa-total'
        });
    </script>
    <script>
        <?
        // spike: for children of cities we place this prompt
        $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
        ?>
        BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
            'source' => $component->getPath().'/get.php',
            'cityTypeId' => intval($city['ID']),
            'messages' => array(
                'otherLocation' => '--- '.Loc::getMessage('SOA_OTHER_LOCATION'),
                'moreInfoLocation' => '--- '.Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.Loc::getMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                        '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                        '#ANCHOR_END#' => '</a>'
                    )).'</div>'
            )
        ))?>);
    </script>
    <?
    if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y')
    {
        if ($arParams['PICKUP_MAP_TYPE'] === 'yandex')
        {
            $this->addExternalJs($templateFolder.'/scripts/yandex_maps.js');
            ?>
            <script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>
            <script>
                (function bx_ymaps_waiter(){
                    if (typeof ymaps !== 'undefined' && BX.Sale && BX.Sale.OrderAjaxComponent)
                        ymaps.ready(BX.proxy(BX.Sale.OrderAjaxComponent.initMaps, BX.Sale.OrderAjaxComponent));
                    else
                        setTimeout(bx_ymaps_waiter, 100);
                })();
            </script>
            <?
        }

        if ($arParams['PICKUP_MAP_TYPE'] === 'google')
        {
            $this->addExternalJs($templateFolder.'/scripts/google_maps.js');
            $apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'google_map_api_key', ''));
            ?>
            <script async defer
                    src="<?=$scheme?>://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&callback=bx_gmaps_waiter">
            </script>
            <script>
                function bx_gmaps_waiter()
                {
                    if (BX.Sale && BX.Sale.OrderAjaxComponent)
                        BX.Sale.OrderAjaxComponent.initMaps();
                    else
                        setTimeout(bx_gmaps_waiter, 100);
                }
            </script>
            <?
        }
    }

    if ($arParams['USE_YM_GOALS'] === 'Y')
    {
        ?>
        <script>
            (function bx_counter_waiter(i){
                i = i || 0;
                if (i > 50)
                    return;

                if (typeof window['yaCounter<?=$arParams['YM_GOALS_COUNTER']?>'] !== 'undefined')
                    BX.Sale.OrderAjaxComponent.reachGoal('initialization');
                else
                    setTimeout(function(){bx_counter_waiter(++i)}, 100);
            })();
        </script>
        <?
    }
}
?>