<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="block-title"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>
    <?
    global $USER;
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    ?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="repair-form content">
    <?=bitrix_sessid_post()?>
    <label class="form-label">Желаемая дата посещения сервиса:</label>
        <div class="row">
            <div class="form-block half-width">
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="custom[]" placeholder="ДД/ММ/ГГ" required>
                </div>
            </div>
        </div>
        <div class="end-block"></div>
        <label class="form-label">Представьтесь</label>
        <div class="row">
            <div class="form-block full-width">
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="user_name" value="<?=isset($arUser['NAME']) && isset($arUser['LAST_NAME']) ? $arUser['NAME'].' '.$arUser['LAST_NAME'] : $arResult["AUTHOR_NAME"]?>" placeholder="Фамилия Имя Отчество" required>
                </div>
            </div>
        </div>
        <div class="end-block"></div>
        <label class="form-label">Ваши контактные даные:</label>
        <div class="row">
            <div class="form-block half-width">
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="custom[]" value="<?=isset($arUser['PERSONAL_PHONE']) ? $arUser['PERSONAL_PHONE'] : $arResult["AUTHOR_TELEPHONE"]?>" placeholder="Телефон" required>
                </div>
            </div>
            <div class="form-block half-width">
                <div class="input-wrap">
                    <input type="text" class="form-input full-width" name="user_email" value="<?=isset($arUser['EMAIL']) ? $arUser['EMAIL'] : $arResult["AUTHOR_EMAIL"]?>" placeholder="E-mail">
                </div>
            </div>
        </div>
        <div class="end-block"></div>
        <label class="form-label">Модель и марка:</label>
        <div class="row">
            <div class="form-block half-width">
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="custom[]" value="<?=$arResult["MODEL_MARK"]?>" placeholder="Пример: Subaru — Forester" required>
                </div>
            </div>
        </div>
        <div class="end-block"></div>
        <div class="row">
            <div class="form-block half-width">
                <label class="form-label">VIN номер:</label>
                <div class="input-wrap">
                    <input type="text" class="form-input full-width" name="custom[]" value="<?=$arResult["VIN"]?>" placeholder="Пример: XTA210990Y2766389" required>
                </div>
            </div>
<!--            <div class="form-block half-width">-->
<!--                <label class="form-label">Мастер:</label>-->
<!--                <div class="input-wrap">-->
<!--                    <input type="text" class="form-input full-width" placeholder="Пример: Алексей" required>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <div class="end-block"></div>
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">Напишите ваши пожелания:</label>
                <textarea class="form-input full-width" style="resize: none; width: 100%;" name="MESSAGE" placeholder="Комментарий к заявке"><?=$arResult["MESSAGE"]?></textarea>
            </div>
        </div>
        <div class="end-block"></div>
        <div class="form-block full-width">
            <div class="g-recaptcha" data-sitekey="6LeXe14UAAAAAMj559ybITkM82oDcqMYgUhV1J5-"></div>
        </div>
        <div class="end-block"></div>
        <div class="form-block full-width">
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
            <button type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="btn small">Отправить</button>
        </div>
    </form>
</div>