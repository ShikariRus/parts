<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();

$menuBlockId = "catalog_menu_".$this->randString();
?>
<div class="menu left-block-bg">
    <div class="head left-block-head">МЕНЮ</div>
    <ul>
        <?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
            <li>
                <a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></span>
                </a>
            </li>
        <?endforeach;?>
    </ul>
</div>