<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог Us-parts"); ?>
<div class="title-section">Каталог Us-Parts</div>
<div class="block-title">Выберите марку автомобиля</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"template", 
	array(
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => "Avto",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_URL" => "/auto/list.php?&SECTION_ID=#SECTION_ID#",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "template",
		"HIDE_SECTION_NAME" => "N"
	),
	false
);?>
</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>