<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$arModelSelect = Array("NAME");
$arModelFilter = Array("IBLOCK_ID"=>6,"ACTIVE"=>"Y","SECTION_ID"=>$_REQUEST["ID"]);
$resModel = CIBlockElement::GetList(Array(), $arModelFilter, false, false, $arModelSelect);
$model_array = [];
while ($resultModel = $resModel->GetNextElement()){
    $model_array[] = $resultModel->fields['NAME'];
}
echo json_encode($model_array);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>