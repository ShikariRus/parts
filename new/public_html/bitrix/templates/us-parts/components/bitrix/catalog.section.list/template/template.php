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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
if (!$_GET['SECTION_ID']){
    $class = 'catalog';
}else{
    $class = 'catalog sub-catalog';
}
?><div class="<?=$class?> <? echo $arCurView['CONT']; ?>"><?
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_line_img"
					style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				></a>
				<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2><?
				if ('' != $arSection['DESCRIPTION'])
				{
					?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
				}
				?><div style="clear: both;"></div>
				</li><?
			}
			unset($arSection);
			break;
		case 'TEXT':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2></li><?
			}
			unset($arSection);
			break;
		case 'TILE': ?>
            <div class="catalog-grid">
            <div class="row">
			<? foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><div class="item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <?
                    if (isset($_GET['marka'])){
                        $marka = "&marka=".$_GET['marka'];
                    }else{
                        $marka = '';
                    }
                    if (isset($_GET['model'])){
                        $model = "&model=".$_GET['model'];
                    }else{
                        $model = '';
                    }
                    if (isset($_GET['year'])){
                        $year = "&year=".$_GET['year'];
                    }else{
                        $year = '';
                    }
                ?>
                <a href="<? echo $arSection['SECTION_PAGE_URL']; ?><?=$marka?><?=$model?><?=$year?>">
                    <div class="image">
                        <img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['PICTURE']['ALT']?>">
                    </div>
                    <? if ('Y' != $arParams['HIDE_SECTION_NAME']) {
                        ?> <div class="item-name"><? echo $arSection['NAME']; ?></div> <?
                        if ($arParams["COUNT_ELEMENTS"])
                        {
                            ?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
                        }
                        ?><?
                    } ?>
                </a>
                </div><?
			} ?>
			<? unset($arSection);
			break;
		case 'LIST':
            $res = CIBlockSection::GetByID($arResult['SECTIONS'][0]["IBLOCK_SECTION_ID"]);
            $ar_res = $res->GetNext();
            ?>
            <div class="block-title"><?=$ar_res['NAME']?></div>
            <div class="catalog-list">
            <div class="row">
			<? $intCurrentDepth = 1;
			$chunk = ceil(sizeof($arResult['SECTIONS']) / 3);
			$ar = array_chunk($arResult['SECTIONS'], $chunk);
			$count = sizeof($ar);
            if (isset($_GET['marka'])){
                $marka = "&marka=".$_GET['marka'];
            }else{
                $marka = '';
            }
            if (isset($_GET['model'])){
                $model = "&model=".$_GET['model'];
            }else{
                $model = '';
            }
            if (isset($_GET['year'])){
                $year = "&year=".$_GET['year'];
            }else{
                $year = '';
            }
            ?>
                <div class="left-block">
                <? foreach ($ar[0] as &$arSection){ ?>
                    <div class="item">
                        <a href="<?=$arSection['SECTION_PAGE_URL']?><?=$marka?><?=$model?><?=$year?>"><?=$arSection['NAME']?></a>
                    </div>
                <? } ?>
                </div>
                <div class="center-block">
                    <? foreach ($ar[1] as &$arSection){ ?>
                        <div class="item">
                            <a href="<?=$arSection['SECTION_PAGE_URL']?><?=$marka?><?=$model?><?=$year?>"><?=$arSection['NAME']?></a>
                        </div>
                    <? } ?>
                </div>
                <div class="right-block">
                    <? foreach ($ar[2] as &$arSection){ ?>
                        <div class="item">
                            <a href="<?=$arSection['SECTION_PAGE_URL']?><?=$marka?><?=$model?><?=$year?>"><?=$arSection['NAME']?></a>
                        </div>
                    <? } ?>
                </div>
            </div>
            <? unset($arSection);
			break;
	}
?>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}else{ ?>
    <p>Нет товаров в данной категории</p>
<? }
?></div>