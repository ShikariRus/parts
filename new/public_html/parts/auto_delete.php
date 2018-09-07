<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$item_to_delete = 'Toyota';
foreach($MARK as $key => $value) {
    if ($value == $item_to_delete){
        unset($MARK[$key]);
    }
}
$fields = Array(
    "UF_MARK" => $MARK,
);
$user->Update($ID, $fields);
$strError .= $user->LAST_ERROR;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>