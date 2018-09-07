<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=htmlspecialcharsbx(SITE_DIR)?>favicon.ico" />
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>-->
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jquery-3.3.1.min.js"></script>
    <!--  OWL slider  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.theme.default.min.css">
    <!--  END slider  -->
    <!-- css assistance   -->
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css-assistance/normalize.css">
    <!--  Styles  -->
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/style.css">
    <!--  Browser css  -->
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css-assistance/browser.css">
    <!--  Script  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/index.js"></script>
</head>
<?php
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    if (preg_match('/macintosh/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/iPhone/i', $u_agent)) {
        $platform = 'iphone';
    }
    elseif (preg_match('/iPad/i', $u_agent)) {
        $platform = 'ipad';
    }
    elseif (preg_match('/Android/i', $u_agent)) {
        $platform = 'android';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    else if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'IE';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/OPR/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {

    }

    $i = count($matches['browser']);
    if ($i != 1) {
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

$browser=getBrowser();
?>
<body data-browser="<?=strtolower($browser['name'])?>" data-platform="<?=strtolower($browser['platform'])?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<header>
    <div class="container">
        <div class="row top">
            <div class="logo">
                <a href="/">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.png" alt="Us-parts logo">
                </a>
            </div>
            <div class="site-title">
                <h1 class="title"><b>Запчасти для</b> американских, корейских и европейских <b>автомобилей</b></h1>
            </div>
            <div class="telephone-mobile">
                <a href="tel:+7(495)5806126">+7(495)580-61-26</a>
                <a href="tel:+7(495)7788814">+7(495)778-88-14</a>
            </div>
            <div class="site-cart basket-container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    ".default",
                    array(
                        "PATH_TO_BASKET" => "/personal/cart/",
                        "PATH_TO_PERSONAL" => "/personal/",
                        "SHOW_PERSONAL_LINK" => "N",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_TOTAL_PRICE" => "N",
                        "SHOW_EMPTY_VALUES" => "Y",
                        "SHOW_AUTHOR" => "N",
                        "PATH_TO_AUTHORIZE" => "",
                        "SHOW_REGISTRATION" => "Y",
                        "PATH_TO_REGISTER" => SITE_DIR."login/",
                        "PATH_TO_PROFILE" => SITE_DIR."personal/",
                        "SHOW_PRODUCTS" => "N",
                        "POSITION_FIXED" => "N",
                        "HIDE_ON_BASKET_PAGES" => "N",
                        "AJAX" => "N"
                    ),
                    false
                );?>
            </div>
            <div class="mobile-menu-toggle">
                <i class="fa" aria-hidden="true"></i>
            </div>
            <div class="mobile-menu">
                <? include_once $_SERVER["DOCUMENT_ROOT"].'/includes/menu-mobile.php' ?>
            </div>
        </div>
        <div class="row bottom">
            <div class="telephone-block">
                <a href="tel:+7(495)5806126">+7(495)580-61-26</a>
                <a href="tel:+7(495)7788814">+7(495)778-88-14</a>
            </div>
            <div class="open-time-block">
                <p>Пн-Пт: 10.00-19.00</p>
                <p>Сб: 10.00-16.00</p>
            </div>
            <div class="email-block">
                <p>Эл. почта:</p>
                <a href="mailto:info@us-parts.ru">info@us-parts.ru</a>
            </div>
            <div class="user-block">
                <?
                global $USER;
                if ($USER->IsAuthorized()){ ?>
                    <a class="cabinet" href="/personal">Ваш кабинет</a>
                    <a class="logout" href="?logout=yes">Выйти</a>
                <? }else{ ?>
                    <a class="auth" href="/auth">Авторизация</a>
                    <a class="register" href="/auth/?register=yes">Регистрация</a>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="scroll-bar">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <a href="/">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.png" alt="Us-parts logo">
                    </a>
                </div>
                <div class="telephone-block">
                    <a href="tel:+7(495)5806126">+7(495)580-61-26</a>
                    <a href="tel:+7(495)7788814">+7(495)778-88-14</a>
                </div>
                <div class="email-block">
                    <a href="mailto:info@us-parts.ru">info@us-parts.ru</a>
                </div>
                <div class="site-cart basket-container">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        ".default",
                        array(
                            "PATH_TO_BASKET" => "/personal/cart/",
                            "PATH_TO_PERSONAL" => "/personal/",
                            "SHOW_PERSONAL_LINK" => "N",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                            "SHOW_NUM_PRODUCTS" => "Y",
                            "SHOW_TOTAL_PRICE" => "N",
                            "SHOW_EMPTY_VALUES" => "Y",
                            "SHOW_AUTHOR" => "N",
                            "PATH_TO_AUTHORIZE" => "",
                            "SHOW_REGISTRATION" => "Y",
                            "PATH_TO_REGISTER" => SITE_DIR."login/",
                            "PATH_TO_PROFILE" => SITE_DIR."personal/",
                            "SHOW_PRODUCTS" => "N",
                            "POSITION_FIXED" => "N",
                            "HIDE_ON_BASKET_PAGES" => "N",
                            "AJAX" => "N"
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- wrapper -->
<section class="content">
    <div class="container">
        <div class="row">
            <aside class="left-column">
                <? include_once $_SERVER["DOCUMENT_ROOT"].'/left-column.php' ?>
            </aside>
            <div class="content-block">
                <? include $_SERVER["DOCUMENT_ROOT"].'/includes/search.php' ?>
                <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"template", 
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "template"
	),
	false
);?>
                <? endif; ?>
