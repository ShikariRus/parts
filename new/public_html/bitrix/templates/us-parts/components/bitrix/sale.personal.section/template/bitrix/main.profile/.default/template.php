<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

?>
<?
    $deliver_array = \Bitrix\Sale\Delivery\Services\Manager::getActiveList();
?>
<div class="bx_profile">
    <div class="profile-block">
        <div class="row">
            <div class="block-bg user-block">
                <div class="block-head">Мои данные</div>
                <form method="post" name="form1" action="<?=$APPLICATION->GetCurUri()?>" class="user-form" enctype="multipart/form-data" role="form">
                    <?=$arResult["BX_SESSION_CHECK"]?>
                    <input type="hidden" name="lang" value="<?=LANG?>" />
                    <input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
                    <input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
<!--                    <label class="form-label" for="delivery">Способ получения:</label>-->
<!--                    <div class="form-radio">-->
<!--                        --><?// foreach ($deliver_array as $deliver_item){ ?>
<!--                            --><?// if ($deliver_item['NAME'] != 'Без доставки'){ ?>
<!--                                --><?// if ($deliver_item['CONFIG']['MAIN']['PRICE'] != '500'){ ?>
<!--                                    <label for="delivery_--><?//=$deliver_item['ID']?><!--"><input --><?//=$arResult["USER_PROPERTIES"]["DATA"]["UF_DELIVERY"]["VALUE"] == $deliver_item['NAME'] ? 'checked' : ''  ?><!-- type="radio" id="delivery_--><?//=$deliver_item['ID']?><!--" name="UF_DELIVERY" value="--><?//=$deliver_item['NAME']?><!--">--><?//=$deliver_item['NAME']?><!--</label>-->
<!--                                --><?// } ?>
<!--                            --><?// } ?>
<!--                        --><?// } ?>
<!--                    </div>-->
<!--                    <label class="form-label" for="delivery-address">Адрес доставки:</label>-->
<!--                    <div class="row">-->
<!--                        <input type="text" id="delivery-address" class="form-input full-width end-block" name="UF_ADDRESS" placeholder="пример: г.Москва Дмитровское шоссе 102к2с3" value="--><?//=$arResult["USER_PROPERTIES"]["DATA"]["UF_ADDRESS"]["VALUE"]?><!--" required>-->
<!--                    </div>-->
                    <label class="form-label">Контактное лицо:</label>
                    <div class="row">
                        <input type="text" name="NAME" class="form-input half-width" placeholder="Имя"  maxlength="50" id="main-profile-name" value="<?=$arResult["arUser"]["NAME"]?>" required>
                        <input type="text" name="LAST_NAME" class="form-input half-width" placeholder="Фамилия" maxlength="50" id="main-profile-last-name" value="<?=$arResult["arUser"]["LAST_NAME"]?>" required>
                        <input type="email" name="EMAIL" class="form-input half-width" placeholder="Email" maxlength="50" id="main-profile-email" value="<?=$arResult["arUser"]["EMAIL"]?>" required>
                        <input type="text" name="PERSONAL_PHONE" class="form-input half-width end-block" placeholder="Телефон" maxlength="50" id="main-profile-phine" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" required>
                    </div>
                    <label class="form-label">Смена пароля:</label>
                    <? if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == '') {?>
                        <div class="row">
                            <input type="text" name="NEW_PASSWORD" class="form-input half-width" placeholder="Новый пароль" maxlength="50" id="main-profile-password" value="" autocomplete="off">
                            <input type="text" name="NEW_PASSWORD_CONFIRM" class="form-input half-width" placeholder="Подтверждение пароля" maxlength="50" id="main-profile-password-confirm" value="" autocomplete="off">
                            <div class="half-width end-block">
                                <p class="main-profile-form-password-annotation small">
                                    <?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
                                </p>
                            </div>
                        </div>
                    <? } ?>
                    <button type="submit" name="save" class="btn main-profile-submit" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>"><i class="fa fa-user" aria-hidden="true"></i> Изменить мои данные</button>
                </form>

                <?
                ShowError($arResult["strProfileError"]);
                if ($arResult['DATA_SAVED'] == 'Y')
                {
                    ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
                }
                ?>
            </div>
        </div>
    </div>
<!--	<div class="col-sm-12 main-profile-social-block">-->
<!--		--><?//
//		if ($arResult["SOCSERV_ENABLED"])
//		{
//			$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
//				"SHOW_PROFILES" => "Y",
//				"ALLOW_DELETE" => "Y"
//			),
//				false
//			);
//		}
//		?>
<!--	</div>-->
</div>