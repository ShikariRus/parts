<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>

<?
$vin = $_REQUEST['VIN'];
$json = $_REQUEST['JSON'];
if ($json == true) {
//    echo json_decode(file_get_contents('https://partsapi.ru/api.php?act=VINdecode&lang=ru&vin=' . $vin . '&lang=ru&key=test'), JSON_UNESCAPED_UNICODE);
    echo file_get_contents('https://partsapi.ru/api.php?act=VINdecodeShort&lang=ru&vin=' . $vin . '&lang=ru&key=test');
}else{
    return json_decode(file_get_contents('https://partsapi.ru/api.php?act=VINdecodeShort&lang=ru&vin=' . $vin . '&lang=ru&key=test'), JSON_UNESCAPED_UNICODE);
}
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>
