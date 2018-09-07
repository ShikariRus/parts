<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<div class="block-title"><?=$arResult["FORM_NOTE"]?></div>
<?=$arResult["FORM_HEADER"]?>
<?
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>

    <div class="block-head"><b>Введите данные</b></div>
    <div class="block-body">
        <label class="form-label">Контактное лицо:</label>
        <div class="row">
            <!--            <div class="input-wrap input-required"></div>-->
            <input type="text" id="form_text_6" class="form-input half-width" name="form_text_6" value="<?=$arUser['NAME']?>" placeholder="Имя">
            <input type="text" id="form_text_7" class="form-input half-width" name="form_text_7" value="<?=$arUser['LAST_NAME']?>" placeholder="Фамилия">
        </div>
        <div class="row">
            <input type="text" id="form_text_8" class="form-input half-width" name="form_text_8" value="<?=$arUser['EMAIL']?>" placeholder="Адрес эллектронной почты">
            <input type="text" id="form_text_9" class="form-input half-width" name="form_text_9" value="<?=$arUser['PERSONAL_PHONE']?>" placeholder="Телефон">
        </div>
        <div class="end-block"></div>
        <label class="form-label">Информация по автомобилю:</label>
        <div class="row">
            <input type="text" id="form_text_10" class="form-input full-width" name="form_text_10" placeholder="Модель и марка">
        </div>
        <div class="row">
            <input type="text" id="form_text_11" class="form-input half-width" name="form_text_11" placeholder="Год выпуска">
            <input type="text" id="form_text_12" class="form-input half-width" name="form_text_12" placeholder="VIN номер">
        </div>
        <div class="end-block"></div>
        <label class="form-label">Куда вам лучше ответить:</label>
        <div class="form-radio">
            <label for="vin-call"><input checked type="radio" id="vin-call" name="form_radio_SIMPLE_QUESTION_320" value="13">На телефон</label>
            <label for="vin-mail"><input type="radio" id="vin-mail" name="form_radio_SIMPLE_QUESTION_320" value="14">На почту</label>
        </div>
    </div>
    <div class="block-head"><b>Поиск деталей</b></div>
    <div class="block-body part-block">
        <label class="form-label">Какие запчасти необходимы:</label>
        <div class="row part-row">
            <input type="text" id="part-name" class="form-input" name="part-name" placeholder="Наименование">
            <select name="part-original" id="part-original" class="customize-select">
                <option selected  value="original">Оригинал</option>
                <option value="not-original">Замена</option>
            </select>
        </div>
        <div class="row part-row">
            <input type="text" id="part-name" class="form-input" name="part-name" placeholder="Наименование">
            <select name="part-original" id="part-original" class="customize-select">
                <option selected  value="original">Оригинал</option>
                <option value="not-original">Замена</option>
            </select>
        </div>
        <div class="row part-row">
            <input type="text" id="part-name" class="form-input" name="part-name" placeholder="Наименование">
            <select name="part-original" id="part-original" class="customize-select">
                <option selected  value="original">Оригинал</option>
                <option value="not-original">Замена</option>
            </select>
        </div>
        <div class="row part-row">
            <input type="text" id="part-name" class="form-input" name="part-name" placeholder="Наименование">
            <select name="part-original" id="part-original" class="customize-select">
                <option selected  value="original">Оригинал</option>
                <option value="not-original">Замена</option>
            </select>
        </div>
        <label style="cursor: pointer" class="form-label add-part-row">Еще запчасти</label>
        <div class="row">
            <textarea name="form_text_16" id="part-comment"  class="form-input full-width" placeholder="Примечание"></textarea>
        </div>
        <textarea style="display: none;" name="form_textarea_15" id="part_block" cols="30" rows="10"></textarea>
        <div class="form-block">
            <button type="button" class="btn small">Отправить</button>
            <input style="display: none;" type="submit"  value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"   name="web_form_submit">
        </div>
        <script>
            $(function () {
                $('button[type="button"]').on('click', function (event) {
                    event.preventDefault();
                    $('#part_block').text('');
                    var part, original, part_array = [];
                    $.map($('.part-row'), function (element) {
                        part = $(element).find('input').val();
                        original = $(element).find('select option:selected').text();
                        if (part != '') {
                            part_array.push(part + ' ' + original);
                        }
                    });
                    var size = part_array.length - 1;
                    $.each(part_array, function (index, part_item) {
                        $('#part_block').text($('#part_block').text() + part_item+ '\n');
                        setTimeout(function () {
                            if (index == size){
                                $('input[type="submit"]').trigger('click');
                            }
                        }, 150);
                    });
                });
                $('.add-part-row').on('click', function () {
                    var html = "<div class=\"row part-row\">\n" +
                        "            <input type=\"text\" id=\"part-name\" class=\"form-input\" name=\"part-name\" placeholder=\"Наименование\">\n" +
                        "            <div class=\"select\"><select name=\"part-original\" id=\"part-original\" class=\"customize-select select-hidden\">\n" +
                        "                <option selected=\"\" value=\"original\">Оригинал</option>\n" +
                        "                <option value=\"not-original\">Замена</option>\n" +
                        "            </select><div class=\"select-styled placeholder\">Оригинал</div><ul class=\"select-options\" style=\"display: none;\"><li rel=\"original\">Оригинал</li><li rel=\"not-original\">Замена</li></ul></div>\n" +
                        "        </div>";
                    $(html).insertAfter($('.part-row').last());
                    setTimeout(function () {
                        var $this = $('.part-row').last().find('#part-original');
                        var $styledSelect = $this.parent('.select').find('div.select-styled');
                        var $list = $this.parent('.select').find('.select-options');
                        var $listItems = $this.parent('.select').find('.select-options li');
                        $listItems.click(function(e) {
                            e.stopPropagation();
                            $styledSelect.text($(this).text()).removeClass('active');
                            if ($(this).attr('rel') == "false"){
                                $styledSelect.addClass('placeholder');
                            }else{
                                $styledSelect.removeClass('placeholder');
                            }
                            $this.val($(this).attr('rel'));
                            $this.find('option[value="'+$(this).attr('rel')+'"]').prop('selected', 'selected');
                            $list.hide();
                        });
                    }, 100);
                });
            });
        </script>
    </div>
<?=$arResult["FORM_FOOTER"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>

<?
} //endif (isFormNote)
?>