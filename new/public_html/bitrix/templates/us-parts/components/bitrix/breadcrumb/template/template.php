<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";
$strReturn = '';
$strReturn .= '<div class="breadcrumbs" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
$itemSize = count($arResult);
$strReturn .='<ul>';
$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
if (isset($_GET['marka'])){
    $marka = "?marka=" . $_GET['marka'];
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
for ($index = 0; $index <= $itemSize; $index++){
    if ($index < $itemSize - 1){
        $strReturn .= '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].$marka.$model.$year.'" title="'.$arResult[$index]['TITLE'].'" itemprop="url" itemprop="name">
					<span itemprop="name">'.$arResult[$index]['TITLE'].'</span>
				</a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
    }else{
        $strReturn .= '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name" class="thin">'.$arResult[$index]['TITLE'].'</span>
				<meta itemprop="position" content="'.($index + 1).'" />
			</li>';
    }
}
$strReturn .= '</ul></div>';
return $strReturn;
?>
