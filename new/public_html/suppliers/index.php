<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поставщикам"); ?>
<!--  Content zone  -->
<!-- suppliers -->
<div class="suppliers">
    <div class="title-section">Поставщикам</div>
    <div class="text">
        <p>Вы производите или продаете автозапчасти для легковых и грузовых автомобилей, масла, автохимию и автокосметику, аксессуары, автоинструменты и оборудование или другую продукцию для автомобилей? И Вы хотите, чтобы US-Parts.ru реализовывал Ваш товар?</p>
        <p>Воспользуйтесь, пожалуйста, для этого формой ниже, и Ваше предложение о сотрудничестве будет рассмотрено. Вы в любом случае получите наш ответ. Для ускорения и более качественной обработки заполните, пожалуйста, все поля формы.</p>
        <div class="block-title bold">Необходимые условия сотрудничества для поставщиков:</div>
        <ul class="arrow">
            <li><span class="medium">Собственный ассортимент</span> оригинальных и неоригинальных запчастей.</li>
            <li>Конкурентная <span class="medium">цена.</span></li>
            <li><span class="medium">Регулярная доставка</span> до нашего склада в соответствии с графиком поставок.</li>
            <li><span class="medium">Оперативная информация</span> об отказах, изменении цены и прочих сведениях в течение 2 часов после заказа.</li>
            <li>Ежедневное <span class="medium">предоставление актуальных цен</span> и наличия путем отправки прайс-листа.</li>
            <li><span class="medium">Отправка счетов-фактур</span> в электронном виде до фактического прихода товара на наш склад.</li>
            <li>Цена в счет-фактуре не должна отличаться от цены, зафиксированной в момент заказа.</li>
            <li>Отправка счетов-фактур и <span class="medium">УПД</span> в электронном виде до фактического прихода товара на наш склад</li>
            <li>Цена в счет-фактуре и <span class="medium">УПД</span> не должна отличаться от цены,зафиксированной в момент заказа.</li>
        </ul>
        <div class="block-title bold">Форма обратной связи для поставщиков</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "suppliers",
            array(
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "Y",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "EDIT_URL" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "LIST_URL" => "",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "/suppliers",
                "USE_EXTENDED_ERRORS" => "Y",
                "WEB_FORM_ID" => "2",
                "COMPONENT_TEMPLATE" => "suppliers",
                "VARIABLE_ALIASES" => array(
                    "WEB_FORM_ID" => "WEB_FORM_ID",
                    "RESULT_ID" => "RESULT_ID",
                )
            ),
            false
        );?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
