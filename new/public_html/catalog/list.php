<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
CModule::IncludeModule("iblock");
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>4,"SECTION_ID"=>$_REQUEST["SECTION_ID"],"ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>20), $arSelect);
if ($ob = $res->GetNextElement()){
    $mark_Filter = Array('IBLOCK_ID'=>6, 'GLOBAL_ACTIVE'=>'Y');
    $mark_list = CIBlockSection::GetList(Array($by=>$order), $mark_Filter, true);
    $mark_array = [];
    while($mark_result = $mark_list->GetNext())
    {
        $mark_array[] = [
          'ID' => $mark_result['ID'],
          'NAME' => $mark_result['NAME'],
          $mark_result['NAME'] => $mark_result['ID']
        ];
    }
    if (isset($_GET['marka'])){
        $arModelSelect = Array("NAME");
        $section_id = '';
        foreach ($mark_array as $mark_item){
            if ($mark_item[$_GET['marka']] != null) {
                $section_id = $mark_item[$_GET['marka']];
            }
        }
        $arModelFilter = Array("IBLOCK_ID"=>6,"ACTIVE"=>"Y","SECTION_ID"=>$section_id);
        $resModel = CIBlockElement::GetList(Array(), $arModelFilter, false, false, $arModelSelect);
        $model_array = [];
        while ($resultModel = $resModel->GetNextElement()){
            $model_array[]['NAME'] = $resultModel->fields['NAME'];
        }
    }
?>
    <div class="catalog catalog-list">
        <div class="title-section">Каталог запчастей</div>
        <div class="filter">
            <form action="/catalog/list.php" method="get">
                <input type="hidden" name="SECTION_ID" value="<?=$_GET['SECTION_ID']?>">
                <div class="title-block">Подобрать запчасть:</div>
                <div class="row">
                    <select name="marka" id="marka" class="customize-select">
                        <option <?=isset($_GET['marka']) ? '' : 'selected'?> value="">Выберите марку</option>
                        <? foreach ($mark_array as $mark_item) { ?>
                            <option <?=$_GET['marka'] == $mark_item['NAME'] ? 'selected' : '' ?> data-id="<?=$mark_item['ID']?>" value="<?=$mark_item['NAME']?>"><?=$mark_item['NAME']?></option>
                        <? } ?>
                    </select>
                    <select name="model" id="model" class="customize-select">
                        <? if (isset($model_array)){ ?>
                            <option value="">Выберите модель</option>
                            <? foreach ($model_array as $model_item){ ?>
                                <option <?=$_GET['model'] == $model_item['NAME'] ? 'selected' : '' ?> value="<?=$model_item['NAME']?>"><?=$model_item['NAME']?></option>
                            <? }
                        }else{ ?>
                            <option selected value="">Выберите модель</option>
                        <? } ?>
                    </select>
                    <input type="text" id="year" class="form-input" name="year" placeholder="Введите год" value="<?=isset($_GET['year']) ? $_GET['year'] : '' ?>">
                    <button type="submit" class="btn">Найти деталь</button>
                </div>
            </form>
        </div>
        <script>
            $(function () {
               var $list = $('#marka').parent('.select').find('.select-options li');
                $list.on('click', function () {
                   var id = $('#marka option:selected').attr('data-id');
                   $.ajax({
                       url: '/catalog/get_model.php',
                       method: 'POST',
                       dataType: 'JSON',
                       data: {'ID': id},
                       beforeSend: function(){
                           var html = '<option value="">Выберите модель</option>';
                           var list = '<li rel="">Выберите модель</li>';
                           $('#model').empty();
                           $('#model').parent('.select').find('.select-options').empty();
                           $(html).appendTo($('#model'));
                           $(list).appendTo($('#model').parent('.select').find('.select-options'));
                       },
                       complete: function(json) {
                           $.each(json.responseJSON, function (index, element) {
                               var html = '<option value="'+element+'">'+element+'</option>';
                               var list = '<li rel="'+element+'">'+element+'</li>';
                               $(html).appendTo($('#model'));
                               $(list).appendTo($('#model').parent('.select').find('.select-options'));
                           });
                           setTimeout(function () {
                               var $this = $('#model');
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
                       }
                   });
               });
            });
        </script>
        <div class="search-product">
            <form action="/catalog/list.php" method="get">
                <input type="hidden" name="SECTION_ID" value="<?=$_GET['SECTION_ID']?>">
                <div class="row">
                    <input type="text" id="article" class="form-input" name="code" placeholder="Введите номер" value="<?=isset($_GET['code']) ? $_GET['code'] : '' ?>" required>
                    <button type="submit" class="btn">Найти деталь по номеру</button>
                </div>
            </form>
        </div>
        <?
        if (isset($_GET['marka']) || isset($_GET['model'])) {
            if (isset($_GET['year'])){
                if (sizeof($_GET['year']) > 2) {
//                    substr("abcdef", -2)
                }
                $year = $_GET['year'];
            }else{
                $year = '';
            }
            $arrFilter = [
                "PROPERTY_PODKHODIMOST" => '%'.$_GET['marka'] . '|' . $_GET['model'].' '.$year.'%'
            ];
        }else if (isset($_GET['code'])){
            $arrFilter = [
                "PROPERTY_CML2_ARTICLE" => $_GET['code']
            ];
        }
        ?>
        <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"template", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
		"BASKET_URL" => "/personal/basket.php",
		"BRAND_PROPERTY" => "-",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"CUSTOM_FILTER" => "",
		"DATA_LAYER_NAME" => "dataLayer",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "PROP",
		"ENLARGE_PROP" => "-",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_LIMIT" => "15",
		"OFFERS_PROPERTY_CODE" => "",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "pag",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "15",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "NEWPRODUCT",
			2 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "template",
		"SEF_RULE" => "",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"DISPLAY_COMPARE" => "N",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager"
	),
	false
); ?>
    </div>
<?// } else if (!$res->GetNextElement() && isset($_GET['SECTION_ID'])){ ?>
<!--    Пустая категория-->
<? }else {?>
    <div class="title-section">Каталог запчастей</div>
    <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "template", Array(
	"VIEW_MODE" => "LIST",	// Вид списка подразделов
		"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "4",	// Инфоблок
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"COMPONENT_TEMPLATE" => ".default",
		"HIDE_SECTION_NAME" => "N"
	),
	false
);
}?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
