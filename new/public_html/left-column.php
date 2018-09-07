<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog_vertical", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "catalog_vertical",
		"MENU_THEME" => "site",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
<? include_once $_SERVER["DOCUMENT_ROOT"].'/includes/profile.php' ?>
<? include_once $_SERVER["DOCUMENT_ROOT"].'/includes/for_clients.php' ?>
<? include_once $_SERVER["DOCUMENT_ROOT"].'/includes/delivery.php' ?>
<? include_once $_SERVER["DOCUMENT_ROOT"].'/includes/lux.php' ?>
