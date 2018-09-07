<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;


if (strlen($arParams["MAIN_CHAIN_NAME"]) > 0)
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}


$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'],
		"name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
		"icon" => '<i class="fa fa-calculator"></i>'
	);
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ACCOUNT'],
		"name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
		"icon" => '<i class="fa fa-credit-card"></i>'
	);
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PRIVATE'],
		"name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
		"icon" => '<i class="fa fa-user-secret"></i>'
	);
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{

	$delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'].$delimeter."filter_history=Y",
		"name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
		"icon" => '<i class="fa fa-list-alt"></i>'
	);
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PROFILE'],
		"name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
		"icon" => '<i class="fa fa-list-ol"></i>'
	);
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_BASKET'],
		"name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
		"icon" => '<i class="fa fa-shopping-cart"></i>'
	);
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_SUBSCRIBE'],
		"name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
		"icon" => '<i class="fa fa-envelope"></i>'
	);
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_CONTACT'],
		"name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
		"icon" => '<i class="fa fa-info-circle"></i>'
	);
}

$customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
if ($customPagesList)
{
	foreach ($customPagesList as $page)
	{
		$availablePages[] = array(
			"path" => $page[0],
			"name" => $page[1],
			"icon" => (strlen($page[2])) ? '<i class="fa '.htmlspecialcharsbx($page[2]).'"></i>' : ""
		);
	}
}

?>
<!--  Content zone  -->
<!-- Cabinet -->
<div class="cabinet">
    <div class="title-section">Мой кабинет</div>
<!--    <div class="text-section">-->
<!--        <p>Lorem ipsum dolor sit amet, ea vim dico veniam possit, est an ignota graeco. Tractatos vulputate eam ei, at cum ferri graeci. Ne usu vocent timeam tamquam. Id vim diam dicit vivendo. Cum quod diceret disputando ea, no pertinax interpretaris pri, et adipisci scriptorem definitionem quo. An quem erant animal duo. Id usu equidem indoctum, cetero dolorem usu no, et sit timeam reformidans.</p>-->
<!--        <p>Qui an tincidunt reformidans, ea quo purto duis expetendis, ne vis unum legendos voluptatibus. Cu duo doctus facilis, per probo putent ea, ex qui persius sensibus. Ex sit idque euismod vituperatoribus. Pri suas delicatissimi in, mea ea mentitum suavitate. Quem consetetur in his, nam esse autem verear an.</p>-->
<!--    </div>-->
    <? global $USER;
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    if ($USER->IsAuthorized()){ ?>
        <div class="btn-block">
            <? if ($arParams['SHOW_ORDER_PAGE'] === 'Y') { ?>
                <button class="btn btn-inline"><a href="<?=$arResult['PATH_TO_ORDERS']?>"><i class="icon order-icon"></i> Заказы</a></button>
            <? } ?>
        </div>
    <? } ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.profile",
        "",
        Array(
            "AJAX_MODE" => "Y",
            "SEND_INFO" => "N",
            "USER_PROPERTY_NAME" => "",   // Название закладки с доп. свойствами
            "USER_PROPERTY" => Array(
                'UF_ADDRESS',
                'UF_DELIVERY'
            ),
            "CHECK_RIGHTS" => "N",   // Проверять права доступа
            "AJAX_OPTION_JUMP" => "N",   // Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "N",   // Включить подгрузку стилей
            "AJAX_OPTION_HISTORY" => "N",   // Включить эмуляцию навигации браузера
            "INCLUDE_HIDE" => array("INCLUDE_FORUM"=>'N', "INCLUDE_BLOG"=>'N', "INCLUDE_LEARNING"=>'N')

        ),
        $component
    );?>
</div>


