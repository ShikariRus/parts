<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<!--  Content zone  -->
<!-- vin -->
<div class="vin">
    <div class="title-section">Подбор пр VIN коду</div>
    <div class="vin-block">

        <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"vin", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "Y",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "/vin",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "1",
		"COMPONENT_TEMPLATE" => "vin",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>

        <div class="text">
            <p>Подобрать запчасти по <b>VIN</b> с помощью специалистов – <b>значит получить стопроцентную гарантию,</b> что детали подойдут вашему автомобилю. Чтобы поиск прошел быстро и успешно, заполните и отправьте нашим специалистам форму выше. Мы понимаем негативное отношение пользователей к принудительной регистрации, поэтому предлагаем обойтись без нее, вам просто необходимо оставить информацию для обратной связи.</p>
            <p>Оформление заявки потребует от вас безошибочной передачи сведений о запчастях при отправке формы. <b>Сосредоточьтесь при заполнении!</b> Как видите, полей в заявке много, поэтому одной заявкой вы можете заказать подбор на несколько деталей.</p>
            <p>Идентификация с помощью кодировки облегчает поиск запчастей по VIN коду, а также при установке не доставит мастеру проблем, а владельцу автомобиля дополнительных затрат.</p>
            <p>Этот удобный и простой сервис позволяет автолюбителям получить точно подобранные детали, не бегая по магазинам, а ограничиться всего лишь передачей сведений данных, даже не контактируя напрямую с операторами сервиса.</p>
        </div>
        <div class="telephone-block">
            <p class="bold">Консультации по телефонам:</p>
            <a class="telephone bold" href="tel:+7 (495) 77-888-14"><i class="fa fa-phone" aria-hidden="true"></i> +7 (495) 77-888-14</a>
            <a class="telephone bold" href="tel:+7 (495) 580-61-26"><i class="fa fa-phone" aria-hidden="true"></i> +7 (495) 580-61-26</a>
            <a class="telephone bold" href="tel:+7 (495) 780-23-84"><i class="fa fa-phone" aria-hidden="true"></i> +7 (495) 780-23-84</a>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
