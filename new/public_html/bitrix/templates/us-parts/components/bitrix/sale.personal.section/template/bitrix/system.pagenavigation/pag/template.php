<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?if($arResult["NavShowAlways"] === true) {?>
    <div class="pagination">
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=1" class="icon"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
        <? if ($arResult['NavPageNomer'] > 1){
            $prev_page = $arResult['NavPageNomer'] - 1;
        }else{
            $prev_page = $arResult['NavPageNomer'];
        } ?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$prev_page?>" class="icon"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        <? for ($i = 1; $i < $arResult['NavPageCount'] + 1; $i++) { ?>
            <? if ($i < 3 || $i > $arResult['NavPageCount'] - 2){ ?>
                <? if ($i == $arResult['NavPageNomer']){ ?>
                    <span class="current"><?=$i?></span>
                <? }else{ ?>
                    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$i?>"><?=$i?></a>
                <? } ?>
            <? }else if ($i > 5){ ?>
                <a href="javascript:void(0)">|</a>
                <? $i = $arResult['NavPageCount'] - 2 ?>
            <? } ?>
        <? } ?>
        <? if ($arResult['NavPageNomer'] < $arResult['NavPageCount']){
            $next_page = $arResult['NavPageNomer'] + 1;
        }else{
            $next_page = $arResult['NavPageNomer'];
        } ?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$next_page?>" class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['NavPageCount']?>" class="icon"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
    </div>
<? } ?>


<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>
<?endif?>