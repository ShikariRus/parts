<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>
<div class="block-head">Шаг 5 из 5. <b>проверьте корзину</b></div>
<div class="table-body">
    <? foreach ($arResult['GRID']['ROWS'] as $cart_item){ ?>
        <?
        $res = CIBlockElement::GetByID($cart_item['data']['PRODUCT_ID']);
        $category_id = $res->GetNext()['IBLOCK_SECTION_ID'];
        $category = CIBlockSection::GetByID((int)$category_id)->GetNext();
        $category_name = $category["NAME"];
        $category_href = $category["SECTION_PAGE_URL"];
        ?>
        <div class="table-row">
            <div class="table-body-cell product-image">
                <a href="<?=$cart_item['data']['DETAIL_PAGE_URL']?>" target="_blank">
                    <img src="<?=$cart_item['data']['PREVIEW_PICTURE_SRC']?>" alt="<?=$cart_item['data']['NAME']?>">
                </a>
            </div>
            <div class="table-body-cell product-name display-flex">
                <div class="product-meta">
                    <a href="<?=$cart_item['data']['DETAIL_PAGE_URL']?>" target="_blank">
                        <p class="product-meta-name"><?=$cart_item['data']['NAME']?></p>
                    </a>
                    <a href="<?=$category_href?>">
                        <p class="product-meta-category"><?=$category_name?></p>
                    </a>
                    <p class="product-article">Артикул: <span class="light"><a href="/search?code=<?=$cart_item['data']['PROPERTY_CML2_ARTICLE_VALUE']?>"><?=$cart_item['data']['PROPERTY_CML2_ARTICLE_VALUE']?></a></span></p>
                </div>
            </div>
            <div class="table-body-cell product-quantity">
                <p class="light">Кол-во:</p>
                <p class="quantity"><?=$cart_item['data']['QUANTITY']?> <?=$cart_item['data']['MEASURE_TEXT']?></p>
            </div>
            <div class="table-body-cell product-total">
                <p><span class="bold"><?=$cart_item['data']['SUM_BASE_FORMATED']?></span></p>
                <!--                                <p class="product-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить из корзины</p>-->
            </div>
        </div>
    <? } ?>
</div>