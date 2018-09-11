<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");

$style = (is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])) ? "" : "display:none";
?>
<div class="block-head">Шаг 4 из 5. <b>Оставьте комментарий</b></div>
<div class="block-body">
    <label class="form-label">Ваше дополнение к заказу:</label>
    <div class="row">
        <textarea name="ORDER_DESCRIPTION" class="form-input full-width" id="checkout-comment" style="resize: none;" placeholder="Оставьте комментарий здесь"></textarea>
        <?=PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"])?>
    </div>
</div>
<div class="bx_section" style="<?=$style?>">
	<h4><?=GetMessage("SOA_TEMPL_RELATED_PROPS")?></h4>
	<br />

</div>