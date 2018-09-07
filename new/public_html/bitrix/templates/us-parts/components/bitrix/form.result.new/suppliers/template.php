<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<div class="block-title"><?=$arResult["FORM_NOTE"]?></div>
<?=$arResult["FORM_HEADER"]?>
<div class="row">
    <div class="suppliers-form content">
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">Название компании:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="form_text_17" placeholder="Пример: ООО “СтройТехно”" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-block half-width">
                <label class="form-label">Страна:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="form_text_18" placeholder="Введите страну" required>
                </div>
            </div>
            <div class="form-block half-width">
                <label class="form-label">Город:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="form_text_19" placeholder="Введите город" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-block half-width">
                <label class="form-label">Телефон:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" placeholder="+7 (999) ___-__-__" name="form_text_20" required>
                </div>
            </div>
            <div class="form-block half-width">
                <label class="form-label">E-mail:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input full-width" name="form_text_21" placeholder="Пример: stroi@gmail.com" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">ФИО контактного лица:</label>
                <div class="input-wrap input-required">
                    <input type="text" class="form-input" name="form_text_22" placeholder="Пример: Иванов Иван Иванович" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">Сайт компании:</label>
                <div class="input-wrap">
                    <input type="text" class="form-input full-width" name="form_text_23" placeholder="Пример: https://service.ru" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">Продукция и бренды, которые Вы представляете:</label>
                <textarea class="form-input full-width" style="resize: none" name="form_textarea_24" placeholder="Пример: шины и покрышки для авто от Continental"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-block full-width">
                <label class="form-label">Дополнительная информация:</label>
                <textarea class="form-input full-width" style="resize: none" name="form_textarea_25" placeholder="Ваш комментарий"></textarea>
            </div>
        </div>
        <div class="form-block full-width">
            <input type="submit" class="btn small" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"   name="web_form_submit">
        </div>
    </div>
</div>
<?=$arResult["FORM_FOOTER"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>

<?
} //endif (isFormNote)
?>